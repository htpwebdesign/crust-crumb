
    jQuery(document).ready(function ($) {
        var $container = $('.isotope-container').isotope({
            itemSelector: '.isotope-item',
            layoutMode: 'fitRows'
        });

        function updateResultsCount(filterValue) {
            var totalCount = $container.find('.isotope-item').length;
            var filteredCount = filterValue === '*' ? totalCount : $container.find(filterValue).length;

            $('#results-count').text(filteredCount);
        }

        $('.filter-button-group').on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $container.isotope({ filter: filterValue });

            updateResultsCount(filterValue);
        });

        // Initial count
        updateResultsCount('*');
    });

