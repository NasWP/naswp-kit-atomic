<?php
/**
 * Pomocník pro povolení uploadu vybranách souborů dle jejich koncovky a mime-type
 *
 * @author Vladimír Smitka, Lynt.cz
 *
 */
if (!class_exists('NasWP_Mimes')) {

	class NasWP_Mimes
	{
		private $mimes;

		/**
		 * Class construct method. Adds actions to their respective WordPress hooks.
		 */
		public function __construct($mimes_array)
		{
			$this->mimes = $mimes_array;
		}


		public function init()
		{
			add_filter('upload_mimes', array($this, 'mime_types'));
		}

		public function mime_types($mimes)
		{
			if (current_user_can('manage_options')) {
				$mimes = array_merge($mimes, $this->mimes);
			}
			return $mimes;
		}

	}
}
