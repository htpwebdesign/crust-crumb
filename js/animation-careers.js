jQuery(document).ready(function ($) {
    // Add the 'fade-up-visible' class to all elements on page load
    $('.fade-up').addClass('fade-up-visible');

    // Run the animation when a radio button is clicked
    $('form.career-location-radio input[name="location"]').click(function () {
        // Remove the 'fade-up-visible' class from all elements
        $('.fade-up').removeClass('fade-up-visible');

        // Add the 'fade-up-visible' class to all elements after a short delay
        setTimeout(function () {
            $('.fade-up').addClass('fade-up-visible');
        }, 100); // You can adjust the delay (in milliseconds) to suit your needs
    });
});
