<?php 
    function naswp_kit_atomic_script_css_loader() {
 	    //load parent styles
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        
        //unload font awesome from atomic blocks plugin
        wp_dequeue_style('atomic-blocks-fontawesome');
        wp_deregister_style('atomic-blocks-fontawesome');
    }
    
    
    
    add_action( 'wp_enqueue_scripts', 'naswp_kit_atomic_script_css_loader' ); 
 ?>