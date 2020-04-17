<?php
/**
 * Úpravy specifické pro konkrétní WP kit
 *
 * @author Vladimír Smitka, Lynt.cz
 *
 */
if (!class_exists('NasWP_Kit_Atomic')) {

	class NasWP_Kit_Atomic
	{

		public function __construct()
		{
			//načtení skriptů a stylů + čištění
			add_action('wp_enqueue_scripts', array($this, 'script_css_loader'), 20);
			//odstranění jQuery Migrate - používá se kvůli kompatibilitě se starými pluginy
			add_action('wp_default_scripts', array($this, 'remove_jquery_migrate'));
		}

		public function script_css_loader()
		{

			//odstranění stylu šablony - načteme později ve správném pořadí
			wp_dequeue_style( 'atomic-blocks-style' );
			wp_deregister_style( 'atomic-blocks-style' );

			//načtení stylů z rodičovksé šablony
			wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
			//načtení vlastních stylů ve správném pořadí
			wp_enqueue_style('naswp-kit-atomic', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), wp_get_theme()->get('Version'));

			//načtení vlastní osekané verze FontAwesome
			wp_enqueue_style('font-awesome-mini', get_stylesheet_directory_uri() . '/assets/css/fa-mini.css');

			//odstranění FontAwesome při použití pluginu Atomic Blocks
			wp_dequeue_style('atomic-blocks-fontawesome');
			wp_deregister_style('atomic-blocks-fontawesome');

			//odstranění FontAwesome z rodičovské šablony
			wp_dequeue_style('font-awesome');
			wp_deregister_style('font-awesome');

			//odstranění common.css z rodičovské šablony - styl máme sloučený s naším style.css pro ušetření požadavku
			wp_dequeue_style('atomic-blocks-shared-styles');
			wp_deregister_style('atomic-blocks-shared-styles');

			/* zdá se, že se načítá natvrdo ve skriptech šablony */
			//wp_dequeue_script( 'fitvids' );
		}

		public function remove_jquery_migrate($scripts)
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
	}
}
