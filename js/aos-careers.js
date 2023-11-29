jQuery(document).ready(function ($) {
    // Run AOS when the filter changes
    $('form.career-location-radio input[name="location"]').change(function () {
        // Remove AOS classes from all elements
        $('[data-aos]').removeClass('aos-init aos-animate');

        // Apply AOS classes to the visible elements
        $('[data-aos]:visible').addClass('aos-init aos-animate');
    });
});
