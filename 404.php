<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Crust_&_Crumb_Bakery
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'crust-crumb' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'crust-crumb' ); ?></p>

					<?php
					get_search_form();

					?>

					<h2>Go to <a href="<?php echo esc_url(home_url('/')); ?>">Home</a> or <a href="<?php echo esc_url(home_url('/shop')); ?>">Menu</a> page.</h2>


			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
