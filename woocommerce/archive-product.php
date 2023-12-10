<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

?>
<?php
	
		// Output the image and the instructions
		if (function_exists('get_field')) {
?>

<header class="woocommerce-products-header hero-banner"> 
	<?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action('woocommerce_archive_description');
	?>
	<?php
		$size = 'full'; // (thumbnail, medium, large, full or custom size)
		if (get_field('hero_image', 19)) {
			echo wp_get_attachment_image(get_field('hero_image', 19), $size, false, array('class' => 'menu-hero-image'));
		}
		?>
</header>
<?php
	
	echo '<div class="menu-introductions">';
	if (get_field('delivery_instruction', 19)) {
		the_field('delivery_instruction', 19);
	}

	if (get_field('pickup_instruction', 19)) {
		the_field('pickup_instruction', 19);
	} 
	echo '</div>';
}


if (woocommerce_product_loop()) {
	
	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action('woocommerce_before_shop_loop');

	woocommerce_product_loop_start();

?>
	<!-- Custom result count based on the filter -->
	<li id="filtered-results-count">Showing <span id="results-count"><?php $products = wc_get_products(array('posts_per_page' => -1)); ?></span> products</li>

	<!-- Filter Buttons -->
	<li class="filter-button-group">
		<button class='is-checked' data-filter="*">All</button>
		<?php
		$product_categories = get_terms(array('taxonomy' => 'product_cat', 'parent' => 0));
		foreach ($product_categories as $category) :
			$category_slug = $category->slug;
		?>
			<button data-filter=".<?php echo esc_attr($category_slug); ?>"><?php echo esc_html($category->name); ?></button>
		<?php endforeach; ?>
	</li>

	<!-- Product Loop -->
	<li>
		<section class="isotope-container">
			<?php

			if (have_posts()) :
				while (have_posts()) :
					the_post();
					$categories = get_the_terms(get_the_ID(), 'product_cat');
					$category_classes = '';
					if ($categories) {
						foreach ($categories as $category) {
							$category_classes .= $category->slug . ' ';
						}
					}
					echo '<div class="isotope-item ' . esc_attr($category_classes) . '">';
					wc_get_template_part('content', 'product');
					echo '</div>';
				endwhile;
			endif;
			?>
		</section>
	</li>

<?php


	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action('woocommerce_after_shop_loop');
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action('woocommerce_no_products_found');
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
// do_action('woocommerce_sidebar'); -- Commented out to remove sidebar from shop page

get_footer('shop');
