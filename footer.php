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
	<div class="footer-menus">
		<nav class="footer-navigation">
			<?php wp_nav_menu(array('theme_location' => 'footer-left')); ?>

		</nav>

		<nav class='footer-navigation'>
			<?php wp_nav_menu(array('theme_location' => 'footer-right')); ?>
		</nav>
	</div><!-- .footer-menus -->
	<div class="site-info">
		<ul class="team-list">


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
		</ul>
		<!-- need to make privacy policy page -->
		<p>
			<?php the_privacy_policy_link() ?>
		<p>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>