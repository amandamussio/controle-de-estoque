<?php 

/*-----------------------------------------------------------------------------------*/
/*  Register Menu
/*-----------------------------------------------------------------------------------*/ 
register_nav_menu( 'menu-main', 'Menu principal da aplicação' );

/*-----------------------------------------------------------------------------------*/
/*  Support Thumbnails
/*-----------------------------------------------------------------------------------*/ 
add_theme_support( 'post-thumbnails' );

/*-----------------------------------------------------------------------------------*/
/*  Image Size
/*-----------------------------------------------------------------------------------*/ 
add_image_size( 'thumb-cliente', '50','50', true);

/*-----------------------------------------------------------------------------------*/
/*  Register Scripts
/*-----------------------------------------------------------------------------------*/ 
require_once(get_template_directory() . '/functions/load-theme-styles.php');
require_once(get_template_directory() . '/functions/load-theme-scripts.php');

/*-----------------------------------------------------------------------------------*/
/*	Include Custom Post Type
/*-----------------------------------------------------------------------------------*/	
require_once ( get_template_directory() . '/includes/clientes-post-type.php' );
require_once ( get_template_directory() . '/includes/produtos-post-type.php' );
require_once ( get_template_directory() . '/includes/pedidos-post-type.php' );
