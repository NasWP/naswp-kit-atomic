<?php
function naswp_kit_atomic_script_css_loader()
{
	//load parent styles
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

	//Load stripped down Font Awesome
	wp_enqueue_style('font-awesome-mini', get_stylesheet_directory_uri() . '/assets/css/fa-mini.css');

	//Unload Font Awesome from atomic blocks plugin
	wp_dequeue_style('atomic-blocks-fontawesome');
	wp_deregister_style('atomic-blocks-fontawesome');

	//unload Font Awesome from atomic blocks theme
	wp_dequeue_style('font-awesome');
	wp_deregister_style('font-awesome');

	//TODO: zdá se, že se načítá natvrdo ve skriptech šablony
	//wp_dequeue_script( 'fitvids' );
}

//replace webfonts
function atomic_blocks_fonts_url()
{
	return 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,700&display=swap&subset=latin-ext';
}

//remove jQuery migrate
function naswp_remove_jquery_migrate($scripts)
{
	if (!is_admin() && isset($scripts->registered['jquery'])) {
		$script = $scripts->registered['jquery'];

		if ($script->deps) { // Check whether the script has any dependencies
			$script->deps = array_diff($script->deps, array(
				'jquery-migrate'
			));
		}
	}
}

//load scipts, css + clenup
add_action('wp_enqueue_scripts', 'naswp_kit_atomic_script_css_loader', 20);
add_action('wp_default_scripts', 'naswp_remove_jquery_migrate');

//načtení pomocných funkcí
require_once "inc/naswp-utils.php";

//načtení helperů z kitu
require_once "classes/class-naswp-helpers.php";

$helpers = new NasWP_Helpers;

/* Příklady použití helperů */
/*

$helpers->intro();

$helpers->blocks_helper();

$helpers->localization();

$helpers->seo();

$helpers->sitemap();

$helpers->ga('UA-0');

$helpers->gtm('GTM-0');

$mimes_array = array('svg' => 'image/svg+xml');

$helpers->mimes($mimes_array);


$colors = array(
	'Light' => '#EAF7FF',
	'Blue Light' => '#96D8FF',
	'Blue Dark' => '#0459AA',
	'Dark' => '#002140',
	'Blue Bright' => '#00B7FF',
);

$gradients = array(
	'Light' => 'linear-gradient(90deg, rgba(0,183,255,1) 0%, rgba(4,89,170,1) 100%)',
	'Dark' => 'linear-gradient(90deg, rgba(4,89,170,1) 0%, rgba(0,33,64,1) 100%)',
);

$helpers->colors($colors, true, $gradients, true);

*/