window.onload = function () {
	const siteNavigation = document.getElementById( 'site-navigation' );
	const menu_btn = document.querySelector('.hamburger');

	menu_btn.addEventListener('click', function () {
		menu_btn.classList.toggle('is-active');
	});

// remove
document.addEventListener( 'click', function( event ) {
    const isClickInside = siteNavigation.contains( event.target );
    if ( ! isClickInside ) {
        siteNavigation.classList.remove( 'toggled' );
    }
} );
}
