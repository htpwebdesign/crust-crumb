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
	</div>
	<div class="footer-menus">
		<nav class="footer-navigation">
			<?php wp_nav_menu(array('theme_location' => 'footer-left')); ?>

		</nav>

		<nav class='footer-navigation'>
			<?php wp_nav_menu(array('theme_location' => 'footer-right')); ?>
		</nav>
	</div><!-- .footer-menus -->
	<div class="site-info">

		<a href="<?php echo esc_url(__('https://wordpress.org/', 'crust-crumb')); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf(esc_html__('Proudly powered by %s', 'crust-crumb'), 'WordPress');
			?>
		</a>
		<span class="sep"> | </span>
		<?php
		/* translators: 1: Theme name, 2: Theme author. */
		printf(esc_html__('Theme: %1$s by %2$s.', 'crust-crumb'), 'crust-crumb', '<a href="https://crustandcrumb.bcitwebdeveloper.ca/">FWD 34</a>');
		?>
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