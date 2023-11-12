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

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php if (have_posts()): ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php post_type_archive_title(); ?>
				</h1>
			</header>

			<?php

		// 	while (have_posts()):
		// 		the_post();
	
		// 		// Include the content template
		// 		get_template_part('template-parts/content', 'archive');
	
		// 	endwhile;
	

		// else:
	
		// 	// If no content, include the "No posts found" template.
		// 	get_template_part('template-parts/content', 'none');
	
	endif;
	?>

		<?php

		$args = array(
			'post_type' => 'cac-careers',
			'posts_per_page' => -1,
		);

		$careers_query = new WP_Query($args);

		if ($careers_query->have_posts()):
			while ($careers_query->have_posts()):
				$careers_query->the_post();

				$location_name = get_field('location_name');
				$job_descriptions = get_field('job_descriptions');
				//dont need
				$job_requirements = get_field('job_requirements');
				$job_cta = get_field('job_cta');

				echo '<div class="job-description">';
				echo '<h2>' . esc_html(get_the_title()) . '</h2>';
				echo '<p>' . esc_html($location_name) . '</p>';
				echo '<p><strong>Description:</strong> ' . esc_html($job_descriptions) . '</p>';
				echo '<p>Requirements: ' . esc_html($job_requirements) . '</p>';
				echo '<a href="' . esc_url($job_cta) . '">Apply Now</a>';
				echo '</div>';

			endwhile;

			wp_reset_postdata();
		else:
			echo 'No Careers found.';
		endif;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>