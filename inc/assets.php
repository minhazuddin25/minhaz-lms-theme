<?php
/**
 * Front-end asset registration.
 *
 * @package Minhaz_LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Loads public styles and scripts.
 */
function minhaz_lms_enqueue_assets() {
	wp_enqueue_style( 'minhaz-lms-style', get_stylesheet_uri(), array(), MINHAZ_LMS_VERSION );
	wp_enqueue_style( 'minhaz-lms-main', MINHAZ_LMS_URI . '/assets/css/main.css', array( 'minhaz-lms-style' ), MINHAZ_LMS_VERSION );

	wp_enqueue_script( 'minhaz-lms-navigation', MINHAZ_LMS_URI . '/assets/js/navigation.js', array(), MINHAZ_LMS_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'minhaz_lms_enqueue_assets' );
