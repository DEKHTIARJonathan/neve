export default {
	getModuleStatus: (state, slug) => {
		if( neveDash.autoModuleConfigAvailable ) {
			return neveDash.autoModuleConfig.activeModules.includes(slug);
		}

		return state.settings['nv_pro_' + slug + '_status']
	},
	getOption: (state, slug) => state.settings[slug],
	getPlugins: (state) => state.plugins,
	getProOption: (state, slug) => {
		if( neveDash.autoModuleConfigAvailable ) {
			if(  neveDash.autoModuleConfig.options[slug] ) {
				return neveDash.autoModuleConfig.options[slug];
			}

			// fallback to default option values if the option not in the array.
			return neveDash.autoModuleConfig.defaultOptionVals[slug];
		}

		return state.settings['nv_pro_' + slug];
	},
	getLicenseTier: (state) => (state.license ? state.license.tier : 1),
	getLicense: (state) => state.license,
	getToast: (state) => state.toast,
	getTab: (state) => state.currentTab,
};
