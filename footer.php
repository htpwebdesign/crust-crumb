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
	<div class="footer-left-section">
		<!-- <ul class="team-list">

			<li><a href="<?php echo esc_url(__('link_to_linkedin_profile_1')); ?>">
					<?php esc_html_e('Team Member 1', 'crust-crumb'); ?>
				</a></li>
			<li><a href="<?php echo esc_url(__('link_to_linkedin_profile_2')); ?>">
					<?php esc_html_e('Team Member 2', 'crust-crumb'); ?>
				</a></li>
			<li><a href="<?php echo esc_url(__('link_to_linkedin_profile_3')); ?>">
					<?php esc_html_e('Team Member 3', 'crust-crumb'); ?>
				</a></li>
			<li><a href="<?php echo esc_url(__('link_to_linkedin_profile_4')); ?>">
					<?php esc_html_e('Team Member 4', 'crust-crumb'); ?>
				</a></li>
			<li><a href="<?php echo esc_url(__('link_to_linkedin_profile_5')); ?>">
					<?php esc_html_e('Team Member 5', 'crust-crumb'); ?>
				</a></li>
		</ul> -->
	
		<h2>About Crust and Crumb</h2>
		<p class='about-us-brief'>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
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
	</div><!-- .footer-menus -->
	
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>