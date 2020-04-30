<?php
/**
 * Pomocník pro odstranění diakritiky, mezer a převod na malá písmena názvů uploadovaných souborů
 *
 * @author Vladimír Smitka, Lynt.cz
 *
 */
if (!class_exists('NasWP_FileNames')) {

	class NasWP_FileNames
	{

		public function init()
		{
			add_action('sanitize_file_name', array($this, 'sanitize'));
		}

		public function sanitize($filename)
		{
			return preg_replace("/\s+/", "-", strtolower(remove_accents($filename)));
		}

	}
}
