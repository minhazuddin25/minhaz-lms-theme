<?php
/**
 * Template helpers.
 *
 * @package Minhaz_LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Displays post publication metadata.
 */
function minhaz_lms_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);

	printf(
		'<span class="posted-on">%s</span>',
		wp_kses(
			sprintf(
				/* translators: %s: Post publication date. */
				esc_html__( 'Published %s', 'minhaz-lms' ),
				$time_string
			),
			array( 'time' => array( 'class' => array(), 'datetime' => array() ) )
		)
	);
}
