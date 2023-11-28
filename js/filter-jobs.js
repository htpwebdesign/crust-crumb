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

                // Remove 'is-checked' class from all radio buttons
                radioButtons.forEach(function (r) {
                    r.classList.remove('is-checked');
                });

                // Add 'is-checked' class to the selected radio button
                radio.classList.add('is-checked');

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
            toggleAccordionIcon(jQuery(this));
        });

        // Event listener for window resize
        var resizeTimer;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                iso.layout();
            }, 0);
        });

        // Function to toggle the accordion icon
        function toggleAccordionIcon($accordionTitle) {
            if ($accordionTitle.hasClass("is-open")) {
                $accordionTitle.find(".accordion-icon").html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 9h24v6h-24z"/></svg>');
            } else {
                $accordionTitle.find(".accordion-icon").html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 9h-9v-9h-6v9h-9v6h9v9h6v-9h9z"/></svg>');
            }
        }
    }
});
