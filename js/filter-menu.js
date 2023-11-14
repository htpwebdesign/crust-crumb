jQuery(document).ready(function ($) {
    var $container = $('.isotope-container').isotope({
        itemSelector: '.isotope-item',
        layoutMode: 'fitRows'
    });

    $('.filter-button-group').on('click', 'button', function () {
        var filterValue = $(this).attr('data-filter');
        $container.isotope({ filter: filterValue });
    });
});
