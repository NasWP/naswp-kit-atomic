<?php
/**
 * Pomocník pro zobrazení tipů na WP nástěnce
 *
 * Odkazy na články
 * Instalace užitečných pluginů
 *
 * @author Vladimír Smitka, Lynt.cz
 *
 * TODO možná informace stahovat z centrálního úložiště (githubu) a cachovat je lokálně
 */
if (!class_exists('NasWP_Dashboard')) {
	class NasWP_Dashboard
	{

		public function init()
		{
			add_action('wp_dashboard_setup', array($this, 'dashboard_widgets'));
		}

		public function dashboard_widgets()
		{
			global $wp_meta_boxes;

			wp_add_dashboard_widget('naswp_widget', 'NášWP WordPress Kit', array($this, 'dashboard_intro'));
		}

		public function dashboard_intro()
		{
			echo '<p>Používáte WP Kit Atomic od NášWP!</p>';
			echo "<h4>Návody</h4>";
			echo "<li>Představení WP Kitu Atomic</li>";
			echo "<li>Nastavení Analytiky</li>";
			echo "<h4>Užitečné pluginy</h4>";
			$plugins = array('wp-super-cache', 'contact-form-7', 'two-factor');

			foreach ($plugins as &$plugin_name) {
				echo '<li><a href="' . esc_url(network_admin_url('plugin-install.php?tab=plugin-information&plugin=' . $plugin_name . '&TB_iframe=true&width=600&height=550')) . '" class="thickbox" title="More info about ' . $plugin_name . '">Instalovat ' . $plugin_name . '</a></li>';
			}
		}
	}
}
