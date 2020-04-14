<?php
/**
 * Pomocník pro definování vlasntích barev a přechodů v Gutenbergu
 *
 * @author Vladimír Smitka, Lynt.cz
 *
 */
if (!class_exists('NasWP_Colors')) {

	class NasWP_Colors
	{

		/**
		 * Class construct method. Adds actions to their respective WordPress hooks.
		 */
		public function __construct($colors, $allow_custom_colors = true, $gradients = null, $allow_custom_gradients = true)
		{
			$editor_colors = array();
			foreach ($colors as $key => $value) {
				$editor_colors[] = array(
					'name' => __($key, 'naswp-kit-atomic'),
					'slug' => sanitize_title($key),
					'color' => $value,
				);


			}
			add_theme_support('editor-color-palette', $editor_colors);

			if (!$allow_custom_colors) {
				add_theme_support('disable-custom-colors');
			}


			$editor_gradients = array();
			foreach ($gradients as $key => $value) {
				$editor_gradients[] = array(
					'name' => __($key, 'naswp-kit-atomic'),
					'slug' => sanitize_title($key),
					'gradient' => $value,
				);


			}


			add_theme_support('editor-gradient-presets', $editor_gradients);


			if (!$allow_custom_gradients) {
				add_theme_support('disable-gradient-presets');
			}

		}

	}
}
