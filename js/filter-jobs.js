document.addEventListener('DOMContentLoaded', function () {
    // Select all radio buttons with the name "location"
    const radioButtons = document.querySelectorAll('input[name="location"]');
    // Add an event listener to each radio button
    radioButtons.forEach(function (radio) {
        radio.addEventListener('change', function () {
            // Get the value of the selected radio button
            const selectedLocation = document.querySelector('input[name="location"]:checked').value;

            // Remove 'is-checked' class from all radio buttons
            radioButtons.forEach(function (r) {
                r.classList.remove('is-checked');
            });

            // Add 'is-checked' class to the selected radio button
            radio.classList.add('is-checked');
            // Select all elements with the class "job-information"
            const jobDescriptions = document.querySelectorAll('.job-information');
            // Iterate over each job description element
            jobDescriptions.forEach(function (job) {
                // get location ACF and trim any whitespace if needed
                const location = job.querySelector('.career-location').textContent.trim();

                // Check if the selected location is "All" or if the job location includes the selected location
                if (selectedLocation === 'All' || location.toLowerCase().includes(selectedLocation.toLowerCase())) {
                    // display jobs with selectedLocation
                    job.style.display = 'block';
                } else {
                    // hide jobs that dont have selectedLocation
                    job.style.display = 'none';
                }
            });
        });
    });

});