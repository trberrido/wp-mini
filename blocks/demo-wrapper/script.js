document.addEventListener( 'DOMContentLoaded', () => {
	document.querySelectorAll( '.wp-block-wpmini-demo-wrapper__acf-content' ).forEach( wrapperContent => {
		console.log( 'Wrapper loaded:', wrapperContent.textContent );
	} );
} );