// isotope.js
document.addEventListener('DOMContentLoaded', function () {
    // Select the container that holds your job listings
    const jobContainer = document.getElementById('filtered-jobs');

    // Check if the job container exists on the current page
    if (jobContainer) {
        // Initialize Isotope
        const iso = new Isotope(jobContainer, {
            itemSelector: '.job-information',
            layoutMode: 'vertical', // Adjust as needed
        });

        // Select all radio buttons with the name "location"
        const radioButtons = document.querySelectorAll('input[name="location"]');

        // Add an event listener to each radio button
        radioButtons.forEach(function (radio) {
            radio.addEventListener('change', function () {
                // Get the value of the selected radio button
                const selectedLocation = document.querySelector('input[name="location"]:checked').value.toLowerCase();
                // Filter using Isotope
                iso.arrange({
                    filter: selectedLocation === 'all' ? '*' : `.location-${selectedLocation}`,
                });
            });
        });

        // Event listener for accordion click
        jQuery(".accordion-container").on("click", ".accordionTitle", function () {
            jQuery(this).toggleClass("is-open");
            iso.layout(); // Trigger Isotope layout after changes
        });

        // Event listener for window resize
        var resizeTimer;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                iso.layout();
            }, 300); // Adjust the debounce time as needed
        });
    }
});
