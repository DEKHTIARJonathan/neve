export default {
	setSites(sites) {
		return {
			type: 'SET_SITES',
			payload: {sites}
		};
	},
	setUpsells(upsells) {
		return {
			type: 'SET_UPSELLS',
			payload: {upsells}
		};
	},
	setMigrationData(migrationData) {
		return {
			type: 'SET_MIGRATION_DATA',
			payload: {migrationData}
		};
	},
	setCurrentEditor(editor) {
		return {
			type: 'SET_CURRENT_EDITOR',
			payload: {editor}
		};
	},
	setCurrentSite(siteData) {
		return {
			type: 'SET_FOCUSED_SITE',
			payload: {siteData}
		};
	},
	setPreviewStatus(previewStatus) {
		if (previewStatus) {
			document.body.classList.add('ob-overflow-off');
		} else {
			document.body.classList.remove('ob-overflow-off');
		}
		return {
			type: 'SET_PREVIEW_STATUS',
			payload: {previewStatus}
		};
	},
	setImportModalStatus(importModalStatus) {
		if (importModalStatus) {
			document.body.classList.add('ob-overflow-off');
		} else {
			document.body.classList.remove('ob-overflow-off');
		}
		return {
			type: 'SET_IMPORT_MODAL_STATUS',
			payload: {importModalStatus}
		};
	},
	setOnboardingState(state) {
		return {
			type: 'SET_ONBOARDING',
			payload: {state}
		};
	}
};
