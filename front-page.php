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

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	<?php while ( have_posts() ) : the_post(); ?>

	<img src="<?php the_field('hero_product_image'); ?>" />

	<p><?php the_field('first_engaging_message');?></p>
	<?php
	$link = get_field('hero_cta');
	if( $link ): 
		$link_url = $link['url'];
		$link_title = $link['title'];
		?>
		<a href="<?php echo $link_url; ?>"><?php echo $link_title; ?></a>
	<?php endif; ?>

	<p><?php the_field('second_engaging_message'); ?></p>
	<?php
	$link = get_field('hero_cta_2');
	if( $link ): 
		$link_url = $link['url'];
		$link_title = $link['title'];
		?>
		<a href="<?php echo $link_url; ?>"><?php echo $link_title; ?></a>
	<?php endif; ?>

	<p><?php the_field('slogan_message');?></p>



	<h2><?php the_field('section_title'); ?></h2>
	<p><?php the_field('short_introduction') ?></p>
	<img src="<?php the_field('our_story_image'); ?>" />

	<?php
	$link = get_field('our_story_cta');
	if( $link ): 
		$link_url = $link['url'];
		$link_title = $link['title'];
		?>
	<a href="<?php echo $link_url; ?>"><?php echo $link_title; ?></a>

	<?php endif; ?>
	<h3><?php the_field('section_title_2'); ?></h3>
	<h4><?php the_field('section_title_3'); ?></h4>

	<?php
	$link = get_field('contact_page_cta');
	if( $link ): 
		$link_url = $link['url'];
		$link_title = $link['title'];
		?>
	<a href="<?php echo $link_url; ?>"><?php echo $link_title; ?></a>

	<?php endif; 

	endwhile; // end of the loop. ?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
