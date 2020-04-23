<?php

require_once "classes/class-naswp-kit-atomic.php";

$kit = new NasWP_Kit_Atomic();

require_once "inc/naswp-atomic-custom.php";
require_once "inc/naswp-utils.php";

require_once "classes/class-naswp-helpers.php";

$helpers = new NasWP_Helpers;

/* Příklady použití helperů */
/*
$helpers->dashboard_tips();

$helpers->blocks_helper();

$languages = array(
	'en' => 'en_US',
	'de' => 'de_DE',
);

$menus = array(
	'en' => array(
    	'primary' => 4,
		),
	'de' => array(
    	'primary' => 5,
		),
);

$sidebars = array(
    'footer-1' => 'Footer - Column 1',
    'footer-2' => 'Footer - Column 2',
    'footer-3' => 'Footer - Column 3',
);



$helpers->localization($languages ,$menus, $sidebars);

$helpers->seo();

$helpers->sitemap();

$helpers->ga('UA-0');

$helpers->gtm('GTM-0');

$mimes_array = array('svg' => 'image/svg+xml');

$helpers->mimes($mimes_array);

$colors = array(
	'Light' => '#EAF7FF',
	'Blue Light' => '#96D8FF',
	'Blue Dark' => '#0459AA',
	'Dark' => '#002140',
	'Blue Bright' => '#00B7FF',
);

$gradients = array(
	'Light' => 'linear-gradient(90deg, rgba(0,183,255,1) 0%, rgba(4,89,170,1) 100%)',
	'Dark' => 'linear-gradient(90deg, rgba(4,89,170,1) 0%, rgba(0,33,64,1) 100%)',
);

$helpers->colors($colors, true, $gradients, true);

$helpers->lightbox();

$helpers->protected_member();
*/
