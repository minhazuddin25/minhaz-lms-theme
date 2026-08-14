<?php
/**
 * Accessibility helpers.
 *
 * @package Minhaz_LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds a class when JavaScript is unavailable.
 *
 * This is deliberately small and inline so the navigation fallback is available
 * before external JavaScript loads.
 */
function minhaz_lms_no_js_class() {
	echo '<noscript><style>.minhaz-lms-menu-toggle{display:none}.minhaz-lms-primary-menu{display:block}</style></noscript>';
}
add_action( 'wp_head', 'minhaz_lms_no_js_class', 1 );
