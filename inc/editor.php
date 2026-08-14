<?php
/**
 * Block editor support.
 *
 * @package Minhaz_LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds editor styles that align core content with the front end.
 */
function minhaz_lms_add_editor_styles() {
	add_editor_style( 'assets/css/editor-style.css' );
}
add_action( 'after_setup_theme', 'minhaz_lms_add_editor_styles' );
