<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Crust_&_Crumb_Bakery
 */

?>

<footer id="colophon" class="site-footer">
	<!-- Output the secondary logo -->
	<?php
	$secondary_logo_url = get_theme_mod('secondary-logo');

	if ($secondary_logo_url) {
		// Get the homepage URL
		$homepage_url = esc_url(home_url('/'));

		// Output the anchor tag with the secondary logo
		echo '<a class="secondary-logo-link" href="' . $homepage_url . '"><img src="' . $secondary_logo_url . '" alt="secondary logo" class="secondary-logo"></a>';
	}
	?>
	<div class='footer-flex-box'>
		<div class="footer-left-section">

			<h2>About Crust and Crumb</h2>
			<?php
			if (function_exists('get_field')) {
				if (get_field('about_us_footer', 25)) {
					echo '<p class="about-us-brief">' . get_field('about_us_footer', 25) . '</p>';
				}
			}
			?>
			<?php $year = (new DateTime)->format("Y"); ?>
			<p class='copy-right'>&copy; <?php echo $year; ?> Made by U.B.w.C</p>
		</div>
		<div class="footer-right-section">
			<nav class="footer-navigation">
				<?php wp_nav_menu(array('theme_location' => 'footer-left')); ?>

			</nav>

			<nav class='footer-navigation'>
				<?php wp_nav_menu(array('theme_location' => 'footer-right')); ?>
			</nav>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>