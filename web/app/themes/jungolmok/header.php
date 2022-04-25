<?php

/** 
 * Header
 * 
 * @package Boardwalk 2021 – jk
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>" charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/site.webmanifest">
	<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="preloadimg" class="plimg0"></div>
	<header>
		<div class='header--container'>

			<div class="jg--logo"><a href="<?php echo esc_url(home_url('')); ?>" rel="home">
				<figure class="icons"><img width="48" height="48" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/svg/logo--sample.svg" alt="logo"></figure>
			</a>
			</div>

			<div class="jg--hamburger">
				<div>
					<div id="hb--off"></div>
					<ul id="hb--on">
						<li></li>
						<li></li>
						<li></li>
					</ul>
				</div>
			</div>
		</div>
		<h1><?php echo get_the_title(); ?></h1>
	</header>
	<?php get_sidebar(); ?>
	<main role="main">