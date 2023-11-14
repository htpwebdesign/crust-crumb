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

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		<?php while ( have_posts() ) : the_post();

		$image = get_field('hero_iamge');
				$size = 'full'; // (thumbnail, medium, large, full or custom size)
				if( $image ) {
					echo wp_get_attachment_image( $image, $size );
				}

			if( have_rows('career_timeline') ):

			// loop through the rows of data
			while ( have_rows('career_timeline') ) : the_row();

				$image = get_sub_field('milestone_image');
				$size = 'full'; // (thumbnail, medium, large, full or custom size)
				if( $image ) {
					echo wp_get_attachment_image( $image, $size );
				}?>
				
				<h3><?php the_sub_field('milestone_title'); ?></h3>

				<?php

			endwhile;

		else :

			// no rows found

		endif;
		?>

		<h2><?php the_field('section_heading');?></h2>
		<p><?php the_field('content');?></p>

		<h3><?php the_field('sub_heading'); ?></h3>
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

		<h3><?php the_field('sub_heading_2'); ?></h3>
		<p><?php the_field('sub_content_2') ?></p>

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

		<?php endif; ?>



		<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
