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

		public function colors($colors, $allow_custom_colors = true, $gradients = null, $allow_custom_gradients = true)
		{
			require_once "class-colors.php";
			new NasWP_Colors($colors, $allow_custom_colors, $gradients, $allow_custom_gradients);
		}

		public function seo()
		{
			require_once "class-seo.php";
			new NasWP_SEO();
		}

		public function sitemap()
		{
			require_once "class-sitemap.php";
			new NasWP_Sitemap();
		}

		public function ga($id)
		{
			require_once "class-ga.php";
			new NasWP_GA($id);
		}

		public function gtm($id)
		{
			require_once "class-gtm.php";
			new NasWP_GTM($id);
		}

		public function mimes($formats_array)
		{
			require_once "class-mimes.php";
			new NasWP_Mimes($formats_array);
		}

		public function localization()
		{
			require_once "class-localization.php";
			new NasWP_Localization();
		}

		public function intro()
		{
			require_once "class-dashboard.php.php";
			new NasWP_Dashboard();
		}

		public function blocks_helper()
		{
			require_once "class-blocks-helper.php";
			new NasWP_Blocks_Helper();
		}


	}
}

