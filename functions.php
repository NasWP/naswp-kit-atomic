<?php 
	  
     function naswp_kit_atomic_enqueue_styles() {
 		  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
 		  }
           
           
     add_action( 'wp_enqueue_scripts', 'naswp_kit_atomic_enqueue_styles' ); 
 ?>