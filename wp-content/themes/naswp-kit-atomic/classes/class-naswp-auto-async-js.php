<?php
/**
 * Pomocník pro nastavení příznaku async pro skripty bez závislostí
 *
 * @author Vladimír Smitka, Lynt.cz
 *
 */
if (!class_exists('NasWP_AutoAsyncJS')) {

	class NasWP_AutoAsyncJS
	{
		public $debug;

		public function __construct($debug = false)
		{
			$this->debug = $debug;
		}

		public function init()
		{
			add_filter('script_loader_tag', array($this, 'async_attr'), 10, 3);
		}

		public function async_attr($tag, $handle, $src)
		{
			global $wp_scripts;

			$debug = '';
			$dependency = false;
			if ($this->debug) {
				$debug = '<!-- JS Handle: ' . $handle . '-->';
			}

			foreach ($wp_scripts->registered as $script) {
				if (in_array($handle, $script->deps)) {
					$dependency = true;
					break;
				}
			}

			if (!$dependency) {
				return $debug . str_replace('src=', 'async src=', $tag);
			}
			return $debug . $tag;

		}

	}
}
