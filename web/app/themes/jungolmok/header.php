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
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header>
		<div class='header--container'>
			<div class="logo">
				<a href="<?php echo esc_url(home_url('')); ?>" rel="home">
				<figure class="icons">
					<img 
						width="48" 
						height="48" 
						src="<?php echo get_template_directory_uri(); ?>/assets/images/svg/logo--sample.svg" 
						alt="logo" 
					/>
				</figure>
				</a>
			</div>
		</div>
	</header>
	<?php get_sidebar(); ?>
	<main role="main">