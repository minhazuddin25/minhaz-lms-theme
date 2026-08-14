<?php
/**
 * Minhaz LMS functions and definitions.
 *
 * @package Minhaz_LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MINHAZ_LMS_VERSION', '0.1.0' );
define( 'MINHAZ_LMS_DIR', get_template_directory() );
define( 'MINHAZ_LMS_URI', get_template_directory_uri() );

$minhaz_lms_includes = array(
	'inc/setup.php',
	'inc/assets.php',
	'inc/menus.php',
	'inc/sidebars.php',
	'inc/editor.php',
	'inc/accessibility.php',
	'inc/customizer.php',
	'inc/homepage.php',
	'inc/template-tags.php',
);

foreach ( $minhaz_lms_includes as $minhaz_lms_include ) {
	require_once MINHAZ_LMS_DIR . '/' . $minhaz_lms_include;
}
