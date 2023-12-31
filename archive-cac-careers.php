<?php
/**
 * The template for displaying Careers Archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Crust_&_Crumb_Bakery
 */

get_header();
?>


<main id="main" class="site-main">

	<?php if (have_posts()): ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php post_type_archive_title(); ?>
			</h1>
		</header>

	<?php endif; ?>
	<section class="job-postings">
		<?php
		$args = array(
			'post_type' => 'cac-careers',
			'posts_per_page' => -1,
		);

		$careers_query = new WP_Query($args);

		if ($careers_query->have_posts()): ?>

			<form class="career-location-radio">
				<?php
				$store_locations = get_posts(
					array(
						'post_type' => 'cac-careers',
						'posts_per_page' => -1,
						'meta_key' => 'location_name',
						'fields' => 'ids',
						'orderby' => 'meta_value',
						'order' => 'ASC',
					)
				);
				?>
				<label>
					<input type="radio" name="location" value="All" checked class="is-checked"> All
				</label>
				<?php
				//array_unique removes all duplicates and array_map takes the post id and returns the location name 
				if (function_exists("get_field")) {
					$store_locations = array_unique(array_map(function ($post_id) {
						return get_field('location_name', $post_id);
					}, $store_locations));

					// Output radio buttons
					foreach ($store_locations as $location): ?>
						<label>
							<input type="radio" name="location" value="<?php echo esc_attr($location); ?>">
							<?php echo esc_html($location); ?>
						</label>
					<?php endforeach; ?>


				</form>

				<div id="filtered-jobs">
					<?php
					while ($careers_query->have_posts()):
						$careers_query->the_post();

						$location_name = get_field('location_name');
						$job_descriptions = get_field('job_descriptions');
						$job_cta = get_field('job_cta');

						// Add a class based on location to each job-information div
						echo '<article tabindex="0" class="job-information accordion-container location-' . sanitize_title($location_name) . ' fade-up ">';
						echo '<h2  class="accordionTitle">' . esc_html(get_the_title());
						echo '<span class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 9h-9v-9h-6v9h-9v6h9v9h6v-9h9z"/></svg></span></h2>';
						echo '<div class="accordionContent">';
						echo '<b class="career-location">' . esc_html($location_name) . '</b>';
						echo $job_descriptions;
						echo '<p><span id="apply-message">To apply:</span> Please fill in the form below.</p>';
						echo '</div>';
						echo '</article>';

					endwhile;
				}
				wp_reset_postdata();

				?>
			</div>

		<?php else:
			echo 'No Careers found.';
		endif;
		?>
	</section>
	<section class="form-wrapper">
		<h2>Want to work with us?</h2>
		<?php
		// Embed Gravity Form 
		
		if (function_exists('gravity_form')) {
			gravity_form(5, false, false, false, '', false);
		}
		?>
	</section>
</main><!-- #main -->


<?php
get_footer();
?>