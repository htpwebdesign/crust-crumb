window.onload = function () {
	const siteNavigation = document.getElementById( 'site-navigation' );
	const menu_btn = document.querySelector('.hamburger');



	menu_btn.addEventListener('click', function () {
		menu_btn.classList.toggle('is-active');
        siteNavigation.classList.toggle('toggled');
	});

// add toggle and accessibility
menu_btn.addEventListener( 'click', function() {
    siteNavigation.classList.toggle( 'toggled' );
    if ( menu_btn.getAttribute( 'aria-expanded' ) === 'true' ) {
        menu_btn.setAttribute( 'aria-expanded', 'false' );
    } else {
        menu_btn.setAttribute( 'aria-expanded', 'true' );
    }
} );

// remove
document.addEventListener( 'click', function( event ) {
    const isClickInside = siteNavigation.contains( event.target );
    if ( ! isClickInside ) {
        siteNavigation.classList.remove( 'toggled' );
        menu_btn.setAttribute( 'aria-expanded', 'false' );
    }
} );
}


