<?php
/**
 * Navigation menu registration.
 *
 * @package Minhaz_LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers theme navigation locations.
 */
function minhaz_lms_register_menus() {
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'minhaz-lms' ),
			'footer'  => esc_html__( 'Footer Menu', 'minhaz-lms' ),
			'social'  => esc_html__( 'Social Links Menu', 'minhaz-lms' ),
		)
	);
}
add_action( 'after_setup_theme', 'minhaz_lms_register_menus' );

/**
 * Displays a menu-setup link only to administrators when no primary menu exists.
 *
 * @param array $args Menu arguments.
 */
function minhaz_lms_primary_menu_fallback( $args ) {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$menu_id = ! empty( $args['menu_id'] ) ? $args['menu_id'] : 'primary-menu';

	printf(
		'<ul id="%1$s" class="menu"><li class="menu-item"><a href="%2$s">%3$s</a></li></ul>',
		esc_attr( $menu_id ),
		esc_url( admin_url( 'nav-menus.php?action=locations' ) ),
		esc_html__( 'Set up primary menu', 'minhaz-lms' )
	);
}
