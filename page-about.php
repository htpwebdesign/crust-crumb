<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Crust_&_Crumb_Bakery
 */

get_header();
?>

	<main id="primary" class="site-main">
		
		<figure class="hero-banner">
			<?php
			while ( have_posts() ) : the_post();
			// Directly display the WordPress page title
			the_title('<h1>', '</h1>');
			$image = get_field('hero_iamge');
					$size = 'full'; // (thumbnail, medium, large, full or custom size)
					if( $image ) {
						echo wp_get_attachment_image( $image, $size, false, array("class" => "hero-image") );
					}?>
		</figure>

				<?php

			endwhile;
			?>
	
		<section class="story-introduction">
			<h2><?php the_field('section_heading');?></h2>
			<p><?php the_field('content');?></p>
		</section>

		<section class="career-timeline">

			<?php
			if( have_rows('career_timeline') ):

				// loop through the rows of data
				while ( have_rows('career_timeline') ) : the_row();

					$image = get_sub_field('milestone_image');
					$size = 'full'; // (thumbnail, medium, large, full or custom size)
					if( $image ) {
						echo wp_get_attachment_image( $image, $size );
					}?>
					
					<h2><?php the_sub_field('milestone_title'); ?></h2>
				<?php
				endwhile;
	
			endif;
			?>
		</section>

		<section class="more-about-us">
			<h2><?php the_field('sub_heading'); ?></h2>
			<p><?php the_field('sub_content') ?></p>
			<?php 
			$image = get_field('illustration_image');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)
			if( $image ) {
				echo wp_get_attachment_image( $image, $size );
			}
	
			$link = get_field('cta');
			if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				?>
				<a href="<?php echo $link_url; ?>"><?php echo $link_title; ?></a>
			<?php endif; ?>
		</section>



		<section class="more-about-us">
			<h2><?php the_field('sub_heading_2'); ?></h2>
			<p><?php the_field('sub_content_2');?></p>
	
			<?php
			$image = get_field('illustration_image_2');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)
			if( $image ) {
				echo wp_get_attachment_image( $image, $size );
			}?>
	
			<?php
			$link = get_field('cta_2');
			if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				?>
			<a href="<?php echo $link_url; ?>"><?php echo $link_title; ?></a>
	
			</section>
			<?php endif; 


		  ?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
