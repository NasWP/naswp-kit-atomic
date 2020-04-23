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
 * TODO: ošetřit, zda jsou jazyky správně nadefinované
 */
if (!class_exists('NasWP_Localization')) {

	class NasWP_Localization
	{

		public $menu_replaces;
		public $sidebar_replaces;
		public $languages;


		public function __construct($languages_array, $menu_replaces_array, $sidebar_replaces_array)
		{
			$this->languages = $languages_array;
			$this->menu_replaces = $menu_replaces_array;
			$this->sidebar_replaces = $sidebar_replaces_array;
		}

		public function init()
		{
			add_action('locale', array($this, 'set_locale'));
			add_action('widgets_init', array($this, 'register_sidebars'));
			add_filter('sidebars_widgets', array($this, 'switch_sidebars'));
			add_filter('wp_nav_menu_args', array($this, 'switch_menus'));
		}

		public function set_locale($locale)
		{

			foreach ($this->languages as $slug => $lang) {
				if (naswp_is_lang($slug)) {
					return $lang;
				}
			}

			return $locale;
		}


		public function register_sidebars()
		{
			foreach ($this->languages as $slug => $lang) {
				foreach ($this->sidebar_replaces as $key => $value) {
					register_sidebar(array(
						'name' => __($value . ' ' . strtoupper($slug), 'naswp-kit-atomic'),
						'id' => $key . '-' . $slug
					));
				}
			}
		}

		public function switch_sidebars($widgets)
		{
			foreach ($this->languages as $slug => $lang) {
				foreach ($this->sidebar_replaces as $key => $value) {
					$original = $key;
					$new = $key . '-' . $slug;

					if (naswp_is_lang($slug) && isset($widgets[$original]) && isset($widgets[$new])) {
						$widgets[$original] = $widgets[$new];
					}
				}
			}
			return $widgets;
		}

		public function switch_menus($args)
		{
			foreach ($this->languages as $slug => $lang) {
				foreach ($this->menu_replaces[$slug] as $key => $value) {
					if (naswp_is_lang($slug) && $args['theme_location'] === $key) {
						$args['menu'] = $value;
					}
				}
			}
			return $args;
		}
	}
}
