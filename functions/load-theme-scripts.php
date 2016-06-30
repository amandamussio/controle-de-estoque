<?php

if(!function_exists('load_theme_scripts')) {
    function load_theme_scripts() {
        if (!is_admin())
        {
        	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.js', array(), null, true);
        	wp_enqueue_script( 'bootstrap-menu', get_template_directory_uri() . '/assets/js/dropdown.js', array(), null, true);
        	wp_enqueue_script( 'collapse', get_template_directory_uri() . '/assets/js/collapse.js', array(), null, true);
        }
    }
}
add_action('wp_enqueue_scripts', 'load_theme_scripts');
?>