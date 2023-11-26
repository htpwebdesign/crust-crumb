
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

            // Toggle the 'is-checked' class for the clicked button
            $('.filter-button-group button').removeClass('is-checked');
            $(this).addClass('is-checked');

            $container.isotope({ filter: filterValue });

            updateResultsCount(filterValue);
        });

        // Initial count
        updateResultsCount('*');
    });

