<?php
/**
 * Front-page presentation helpers.
 *
 * @package Minhaz_LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gets a valid optional call-to-action pair.
 *
 * @param string $type CTA type: primary or secondary.
 * @return array CTA data.
 */
function minhaz_lms_get_cta( $type ) {
	$allowed_types = array( 'primary', 'secondary' );

	if ( ! in_array( $type, $allowed_types, true ) ) {
		return array( 'label' => '', 'url' => '' );
	}

	return array(
		'label' => (string) get_theme_mod(
			'minhaz_lms_' . $type . '_cta_label',
			'primary' === $type ? esc_html__( 'Explore Courses', 'minhaz-lms' ) : esc_html__( 'Get Started', 'minhaz-lms' )
		),
		'url'   => (string) get_theme_mod( 'minhaz_lms_' . $type . '_cta_url', '' ),
	);
}

/**
 * Checks whether a call-to-action has enough data to be displayed.
 *
 * @param array $cta CTA data.
 * @return bool Whether the CTA can be displayed.
 */
function minhaz_lms_has_cta( $cta ) {
	return ! empty( $cta['label'] ) && ! empty( $cta['url'] );
}

/**
 * Gets native WordPress statistics for the front page.
 *
 * @return array[] Statistics with labels and values.
 */
function minhaz_lms_get_site_statistics() {
	$post_count     = wp_count_posts( 'post' );
	$category_count = wp_count_terms(
		'category',
		array(
			'hide_empty' => true,
		)
	);
	$comment_count  = wp_count_comments();

	return array(
		array(
			'value' => isset( $post_count->publish ) ? (int) $post_count->publish : 0,
			'label' => esc_html__( 'Published articles', 'minhaz-lms' ),
		),
		array(
			'value' => is_wp_error( $category_count ) ? 0 : (int) $category_count,
			'label' => esc_html__( 'Topics to explore', 'minhaz-lms' ),
		),
		array(
			'value' => isset( $comment_count->approved ) ? (int) $comment_count->approved : 0,
			'label' => esc_html__( 'Approved comments', 'minhaz-lms' ),
		),
	);
}

/**
 * Gets the author of the latest published post.
 *
 * @return WP_User|false Author object or false when no published posts exist.
 */
function minhaz_lms_get_featured_author() {
	$post_ids = get_posts(
		array(
			'fields'         => 'ids',
			'numberposts'     => 1,
			'post_status'     => 'publish',
			'post_type'       => 'post',
			'suppress_filters' => false,
		)
	);

	if ( empty( $post_ids ) ) {
		return false;
	}

	$author_id = absint( get_post_field( 'post_author', $post_ids[0] ) );

	return $author_id ? get_userdata( $author_id ) : false;
}
