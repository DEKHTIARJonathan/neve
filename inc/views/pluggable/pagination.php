<?php
/**
 * Author:          Andrei Baicus <andrei@themeisle.com>
 * Created on:      31/08/2018
 *
 * @package Neve\Views\Pluggable
 */

namespace Neve\Views\Pluggable;

use Neve\Views\Base_View;

/**
 * Class Pagination
 *
 * @package Neve\Views\Pluggable
 */
class Pagination extends Base_View {
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'rest_api_init', array( $this, 'register_endpoints' ) );
		add_filter( 'neve_filter_main_script_localization', array( $this, 'filter_localization' ) );
		add_action( 'neve_do_pagination', array( $this, 'render_pagination' ) );
		add_action( 'neve_post_navigation', array( $this, 'render_post_navigation' ) );
	}

	/**
	 * Register Rest API endpoint for posts retrieval.
	 */
	public function register_endpoints() {
		register_rest_route(
			'nv/v1/posts',
			'/page/(?P<page_number>\d+)(?:/(?P<lang>[a-zA-Z0-9-_]+))?',
			array(
				'methods'             => \WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'get_posts' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	/**
	 * Get paginated posts.
	 *
	 * @param \WP_REST_Request $request the rest request.
	 *
	 * @return \WP_REST_Response
	 */
	public function get_posts( \WP_REST_Request $request ) {
		if ( empty( $request['page_number'] ) ) {
			return new \WP_REST_Response( '' );
		}

		$query_args = $request->get_body();
		$args       = json_decode( $query_args, true );

		$per_page = get_option( 'posts_per_page' );
		if ( $per_page > 100 ) {
			$per_page = 100;
		}

		$args['posts_per_page']      = $per_page;
		$args['post_type']           = 'post';
		$args['paged']               = $request['page_number'];
		$args['ignore_sticky_posts'] = 1;
		$args['post_status']         = 'publish';

		if ( ! empty( $request['lang'] ) ) {
			if ( defined( 'POLYLANG_VERSION' ) ) {
				$args['lang'] = $request['lang'];
			}

			if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
				global $sitepress;
				if ( gettype( $sitepress ) === 'object' && method_exists( $sitepress, 'switch_lang' ) ) {
					$sitepress->switch_lang( $request['lang'] );
				}
			}
		}

		$output = '';

		$query = new \WP_Query( $args );
		if ( $query->have_posts() ) {
			ob_start();
			while ( $query->have_posts() ) {
				$query->the_post();
				get_template_part( 'template-parts/content' );
			}
			wp_reset_postdata();
			$output = ob_get_contents();
			ob_end_clean();
		}

		return new \WP_REST_Response( $output );
	}

	/**
	 * Filter localization to add infinite scroll to the main script.
	 *
	 * @param array $data localization array.
	 *
	 * @return array
	 */
	public function filter_localization( $data ) {
		if ( ! $this->has_infinite_scroll() ) {
			return $data;
		}
		global $wp_query;
		$max_pages = $wp_query->max_num_pages;

		$data['infScroll'] = 'enabled';
		$data['maxPages']  = $max_pages;
		$data['endpoint']  = rest_url( 'nv/v1/posts/page/' );
		$data['query']     = wp_json_encode( $wp_query->query );
		$data['lang']      = get_locale();

		// WPML language parameter
		$current_lang = apply_filters( 'wpml_current_language', null );
		if ( ! empty( $current_lang ) ) {
			$data['lang'] = $current_lang;
		}

		return $data;
	}

	/**
	 * Determine whether to show the Jump to page HTML input.
	 * 
	 * @return bool
	 */
	private function show_jump_to_page_input() {
		return ( ! $this->has_infinite_scroll() && get_theme_mod( 'neve_enable_jump_to_pagination' ) ) ? true : false;
	}

	/**
	 * Create jump to navigation inputs.
	 * 
	 * @return mixed $markup HTML to output on page.
	 */
	private function create_jump_to_html() {

		// Value escaped once we confirm it's not empty, we never save this value to the DB.
		$request = $_SERVER['REQUEST_URI'] ?? ''; //phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		
		if ( empty( $request ) ) {
			return;
		}

		$request = esc_attr( $request );

		global $wp_query;

		$search_query = esc_attr( get_search_query() );
		$search_input = ! empty( $search_query ) ? "<input id='s' type='hidden' value='$search_query' name='s' />" : '';

		$button_text = apply_filters( 'neve_pagination_jump_button_text', __( 'Go', 'neve' ) );
		$button_text = esc_attr( $button_text );

		$max_num_pages = absint( $wp_query->max_num_pages );

		$current_page = ! empty( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '';

		$markup = <<<MARKUP
		<div id="nv-pagination-jump">
			<form action="$request" method="GET">
				<a class="page-numbers">
					<input id="nv-pagination-jump-page-num" placeholder="#" type="number" value="$current_page" max="$max_num_pages" name="paged" />
					<input id="nv-pagination-jump-go" value="$button_text" type="submit" /> 
					$search_input
				</a>
		   </form>
		</div>
MARKUP;

		return $markup;

	}

	/**
	 * Normalize our jump to feature element so that it can be used in render_pagination() method
	 *
	 * @return string $links All links as a string just like if we used paginate_links() with 'list' as the the 'type' arg.
	 */
	private function normalize_jump_to_input() {

		$links           = paginate_links( array( 'type' => 'array' ) );
		$last_element    = \array_pop( $links );
		$jump_to_element = $this->create_jump_to_html();
		
		/**
		 * If the next button is present, add the element just before it...
		 * If it's not then add the jump to element as the last item instead.
		 */
		if ( \strpos( $last_element, '<a class="next page-numbers"' ) !== false ) {
			\array_push( $links, $jump_to_element, $last_element ); 
		} else {
			\array_push( $links, $last_element, $jump_to_element );
		}

		\array_walk(
			$links,
			function( &$value ) {
				$value = '<li>' . $value . '</li>';
			} 
		);

		$links = '<ul class="page-numbers">' . \implode( '', $links ) . '</ul>';

		return $links;
	}

	/**
	 * Render the pagination.
	 *
	 * @param string $context Pagination location context.
	 */
	public function render_pagination( $context ) {
		if ( $context === 'single' ) {
			$this->render_single_pagination();

			return;
		}

		if ( ! $this->has_infinite_scroll() && is_paged() ) {
			/**
			 * Executes actions before pagination.
			 *
			 * @since 2.3.8
			 */
			do_action( 'neve_before_pagination' );
		}

		if ( $this->show_jump_to_page_input() ) {
			$links = $this->normalize_jump_to_input();
		} else {
			$links = paginate_links( array( 'type' => 'list' ) );
		}

		$links = str_replace(
			array( '<a class="prev', '<a class="next' ),
			array(
				'<a rel="prev" class="prev',
				'<a rel="next" class="next',
			),
			$links
		);

		echo $this->has_infinite_scroll() ? '<div style="display: none;">' : '';
		
		// If the jump to page feature is enabled we need to allow a few other HTML elements in wp_kses()
		if ( $this->show_jump_to_page_input() ) {
			add_filter(
				'wp_kses_allowed_html',
				function( $tags ) {
				
					$tags['input']                = array();
					$tags['input']['id']          = array();
					$tags['input']['max']         = array();
					$tags['input']['name']        = array();
					$tags['input']['placeholder'] = array();
					$tags['input']['type']        = array();
					$tags['input']['value']       = array();

					return $tags;

				}
			);
		}

		echo wp_kses_post( $links );
		echo $this->has_infinite_scroll() ? '</div>' : '';

		if ( $this->has_infinite_scroll() ) {
			echo wp_kses_post( '<div class="load-more-posts"><span class="nv-loader" style="display: none;"></span><span class="infinite-scroll-trigger"></span></div>' );
		}

	}

	/**
	 * Render single post / page pagination.
	 */
	private function render_single_pagination() {
		wp_link_pages(
			array(
				'before'      => '<div class="post-pages-links"><span>' . apply_filters( 'neve_page_link_before', esc_html__( 'Pages:', 'neve' ) ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			)
		);
	}

	/**
	 * Render single post navigation links
	 */
	public function render_post_navigation() {
		$prev_format = '<div class="previous">%link</div>';
		$next_format = '<div class="next">%link</div>';

		$prev_link = sprintf(
			'<span class="nav-direction">%1$s</span><span>%2$s</span>',
			esc_html__( 'previous', 'neve' ),
			'%title'
		);
		$next_link = sprintf(
			'<span class="nav-direction">%1$s</span><span>%2$s</span>',
			esc_html__( 'next', 'neve' ),
			'%title'
		);

		echo '<div class="' . esc_attr( apply_filters( 'neve_post_navigation_class', 'nv-post-navigation' ) ) . '">';
		previous_post_link( $prev_format, $prev_link );
		next_post_link( $next_format, $next_link );
		echo '</div>';
	}

	/**
	 * Has infinite scroll.
	 *
	 * @return bool
	 */
	private function has_infinite_scroll() {
		if ( neve_is_amp() ) {
			return false;
		}
		if ( is_search() ) {
			return false;
		}

		$pagination_type = get_theme_mod( 'neve_pagination_type', 'number' );
		if ( $pagination_type === 'infinite' ) {
			return true;
		}

		return false;
	}
}
