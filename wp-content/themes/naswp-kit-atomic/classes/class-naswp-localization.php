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

		public $menu_replaces;
		public $sidebar_replaces;
		public $sidebars;


		public function __construct($menu_replaces_array, $sidebar_replaces_array)
		{
			$this->menu_replaces = $menu_replaces_array;
			$this->sidebar_replaces = $sidebar_replaces_array;
			add_action('init', array($this, 'load_sidebars'));
		}

		public function init()
		{
			add_action('locale', array($this, 'set_locale'));
			add_action('widgets_init', array($this, 'register_sidebars'));
			add_filter('sidebars_widgets', array($this, 'switch_sidebars'));
			add_filter('wp_nav_menu_args', array($this, 'switch_menus'));
		}

		function load_sidebars()
		{
			global $wp_registered_sidebars;
			foreach ($wp_registered_sidebars as $sidebar) {
				$this->sidebars[$sidebar['id']] = $sidebar['name'];
			}
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

			foreach ($this->sidebar_replaces as $sidebar){
				register_sidebar(array(
					'name' => __($this->sidebars[$sidebar].' EN', 'naswp-kit-atomic'),
					'id' => $sidebar.'-en'
				));
			}
		}

		//TODO: prozatím statický koncept
		public function switch_sidebars($widgets)
		{

			foreach ($this->sidebar_replaces as $sidebar) {
				$original = $sidebar;
				$new = $sidebar . '-en';

				if (naswp_is_lang('en') && isset($widgets[$original]) && isset($widgets[$new])) {
					$widgets[$original] = $widgets[$new];
				}
			}
			return $widgets;
		}

		public function switch_menus($args)
		{
			foreach ($this->menu_replaces as $key => $value) {
				if (naswp_is_lang('en') && $args['theme_location'] === $key) {
					$args['menu'] = $value;
				}
			}
			return $args;
		}
	}
}
