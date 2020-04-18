<?php
/**
 * Hlavní třída pro načítání pomocníků - mapování tříd na funkce
 *
 * @author Vladimír Smitka, Lynt.cz
 *
 */
if (!class_exists('NasWP_Helpers')) {
	class NasWP_Helpers
	{
		//TODO udělat registr inicializovaných tříd pro přístup ke stavu a dalším funkcím

		/* Úpravy specifické pro konkrétní WP kit */

		public function setup()
		{
			//načtení skriptů a stylů + čištění
			add_action('wp_enqueue_scripts', array($this, 'script_css_loader'), 20);
			//odstranění jQuery Migrate - používá se kvůli kompatibilitě se starými pluginy
			add_action('wp_default_scripts', array($this, 'remove_jquery_migrate'));
		}

		public function script_css_loader()
		{
			//načtení stylů z rodičovksé šablony
			wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
			//načtení vlastních stylů ve správném pořadí
			wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), wp_get_theme()->get('Version'));

			//načtení vlastní osekané verze FontAwesome
			wp_enqueue_style('font-awesome-mini', get_stylesheet_directory_uri() . '/assets/css/fa-mini.css');

			//odstranění FontAwesome při použití pluginu Atomic Blocks
			wp_dequeue_style('atomic-blocks-fontawesome');
			wp_deregister_style('atomic-blocks-fontawesome');

			//odstranění FontAwesome z rodičovské šablony
			wp_dequeue_style('font-awesome');
			wp_deregister_style('font-awesome');

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

		/* Jednotlivé helpery */
		public function colors($colors, $allow_custom_colors = true, $gradients = null, $allow_custom_gradients = true)
		{
			require_once "class-naswp-colors.php";
			new NasWP_Colors($colors, $allow_custom_colors, $gradients, $allow_custom_gradients);
		}

		public function seo()
		{
			require_once "class-naswp-seo.php";
			$seo = new NasWP_SEO();
			$seo->init();
		}

		public function sitemap()
		{
			require_once "class-naswp-sitemap.php";
			$sitemap = new NasWP_Sitemap();
			$sitemap->init();

		}

		public function ga($id)
		{
			require_once "class-naswp-ga.php";
			$ga = new NasWP_GA($id);
			$ga->init();
		}

		public function gtm($id)
		{
			require_once "class-naswp-gtm.php";
			$gtm = new NasWP_GTM($id);
			$gtm->init();
		}

		public function mimes($formats_array)
		{
			require_once "class-naswp-mimes.php";
			$mimes = new NasWP_Mimes($formats_array);
			$mimes->init();
		}

		public function localization()
		{
			require_once "class-naswp-localization.php";
			$localization = new NasWP_Localization();
			$localization->init();
		}

		public function dashboard_tips()
		{
			require_once "class-naswp-dashboard.php";
			$dashboard = new NasWP_Dashboard();
			$dashboard->init();
		}

		public function blocks_helper()
		{
			require_once "class-naswp-blocks-helper.php";
			$blocks_helper = new NasWP_Blocks_Helper();
			$blocks_helper->init();
		}

		public function lightbox()
		{
			require_once "class-naswp-lightbox.php";
			$lightbox = new NasWP_Lightbox();
			$lightbox->init();
		}

		public function protected_member($protected_prefix = false)
		{
			require_once "class-naswp-protected-member.php";
			$protected_member = new NasWP_Protected_Member($protected_prefix);
			$protected_member->init();
		}

		public function sidebar()
		{
			require_once "class-naswp-sidebar.php";
			$sidebar = new NasWP_Sidebar();
			$sidebar->init();
		}
	}
}

