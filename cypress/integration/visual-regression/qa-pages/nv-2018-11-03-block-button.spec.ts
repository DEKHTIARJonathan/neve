describe('Visual Regression Testing - https://qa-neve.themeisle.com/nv/2018/11/03/block-button/', () => {
	const url = 'https://qa-neve.themeisle.com/nv/2018/11/03/block-button/';
	it('Should not add any visual change', function () {
		cy.visit(url);
		cy.captureDocument();
	});
});