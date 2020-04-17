<?php
/**
 * Pomocník pro překlady webu
 *
 * Detekuje jazyk podle URL:
 * změní WP locale
 * provede přehození menu
 * definuje nové sidebary a přehodí je
 *
 * @author Vladimír Smitka, Lynt.cz
 *
 *
 * TODO: zatím je to beta, bude třeba nadefinovat volitelná pravidla pro přehazování a podporu dalších jazyků
 */
if (!class_exists('NasWP_Localization')) {

	class NasWP_Localization
	{

		public function init()
		{
			add_action('locale', array($this,'set_locale'));
			add_action('widgets_init',  array($this,'register_sidebars'));
			add_filter('sidebars_widgets',  array($this,'switch_sidebars'));
			add_filter('wp_nav_menu_args',  array($this,'switch_menus'));


		}

		public function set_locale($locale)
		{

			if (naswp_is_lang('en')) {
				$locale = 'en_US';
			}

			return $locale;
		}

		//TODO: prozatím statický koncept
		public function register_sidebars()
		{

			register_sidebar(array(
				'name' => __('Footer - Column 1 EN', 'naswp-kit-atomic'),
				'id' => 'footer-1-en'
			));


			register_sidebar(array(
				'name' => __('Footer - Column 2 EN', 'naswp-kit-atomic'),
				'id' => 'footer-2-en'
			));

			register_sidebar(array(
				'name' => __('Footer - Column 3 EN', 'naswp-kit-atomic'),
				'id' => 'footer-3-en'
			));

		}

		//TODO: prozatím statický koncept
		public function switch_sidebars($widgets)
		{

			$original = 'footer-1';
			$new = 'footer-1-en';

			if (naswp_is_lang('en') && isset($widgets[$original]) && isset($widgets[$new])) {
				$widgets[$original] = $widgets[$new];
			}


			$original = 'footer-2';
			$new = 'footer-2-en';

			if (naswp_is_lang('en') && isset($widgets[$original]) && isset($widgets[$new])) {
				$widgets[$original] = $widgets[$new];
			}


			$original = 'footer-3';
			$new = 'footer-3-en';

			if (naswp_is_lang('en') && isset($widgets[$original]) && isset($widgets[$new])) {
				$widgets[$original] = $widgets[$new];
			}

			return $widgets;
		}


		//TODO: prozatím statický koncept
		public function switch_menus($args)
		{

			$new_id = 3;

			if (naswp_is_lang('en') && $args['theme_location'] === 'primary') {
				$args['menu'] = $new_id;
			}

			return $args;
		}


	}
}
