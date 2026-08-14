<?php
/**
 * Widget areas.
 *
 * @package Minhaz_LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers supported widget areas.
 */
function minhaz_lms_register_sidebars() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'minhaz-lms' ),
			'id'            => 'primary-sidebar',
			'description'   => esc_html__( 'Widgets displayed beside supported content.', 'minhaz-lms' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets', 'minhaz-lms' ),
			'id'            => 'footer-widgets',
			'description'   => esc_html__( 'Widgets displayed in the site footer.', 'minhaz-lms' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'minhaz_lms_register_sidebars' );
