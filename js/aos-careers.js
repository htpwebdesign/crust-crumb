jQuery(document).ready(function ($) {
    // Run AOS when the filter changes
    $('form.career-location-radio input[name="location"]').change(function () {
        // Remove AOS classes from all elements
        $('[data-aos]').removeClass('aos-init aos-animate');

        // Delay the reapplication of AOS classes
        setTimeout(function () {
            // Apply AOS classes to the visible elements
            $('[data-aos]:visible').addClass('aos-init aos-animate');
        }, 100); // You can adjust the delay as needed
    });
});
