<?php
/* Do tohoto souboru patří funkce pro vlastní úpravy šablony */

//vlastní fonty
function atomic_blocks_fonts_url()
{
	return 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,700&display=swap&subset=latin-ext';
}

//úprava resource hints pro načítání google fontů
function naswp_resource_hints($hints, $relation_type)
{
	if ($relation_type === 'preconnect') {
		$hints[] = '//fonts.gstatic.com';
		$hints[] = '//fonts.googleapis.com';

		if ($relation_type === 'dns-prefetch') {
			$urls = array('fonts.googleapis.com', 'fonts.gstatic.com');

			foreach ($urls as $url) {
				if (($key = array_search($url, $hints)) !== false) {
					unset($hints[$key]);
				}
			}
		}
	}
	return $hints;
}

add_filter('wp_resource_hints', 'naswp_resource_hints', 10, 2);

//typo demo - ukázka použitých komponent
function naswp_typo_demo()
{
	?>
	<p>demo</p>
	<?php
}
