window.onload = function () {
	const siteNavigation = document.getElementById( 'site-navigation' );
	const menu_btn = document.querySelector('.hamburger');



	menu_btn.addEventListener('click', function () {
		menu_btn.classList.toggle('is-active');
	});

// add toggle and accessibility
button.addEventListener( 'click', function() {
    siteNavigation.classList.toggle( 'toggled' );
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
