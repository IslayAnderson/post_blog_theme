<!doctype html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php wp_title(''); ?></title>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php /*
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png"> 
		<meta name="theme-color" content="#121212">

		*/?>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body class="govuk-template__body js-enabled govuk-frontend-supported <?= get_body_class(); ?>" itemscope itemtype="http://schema.org/WebPage">
		
	<header class="govuk-header" data-module="govuk-header">
		<div class="govuk-header__container govuk-width-container">
			<div class="govuk-header__logo">
				<a href="#" class="govuk-header__link govuk-header__link--homepage"> </a>
			</div>
			<div class="govuk-header__content">
				<a href="<?php echo home_url(); ?>" class="govuk-header__link govuk-header__service-name"><?php bloginfo('name'); ?></a>
				<nav aria-label="Menu" class="govuk-header__navigation">
					<button type="button" class="govuk-header__menu-button govuk-js-header-toggle" aria-controls="navigation" hidden>
					Menu
					</button>
					<ul id="navigation" class="govuk-header__navigation-list">
						<?php 
						wp_nav_menu(
							array(
								'container' => false,                           		// remove nav container
								'container_class' => 'govuk-header__navigation-item',   // class of container (should you choose to use it)
								'menu' => __( 'The Main Menu', 'gdstheme' ),  			// nav name
								'menu_class' => 'govuk-header__link',               	// adding custom nav class
								'theme_location' => 'main-nav',                 		// where it's located in the theme
								'before' => '',                                 		//	 before the menu
								'after' => '',                                 			// after the menu
								'link_before' => '',                            		// before each link
								'link_after' => '',                             		// after each link
								'depth' => 0,                                   		// limit the depth of the nav
								'fallback_cb' => ''                             		// fallback function (if there is one)
							)
						); 
						?>
					</ul>
				</nav>
			</div>
		</div>
	</header>