<?php
/**
 * The main functions file.
 *
 * @package NášWP Kit Atomic
 */

/**
 * Handle scripts and styles for the child theme
 *
 * @return void
 */
function naswp_kit_atomic_script_css_loader() {
	// Load parent styles.
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

	// Unload Font Awesome from Atomic blocks plugin.
	wp_dequeue_style( 'atomic-blocks-fontawesome' );
	wp_deregister_style( 'atomic-blocks-fontawesome' );
}

add_action( 'wp_enqueue_scripts', 'naswp_kit_atomic_script_css_loader' );

