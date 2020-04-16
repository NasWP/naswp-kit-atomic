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
		public $colors;
		public $allow_custom_colors;
		public $gradients;
		public $allow_custom_gradients;


		public function __construct($colors, $allow_custom_colors = true, $gradients = null, $allow_custom_gradients = true)
		{
			$this->colors = $colors;
			$this->allow_custom_colors = $allow_custom_colors;
			$this->gradients = $gradients;
			$this->allow_custom_gradients = $allow_custom_gradients;
		}

		public function init(){

			$editor_colors = array();
			foreach ($this->colors as $key => $value) {
				$editor_colors[] = array(
					'name' => __($key, 'naswp-kit-atomic'),
					'slug' => sanitize_title($key),
					'color' => $value,
				);
			}

			add_theme_support('editor-color-palette', $editor_colors);

			if (!$this->allow_custom_colors) {
				add_theme_support('disable-custom-colors');
			}

			$editor_gradients = array();
			foreach ($this->gradients as $key => $value) {
				$editor_gradients[] = array(
					'name' => __($key, 'naswp-kit-atomic'),
					'slug' => sanitize_title($key),
					'gradient' => $value,
				);
			}

			add_theme_support('editor-gradient-presets', $editor_gradients);

			if (!$this->allow_custom_gradients) {
				add_theme_support('disable-gradient-presets');
			}
		}

	}
}
