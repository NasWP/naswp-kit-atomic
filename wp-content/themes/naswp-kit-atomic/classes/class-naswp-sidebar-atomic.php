<?php
/**
 * Registruje sidebar pro zobrazení widgetů vlevo/vpravo
 *
 * @author Vladimír Smitka, Lynt.cz
 *
 */
if (!class_exists('NasWP_Sidebar')) {

	class NasWP_Sidebar
	{

		public function init()
		{
			add_action('widgets_init', array($this, 'register_sidebar'));
			//add_action('template_include', array($this, 'register_template'));
		}


		public function register_sidebar()
		{
			register_sidebar(array(
				'name' => __('Sidebar', 'naswp-kit-atomic'),
				'id' => 'primary-sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => "</div>\n",
				'before_title' => '<h2 class="widget-title">',
				'after_title' => "</h2>\n",
			));

		}
	}
}
