<?php
/**
 * Site header.
 *
 * @package Minhaz_LMS
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'minhaz-lms' ); ?></a>
<div id="page" class="site">
	<?php get_template_part( 'template-parts/header/site', 'header' ); ?>
	<main id="primary" class="site-main" tabindex="-1">
