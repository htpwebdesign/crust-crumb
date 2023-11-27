const hamburgerMenu = () => {
    const siteNavigation = document.getElementById( 'site-navigation' );
    const hamburgerBtn = document.querySelector('.hamburger');

   
    // add toggle and accessibility
	button.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'toggled' );
        hamburgerBtn.classList.toggle('is-active');
		if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			button.setAttribute( 'aria-expanded', 'true' );
		}
	} );

    // remove
	document.addEventListener( 'click', function( event ) {
		const isClickInside = siteNavigation.contains( event.target );
		if ( ! isClickInside ) {
			siteNavigation.classList.remove( 'toggled' );
			button.setAttribute( 'aria-expanded', 'false' );
		}
	} );
}