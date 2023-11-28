jQuery(document).ready(function ($) {
    // Function to toggle shipping options based on the selected purchase method
    function toggleShippingOptions() {
        var purchaseMethod = $('input[name="purchase_method"]:checked').val();
        var placeOrderButton = $('#place_order');

        // If Local Pickup is selected, 
        if (purchaseMethod === 'Pickup') {
            // show payment options
            $('#payment').show();
            // hide shipping totals
            $('.woocommerce-shipping-totals').hide();
            //auto check local-pickup button (which is hidden)
            $('input[name^="shipping_method"][value^="local_pickup"]').prop('checked', true);
            // hide ship to different address checkbox
            $('#ship-to-different-address').hide();
        } else {
            //show if delivery
            $('.woocommerce-shipping-totals').show();
            $('#ship-to-different-address').show();
        }

        // If Delivery is selected, 
        if (purchaseMethod === 'Delivery') {
            //if delivery is less than 1 item (which is always local pickup)
            if ($('#shipping_method li').length <= 1) {
                // Remove existing error message if any
                $('#shipping_method').siblings('.delivery-error-message').remove();

                // Append the error message
                $('#shipping_method').after('<p class="delivery-error-message">No Delivery options available for this address</p>');
                //hide payment options
                $('#payment').hide();

            } else {
                // Remove the error message if switching from Delivery to Pickup
                $('#shipping_method').siblings('.delivery-error-message').remove();


            }
            //automatically check flat rate as the base option
            $('input[name^="shipping_method"][value^="flat_rate"]').prop('checked', true);
            //hide local pickup
            $('#shipping_method').find('input[name^="shipping_method"][value^="local_pickup"]').closest('li').hide();
        } else {
            // Remove the error message if the purchase method is not 'Delivery'
            $('#shipping_method').siblings('.delivery-error-message').remove();

        }
    }

    // Function to perform an asynchronous update of the checkout page
    //doesnt work, ask jonathon?
    function updateCheckout() {
        $('body').trigger('update_checkout');
    }



    // Initial execution
    toggleShippingOptions();

    // Trigger the function when purchase method changes
    $('#purchase_method_field').on('change', 'input[name="purchase_method"]', function () {
        toggleShippingOptions();
        updateCheckout();
    });
});
