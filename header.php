<html class="no-js" <?php language_attributes(); ?>>
<head>

	<!-- O charset padrão -->
	<meta charset="<?php bloginfo('charset'); ?>">

	<!-- busca o título do site dinamicamente direto do wordpress -->
	<title><?php wp_title(); ?></title>

	<!-- layout responsivo -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- busca o css na pasta -->
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

	<!-- busca o favicon na pasta -->
	<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="shortcut icon" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- HEADER -->
	<header id="header" role="banner">
		<!-- container -->
		<div class="container">
		
			<div id="main-navigation" class="navbar navbar-default">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-navigation">
					<span class="sr-only"><?php _e( 'Toggle navigation', 'odin' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand visible-xs-block" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</div>
				<nav class="collapse navbar-collapse navbar-main-navigation" role="navigation">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-main',
								'depth'          => 2,
								'container'      => false,
								'menu_class'     => 'nav navbar-nav'
							)
						);
					?>
				</nav><!-- .navbar-collapse -->
			</div><!-- #main-navigation-->

		</div><!-- .container-->
	</header>
	<!-- /HEADER -->

	 <!-- CONTAINER -->
	<div class="container">

		<!-- CHAMADA-->
		<div class="jumbotron">
		  <h1><?php bloginfo( 'name' ); ?></h1>
		  <p><?php bloginfo( 'description' ); ?></p>
		</div>
		<!-- /CHAMADA-->