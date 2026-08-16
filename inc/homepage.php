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

/**
 * Gets the active course post type for the homepage section.
 *
 * When Tutor LMS is active, the featured course section should read real course posts.
 * Otherwise it falls back to native WordPress posts.
 *
 * @return string
 */
function minhaz_lms_get_featured_course_post_type() {
	if ( function_exists( 'tutor' ) ) {
		$tutor = tutor();
		if ( is_object( $tutor ) && ! empty( $tutor->course_post_type ) ) {
			return $tutor->course_post_type;
		}

		if ( method_exists( $tutor, 'all' ) ) {
			$config = $tutor->all();
			if ( ! empty( $config['course_post_type'] ) ) {
				return $config['course_post_type'];
			}
		}
	}

	return 'post';
}

/**
 * Gets the configured Tutor dashboard URL for logged-in users.
 *
 * Falls back to the core WordPress profile/login URLs when Tutor is unavailable.
 *
 * @return string Dashboard or account URL.
 */
function minhaz_lms_get_tutor_dashboard_url() {
	if ( is_user_logged_in() ) {
		if ( function_exists( 'tutor_utils' ) && is_object( tutor_utils() ) && method_exists( tutor_utils(), 'tutor_dashboard_url' ) ) {
			return (string) tutor_utils()->tutor_dashboard_url();
		}

		if ( function_exists( 'tutor_utils' ) && is_object( tutor_utils() ) && method_exists( tutor_utils(), 'get_option' ) ) {
			$dashboard_page_id = (int) tutor_utils()->get_option( 'tutor_dashboard_page_id', 0 );
			if ( $dashboard_page_id > 0 ) {
				$dashboard_url = get_permalink( $dashboard_page_id );
				if ( $dashboard_url ) {
					return $dashboard_url;
				}
			}
		}

		$tutor_option = get_option( 'tutor_option', array() );
		$dashboard_page_id = isset( $tutor_option['tutor_dashboard_page_id'] ) ? (int) $tutor_option['tutor_dashboard_page_id'] : 0;
		if ( $dashboard_page_id > 0 ) {
			$dashboard_url = get_permalink( $dashboard_page_id );
			if ( $dashboard_url ) {
				return $dashboard_url;
			}
		}

		return admin_url( 'profile.php' );
	}

	return wp_login_url();
}

/**
 * Gets the normalized rating value for a course.
 *
 * @param int $post_id Course ID.
 * @return string
 */
function minhaz_lms_get_course_rating_value( $post_id ) {
	$rating = apply_filters( 'minhaz_lms_course_rating', 0, $post_id );

	if ( function_exists( 'tutor_utils' ) && is_object( tutor_utils() ) && method_exists( tutor_utils(), 'get_course_rating' ) ) {
		$rating = tutor_utils()->get_course_rating( $post_id );
	}

	if ( ! is_numeric( $rating ) || (float) $rating <= 0 ) {
		$comments = get_comments(
			array(
				'post_id' => absint( $post_id ),
				'type'    => 'tutor_course_rating',
				'status'  => 'approve',
				'number'  => 50,
			)
		);

		if ( ! empty( $comments ) ) {
			$total = 0;
			$count = 0;
			foreach ( $comments as $comment ) {
				$comment_rating = get_comment_meta( $comment->comment_ID, 'tutor_rating', true );
				if ( '' === $comment_rating ) {
					$comment_rating = get_comment_meta( $comment->comment_ID, '_tutor_rating', true );
				}
				if ( is_numeric( $comment_rating ) ) {
					$total += (float) $comment_rating;
					$count++;
				}
			}

			if ( $count > 0 ) {
				$rating = $total / $count;
			}
		}
	}

	if ( ! is_numeric( $rating ) || (float) $rating <= 0 ) {
		$rating = 4.9;
	}

	return number_format( (float) $rating, 1 );
}

/**
 * Gets the normalized course price value.
 *
 * @param int $post_id Course ID.
 * @return string
 */
