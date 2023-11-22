<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Crust_&_Crumb_Bakery
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php while (have_posts()) : the_post();

		if (function_exists("get_field")) { ?>


			<section class="hero-banner">
				<h1><?php the_field('slogan_message'); ?></h1>
				<?php
				$image = get_field('hero_product_image');
				$image3d = get_field('hero_3d_image');
				$size = 'full'; // (thumbnail, medium, large, full or custom size)
				if ($image) {
					echo wp_get_attachment_image($image, $size, false, array("class" => "hero-image-background"));
				}
				if ($image3d) {
					echo wp_get_attachment_image($image3d, $size,false, array("class" => "hero-3d-image"));
				}
				?>

				<p><?php the_field('first_engaging_message'); ?></p>
				<?php
				$link = get_field('hero_cta');
				if ($link) :
					$link_url = $link['url'];
					$link_title = $link['title'];
				?>
					<a href="<?php echo $link_url; ?>"><?php echo $link_title; ?></a>
				<?php endif; ?>

				<p><?php the_field('second_engaging_message'); ?></p>
				<?php
				$link = get_field('hero_cta_2');
				if ($link) :
					$link_url = $link['url'];
					$link_title = $link['title'];
				?>
					<a href="<?php echo $link_url; ?>"><?php echo $link_title; ?></a>
				<?php endif; ?>

			</section>

			<section class="our-story">
				<h2><?php the_field('section_title'); ?></h2>
				<p><?php the_field('short_introduction') ?></p>

				<?php
				$image = get_field('our_story_image');
				$size = 'full'; // (thumbnail, medium, large, full or custom size)
				if ($image) {
					echo wp_get_attachment_image($image, $size);
				} ?>

				<?php
				$link = get_field('our_story_cta');
				if ($link) :
					$link_url = $link['url'];
					$link_title = $link['title'];
				?>
					<a href="<?php echo $link_url; ?>"><?php echo $link_title; ?></a>
				<?php endif; ?>
			</section>

			<section class="featured-products">
				<h2><?php the_field('section_title_2'); ?></h2>
				<?php
				$best_selling_products = wc_get_products(array(
					'limit'         => 5, // Number of best-selling products to display
					'status'        => 'publish',
					'orderby'       => 'popularity',
				));
				if ($best_selling_products) {
					foreach ($best_selling_products as $product) {
						// Access product details using $product object
				?>
						<article>
							<h3><?php echo esc_html($product->get_name()); ?></h3>
							<div><?php echo $product->get_price_html(); ?></div>

							<?php
							// Display product image
							$image_id = $product->get_image_id();
							$image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
							if ($image_url) {
								echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($product->get_name()) . '" />';
							}
							?>
						</article>
				<?php
					}
				}
				?>
			</section>

			<section class="our-locations">
				<h2><?php the_field('section_title_3'); ?></h2>
				<?php
				// Query location-CPT posts
				$location_posts = new WP_Query(
					array(
						'post_type' => 'cac-store-locations',
						'posts_per_page' => -1
					)
				);

				if ($location_posts->have_posts()) :
					echo '<section class="store-locations">';
					while ($location_posts->have_posts()) :
						$location_posts->the_post();

						// Fetch fields for each location

						$location_name = get_field('location_name');

						echo '<article class="store">';
						// Display location image
						$location_image_id = get_post_meta(get_the_ID(), 'location_image', true);
						if ($location_image_id) {
							$location_image_url = wp_get_attachment_image_url($location_image_id, 'full');
							echo '<img src="' . esc_url($location_image_url) . '" alt="' . esc_attr(get_the_title()) . '" />';
						}
						// Display other location details
						echo '<h3>' . esc_html($location_name) . '</h3>';
						echo '</article>';

					endwhile;
					echo '</section>';
				endif;
				wp_reset_postdata();
				?>

				<?php
				$link = get_field('contact_page_cta');
				if ($link) :
					$link_url = $link['url'];
					$link_title = $link['title'];
				?>
					<a href="<?php echo $link_url; ?>"><?php echo $link_title; ?></a>

				<?php endif; ?>
			</section>

	<?php
		}

	endwhile; // end of the loop. 
	?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
