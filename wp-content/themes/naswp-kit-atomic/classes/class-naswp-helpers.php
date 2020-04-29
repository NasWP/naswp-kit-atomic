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


		/* Jednotlivé helpery */
		public function colors($colors, $allow_custom_colors = true, $gradients = null, $allow_custom_gradients = true)
		{
			require_once "class-naswp-colors.php";
			$colors_obj = new NasWP_Colors($colors, $allow_custom_colors, $gradients, $allow_custom_gradients);
			$colors_obj->init();
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

		public function localization($languages_array, $menu_replaces_array, $sidebar_replaces_array)
		{
			require_once "class-naswp-localization.php";
			$localization = new NasWP_Localization($languages_array, $menu_replaces_array, $sidebar_replaces_array);
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
			require_once "class-naswp-sidebar-atomic.php";
			$sidebar = new NasWP_Sidebar();
			$sidebar->init();
		}

		public function auto_async_js()
		{
			require_once "class-naswp-auto-async-js.php";
			$async = new NasWP_AutoAsyncJS();
			$async->init();
		}

	}
}
