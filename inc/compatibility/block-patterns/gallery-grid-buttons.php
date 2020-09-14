<?php
/**
 * Gallery grid with buttons pattern.
 *
 * @package Neve
 */

return array(
	'title'      => __( 'Gallery grid with buttons', 'neve' ),
	'content'    => '<!-- wp:group -->
<div class="wp-block-group"><div class="wp-block-group__inner-container"><!-- wp:gallery {"ids":[406,405,401,421,420,418,419],"columns":4} -->
<figure class="wp-block-gallery columns-4 is-cropped"><ul class="blocks-gallery-grid"><li class="blocks-gallery-item"><figure><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-11.jpg" alt="" data-id="406" data-full-url="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-11.jpg" data-link="#" class="wp-image-406"/></figure></li><li class="blocks-gallery-item"><figure><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-10.jpg" alt="" data-id="405" data-full-url="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-10.jpg" data-link="#" class="wp-image-405"/></figure></li><li class="blocks-gallery-item"><figure><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-6.jpg" alt="" data-id="401" data-full-url="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-6.jpg" data-link="#" class="wp-image-401"/></figure></li><li class="blocks-gallery-item"><figure><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-22.jpg" alt="" data-id="421" data-full-url="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-22.jpg" data-link="#" class="wp-image-421"/></figure></li><li class="blocks-gallery-item"><figure><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-21.jpg" alt="" data-id="420" data-full-url="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-21.jpg" data-link="#" class="wp-image-420"/></figure></li><li class="blocks-gallery-item"><figure><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-19.jpg" alt="" data-id="418" data-full-url="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-19.jpg" data-link="#" class="wp-image-418"/></figure></li><li class="blocks-gallery-item"><figure><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-20.jpg" alt="" data-id="419" data-full-url="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/patterns/neve-patterns-20.jpg" data-link="#" class="wp-image-419"/></figure></li></ul></figure>
<!-- /wp:gallery -->

<!-- wp:buttons {"align":"center"} -->
<div class="wp-block-buttons aligncenter"><!-- wp:button {"className":"is-style-primary"} -->
<div class="wp-block-button is-style-primary"><a class="wp-block-button__link">This is Primary Button</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-secondary"} -->
<div class="wp-block-button is-style-secondary"><a class="wp-block-button__link">This is Secondary</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:group -->',
	'categories' => array( 'gallery' ),
);
