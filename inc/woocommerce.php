<?php

/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Crust_&_Crumb_Bakery
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function crust_crumb_woocommerce_setup()
{
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 210,
			'single_image_width' => 300,
			'product_grid' => array(
				'default_rows' => 3,
				'min_rows' => 1,
				'default_columns' => 4,
				'min_columns' => 1,
				'max_columns' => 6,
			),
		)
	);
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'crust_crumb_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function crust_crumb_woocommerce_scripts()
{
	wp_enqueue_style('crust-crumb-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION);

	$font_path = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style('crust-crumb-woocommerce-style', $inline_font);
}
add_action('wp_enqueue_scripts', 'crust_crumb_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function crust_crumb_woocommerce_active_body_class($classes)
{
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter('body_class', 'crust_crumb_woocommerce_active_body_class');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function crust_crumb_woocommerce_related_products_args($args)
{
	$defaults = array(
		'posts_per_page' => 3,
		'columns' => 3,
	);

	$args = wp_parse_args($defaults, $args);

	return $args;
}
add_filter('woocommerce_output_related_products_args', 'crust_crumb_woocommerce_related_products_args');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('crust_crumb_woocommerce_wrapper_before')) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function crust_crumb_woocommerce_wrapper_before()
	{
		?>
		<main id="primary" class="site-main">
			<?php
	}
}
add_action('woocommerce_before_main_content', 'crust_crumb_woocommerce_wrapper_before');

if (!function_exists('crust_crumb_woocommerce_wrapper_after')) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function crust_crumb_woocommerce_wrapper_after()
	{
		?>
		</main><!-- #main -->
		<?php
	}
}
add_action('woocommerce_after_main_content', 'crust_crumb_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'crust_crumb_woocommerce_header_cart' ) ) {
			crust_crumb_woocommerce_header_cart();
		}
	?>
 */

if (!function_exists('crust_crumb_woocommerce_cart_link_fragment')) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function crust_crumb_woocommerce_cart_link_fragment($fragments)
	{
		ob_start();
		crust_crumb_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'crust_crumb_woocommerce_cart_link_fragment');

if (!function_exists('crust_crumb_woocommerce_cart_link')) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function crust_crumb_woocommerce_cart_link()
	{
		?>
		<a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>"
			title="<?php esc_attr_e('View your shopping cart', 'crust-crumb'); ?>">
			<?php
			$item_count = WC()->cart->get_cart_contents_count();

			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n('%d', '%d', $item_count, 'crust-crumb'),
				$item_count
			);
			?>
			<span class="count">
				<?php echo esc_html($item_count_text); ?>
			</span>
		</a>
		<?php
	}


}

if (!function_exists('crust_crumb_woocommerce_header_cart')) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function crust_crumb_woocommerce_header_cart()
	{
		if (is_cart()) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr($class); ?>">
				<?php crust_crumb_woocommerce_cart_link(); ?>
			</li>

		</ul>
		<?php
	}
}

// This will output after the Add to Cart button and add Back to Menu link
function cac_custom_function()
{
	if (is_product()) {
		echo '<a class="back-to-menu-link" href="' . esc_url(home_url('/shop')) . '">Back to Menu</a>';
	}

	if (is_page('checkout')) {
		?>
		<div class="shipping-info-checkout">
			<p>Delivery Info:</p>
			<ul>
				<li>Zone 1: Richmond, Burnaby, Vancouver ($5.00 - flat rate).</li>
				<li>Zone 2: Surrey, Langley, Delta ($10.00 - flat rate).</li>
				<li>Zone 3: Whistler, North Vancouver, Chilliwack ($15.00 - flat rate).</li>
				<li>Free Delivery: Order of $80 and up Or Local Pickup (Please specify which location).</li>
			</ul>
		</div>
		<?php
	}
}

add_action(
	'woocommerce_before_main_content',
	'cac_custom_function',
	21
);

add_action(
	'woocommerce_checkout_after_customer_details',
	'cac_custom_function',
	22
);


// Remove Breadscrumb from all pages
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Remove default sorting options
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// Remove default result count
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// Remove default notices
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);


// Remove SKU from product meta
function remove_product_sku()
{
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
}
add_action('woocommerce_before_single_product', 'remove_product_sku');

//Remove WooCommerce Tabs - this code removes all 3 tabs - to be more specific just remove actual unset lines 

add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);

function woo_remove_product_tabs($tabs)
{

	unset($tabs['description']);      	// Remove the description tab
	unset($tabs['additional_information']);  	// Remove the additional information tab

	return $tabs;
}
// Remove short description from product page
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

// Add long description to product page

add_action('woocommerce_single_product_summary', 'ta_the_content');

function ta_the_content()
{
	echo the_content();
}

// Remove the WooCommerce sidebar on single product pages
function remove_woocommerce_sidebar()
{
	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
}
add_action('init', 'remove_woocommerce_sidebar');

// Setting a default value for a radio button field on Checkout field

function custom_override_checkout_fields($fields)
{

	$fields['billing']['pickup_location']['default'] = array_values($fields['billing']['pickup_location']['options'])[0];

	$fields['billing']['purchase_method']['default'] = array_values($fields['billing']['purchase_method']['options'])[0];

	return $fields;

}

add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action('woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash', 10);

// Remove the filter that hides shipping on both cart and checkout pages
remove_filter('woocommerce_cart_needs_shipping', '__return_false');


// Show shipping on the cart page
function show_shipping_on_cart_page($needs_shipping)
{
	if (is_cart()) {
		return false; // Hide shipping on the cart page
	}
	return $needs_shipping;
}
add_filter('woocommerce_cart_needs_shipping', 'show_shipping_on_cart_page');

// Show shipping on the checkout page (excluding order received page)
function show_shipping_on_checkout_page($needs_shipping)
{
	if (is_checkout() && !is_wc_endpoint_url('order-received')) {
		return true;
	}
	return $needs_shipping;
}
add_filter('woocommerce_cart_needs_shipping', 'show_shipping_on_checkout_page');




function shipchange($translated_text, $text, $domain)
{
	switch ($translated_text) {
		case 'Ship to a different address?':
			$translated_text = __('Deliver to a different address?', 'woocommerce');
			break;
	}
	return $translated_text;
}

add_filter('gettext', 'shipchange', 20, 3);




add_filter('woocommerce_shipping_package_name', 'custom_shipping_package_name');
function custom_shipping_package_name($name)
{
	return 'Delivery';
}