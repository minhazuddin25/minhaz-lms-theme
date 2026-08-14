<?php
/**
 * Theme setup.
 *
 * @package Minhaz_LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Configures theme defaults and WordPress feature support.
 */
function minhaz_lms_setup() {
	load_theme_textdomain( 'minhaz-lms', MINHAZ_LMS_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'custom-line-height' );
	add_theme_support( 'custom-spacing' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 280,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'ffffff',
		)
	);
}
add_action( 'after_setup_theme', 'minhaz_lms_setup' );

/**
 * Sets the global content width.
 */
function minhaz_lms_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'minhaz_lms_content_width', 760 );
}
add_action( 'after_setup_theme', 'minhaz_lms_content_width', 0 );
