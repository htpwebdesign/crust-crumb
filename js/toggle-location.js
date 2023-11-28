// This JavaScript function toggles the visibility of the location field on the Checkout page based on the purchase method selected.


document.addEventListener('DOMContentLoaded', function () {
    
    // Get the purchase method radio buttons
    var localPickup = document.querySelector('input[name="purchase_method"][value="Local Pickup"]');
    var delivery = document.querySelector('input[name="purchase_method"][value="Delivery"]');

    // Get the location field
    var locationField = document.getElementById('pickup_location_field');

    // Initial check for default selected method
    toggleLocationField();

    // Add change event listeners to the radio buttons
    localPickup.addEventListener('change', toggleLocationField);
    delivery.addEventListener('change', toggleLocationField);

    // Function to toggle the location field based on the selected method
    function toggleLocationField() {
        // If Local Pickup is selected, show the location field; otherwise, hide it
        locationField.style.display = localPickup.checked ? 'block' : 'none';
    }
});

