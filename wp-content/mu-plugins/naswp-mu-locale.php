<?php
/* MU plugin pro brzké nastavení lokalizace */

function naswp_set_locale($locale)
{

	require_once get_stylesheet_directory() . '/settings.php';
	require_once get_stylesheet_directory() . '/inc/naswp-utils.php';

	$settings = new NasWP_Settings();

	foreach ($settings->languages as $slug => $lang) {
		if (naswp_is_lang($slug)) {
			return $lang;
		}
	}

	return $locale;
}


if (file_exists(get_stylesheet_directory() . '/settings.php') && file_exists(get_stylesheet_directory() . '/inc/naswp-utils.php')) {
	add_action('locale', 'naswp_set_locale');
}


