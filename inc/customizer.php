<?php
/**
 * Crust & Crumb Bakery Theme Customizer
 *
 * @package Crust_&_Crumb_Bakery
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function crust_crumb_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
	$wp_customize->add_setting('secondary-logo');

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'crust_crumb_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'crust_crumb_customize_partial_blogdescription',
			)
		);
	}

	// Add control for secondary logo
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'secondary-logo', array(
		'label'    => __('Secondary Logo', 'crust_crumb'),
		'section'  => 'title_tagline',
		'settings' => 'secondary-logo',
	)));
}
add_action('customize_register', 'crust_crumb_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function crust_crumb_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function crust_crumb_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function crust_crumb_customize_preview_js() {
	wp_enqueue_script( 'crust-crumb-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'crust_crumb_customize_preview_js' );
