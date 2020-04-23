<?php

require_once "classes/class-naswp-kit-atomic.php";
$kit = new NasWP_Kit_Atomic();

require_once "inc/naswp-atomic-custom.php";
require_once "inc/naswp-utils.php";


require_once "settings.php";
$settings = new NasWP_Settings();


require_once "classes/class-naswp-helpers.php";
$helpers = new NasWP_Helpers();

/* Příklady použití helperů */
/*
$helpers->dashboard_tips();

$helpers->blocks_helper();

$helpers->localization($settings->languages ,$settings->menus, $settings->sidebars);

$helpers->seo();

$helpers->sitemap();

$helpers->ga('UA-0');

$helpers->gtm('GTM-0');

$helpers->mimes($settings->mimes);

$helpers->colors($settings->colors, true, $settings->gradients, true);

$helpers->lightbox();

$helpers->protected_member();
*/
