<?php
	if(!function_exists('load_theme_styles')) {
	    function load_theme_styles() {
	        if (!is_admin())
	        {
	            wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), null, 'all' );
	        }
	    }
	}
	add_action('wp_enqueue_scripts', 'load_theme_styles');
?>