<?php global $assets; $assets = get_template_directory_uri().'/assets'; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title('-', true, '-'); ?></title>

		<?php // Favicon ?>
		<link rel="icon" href="<?php echo $assets; ?>/image/favicon.png" />
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo $assets; ?>/image/favicon.ico" />
		<![endif]-->

		<?php // Style's ?>
		<?php get_template_part('content-style', get_post_format()); ?>

		<?php // Pingback ?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // Mobile tags ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php // Force 'Internet Explorer' to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header>
		</header>
		<main>