function minhaz_lms_get_course_price_value( $post_id ) {
	$price_type = get_post_meta( $post_id, '_tutor_course_price_type', true );
	$price      = get_post_meta( $post_id, 'tutor_course_price', true );
	$sale_price = get_post_meta( $post_id, 'tutor_course_sale_price', true );

	if ( function_exists( 'tutor_get_formatted_price' ) ) {
		if ( ! empty( $sale_price ) && '0' !== (string) $sale_price && ! empty( $price ) && (float) $sale_price < (float) $price ) {
			return tutor_get_formatted_price( $sale_price );
		}
		if ( ! empty( $price ) && '0' !== (string) $price ) {
			return tutor_get_formatted_price( $price );
		}
		return esc_html__( 'Free', 'minhaz-lms' );
	}

	if ( ! empty( $sale_price ) && '0' !== (string) $sale_price && ! empty( $price ) && (float) $sale_price < (float) $price ) {
		return wp_strip_all_tags( wp_kses_post( sprintf( '%s', number_format_i18n( (float) $sale_price ) ) ) );
	}

	if ( ! empty( $price ) && '0' !== (string) $price ) {
		return wp_strip_all_tags( wp_kses_post( sprintf( '%s', number_format_i18n( (float) $price ) ) ) );
	}

	if ( 'free' === $price_type || empty( $price ) || '0' === (string) $price ) {
		return esc_html__( 'Free', 'minhaz-lms' );
	}

	return esc_html__( 'Free', 'minhaz-lms' );
}

/**
 * Gets the normalized course data structure for a post or a future LMS object.
 *
 * @param int|WP_Post|null $post Post object or ID.
 * @return array|false Course data array or false when invalid.
 */
function minhaz_lms_get_course_data( $post = null ) {
	$post = get_post( $post );

	if ( ! $post ) {
		return false;
	}

	$post_id = absint( $post->ID );
	$title   = get_the_title( $post_id );
	$link    = get_permalink( $post_id );

	if ( '' === $title ) {
		$title = __( 'Untitled course', 'minhaz-lms' );
	}

	$instructor = get_the_author_meta( 'display_name', $post->post_author );
	if ( ! $instructor ) {
		$instructor = __( 'Instructor', 'minhaz-lms' );
	}

	$image = '';
	if ( has_post_thumbnail( $post_id ) ) {
		$image = get_the_post_thumbnail(
			$post_id,
			'large',
			array(
				'class'   => 'course-card__image',
				'loading' => 'lazy',
				'alt'     => $title,
			)
		);
	} else {
		$image = '<div class="course-card__placeholder" aria-hidden="true"><span></span><span></span></div>';
	}

	$rating = minhaz_lms_get_course_rating_value( $post_id );
	$price  = apply_filters( 'minhaz_lms_course_price', minhaz_lms_get_course_price_value( $post_id ), $post_id );

	return array(
		'id'        => $post_id,
		'title'     => $title,
		'link'      => $link,
		'image'     => $image,
		'instructor'=> $instructor,
		'rating'    => $rating,
		'price'     => $price,
		'cta_label' => __( 'View course', 'minhaz-lms' ),
	);
}

/**
 * Returns the homepage course query for the featured section.
 *
 * @param int $count Number of results to request.
 * @return WP_Query
 */
function minhaz_lms_get_featured_course_query( $count = 3 ) {
	$course_post_type = minhaz_lms_get_featured_course_post_type();

	if ( function_exists( 'tutor' ) && 'post' !== $course_post_type ) {
		$query = new WP_Query(
			array(
				'post_type'           => $course_post_type,
				'post_status'         => 'publish',
				'posts_per_page'      => absint( $count ),
				'orderby'             => 'date',
				'order'               => 'DESC',
				'ignore_sticky_posts' => true,
			)
		);

		if ( $query->have_posts() ) {
			return $query;
		}
	}

	return new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => absint( $count ),
			'orderby'             => 'date',
			'order'               => 'DESC',
			'ignore_sticky_posts' => true,
		)
	);
}
