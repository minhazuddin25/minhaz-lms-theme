<?php
/**
 * Single course helper functions for Tutor LMS integration.
 *
 * @package Minhaz_LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Checks whether the current request is a Tutor LMS course single page.
 *
 * @return bool
 */
function minhaz_lms_is_tutor_course_single() {
	if ( ! function_exists( 'tutor' ) ) {
		return false;
	}

	$course_post_type = minhaz_lms_get_featured_course_post_type();
	if ( 'post' === $course_post_type ) {
		return false;
	}

	return is_singular( $course_post_type );
}

/**
 * Gets the normalized single-course meta items.
 *
 * @param int $course_id Course ID.
 * @return array
 */
function minhaz_lms_get_single_course_meta( $course_id = 0 ) {
	$course_id = absint( $course_id ? $course_id : get_the_ID() );
	if ( ! $course_id ) {
		return array();
	}

	$meta = array();

	$duration = function_exists( 'get_tutor_course_duration_context' ) ? get_tutor_course_duration_context( $course_id ) : '';
	if ( $duration ) {
		$meta[] = array(
			'label' => __( 'Duration', 'minhaz-lms' ),
			'value' => esc_html( $duration ),
		);
	}

	$lessons = 0;
	if ( function_exists( 'tutor_utils' ) && is_object( tutor_utils() ) && method_exists( tutor_utils(), 'get_course_contents' ) ) {
		$course_contents = tutor_utils()->get_course_contents( $course_id );
		if ( is_array( $course_contents ) ) {
			$lessons = count( $course_contents );
		}
	}
	if ( $lessons ) {
		$meta[] = array(
			'label' => _n( 'Lesson', 'Lessons', $lessons, 'minhaz-lms' ),
			'value' => number_format_i18n( $lessons ),
		);
	}

	$quizzes = 0;
	if ( function_exists( 'tutor_utils' ) && is_object( tutor_utils() ) && method_exists( tutor_utils(), 'count_course_quiz' ) ) {
		$quizzes = (int) tutor_utils()->count_course_quiz( $course_id );
	}
	if ( $quizzes ) {
		$meta[] = array(
			'label' => _n( 'Quiz', 'Quizzes', $quizzes, 'minhaz-lms' ),
			'value' => number_format_i18n( $quizzes ),
		);
	}

	if ( function_exists( 'tutor_utils' ) && is_object( tutor_utils() ) && method_exists( tutor_utils(), 'count_enrolled_users_by_course' ) ) {
		$enrolled = (int) tutor_utils()->count_enrolled_users_by_course( $course_id );
		if ( $enrolled ) {
			$meta[] = array(
				'label' => __( 'Students', 'minhaz-lms' ),
				'value' => number_format_i18n( $enrolled ),
			);
		}
	}

	$level = function_exists( 'get_tutor_course_level' ) ? get_tutor_course_level( $course_id ) : '';
	if ( $level ) {
		$meta[] = array(
			'label' => __( 'Level', 'minhaz-lms' ),
			'value' => esc_html( $level ),
		);
	}

	$categories = function_exists( 'get_tutor_course_categories' ) ? get_tutor_course_categories( $course_id ) : array();
	if ( ! empty( $categories ) ) {
		$category_names = array();
		foreach ( $categories as $category ) {
			if ( isset( $category->name ) ) {
				$category_names[] = $category->name;
			}
		}
		if ( ! empty( $category_names ) ) {
			$meta[] = array(
				'label' => _n( 'Category', 'Categories', count( $category_names ), 'minhaz-lms' ),
				'value' => esc_html( implode( ', ', $category_names ) ),
			);
		}
	}

	return $meta;
}

/**
 * Gets the course rating summary for display.
 *
 * @param int $course_id Course ID.
 * @return array
 */
function minhaz_lms_get_course_rating_summary( $course_id = 0 ) {
	$course_id = absint( $course_id ? $course_id : get_the_ID() );
	if ( ! $course_id ) {
		return array(
			'avg'    => 0,
			'count'  => 0,
			'badge'  => __( 'No reviews yet', 'minhaz-lms' ),
			'active' => false,
		);
	}

	$rating = null;
	if ( function_exists( 'tutor_utils' ) && is_object( tutor_utils() ) && method_exists( tutor_utils(), 'get_course_rating' ) ) {
		$rating = tutor_utils()->get_course_rating( $course_id );
	}

	if ( ! is_object( $rating ) ) {
		return array(
			'avg'    => 0,
			'count'  => 0,
			'badge'  => __( 'No reviews yet', 'minhaz-lms' ),
			'active' => false,
		);
	}

	$avg = isset( $rating->rating_avg ) ? (float) $rating->rating_avg : 0;
	$count = isset( $rating->rating_count ) ? (int) $rating->rating_count : 0;

	return array(
		'avg'    => $avg,
		'count'  => $count,
		'badge'  => $count > 0 ? sprintf( _n( '%s review', '%s reviews', $count, 'minhaz-lms' ), number_format_i18n( $count ) ) : __( 'No reviews yet', 'minhaz-lms' ),
		'active' => $count > 0,
	);
}

/**
 * Returns a related-course query for a course.
 *
 * @param int $course_id Course ID.
 * @param int $count Number of courses.
 * @return WP_Query
 */
function minhaz_lms_get_related_course_query( $course_id = 0, $count = 3 ) {
	$course_id = absint( $course_id ? $course_id : get_the_ID() );
	$course_post_type = minhaz_lms_get_featured_course_post_type();

	$query_args = array(
		'post_type'           => $course_post_type,
		'post_status'         => 'publish',
		'posts_per_page'      => max( 1, absint( $count ) ),
		'post__not_in'        => $course_id ? array( $course_id ) : array(),
		'orderby'             => 'date',
		'order'               => 'DESC',
		'ignore_sticky_posts' => true,
	);

	if ( function_exists( 'tutor' ) && ! empty( $course_post_type ) && 'post' !== $course_post_type ) {
		return new WP_Query( $query_args );
	}

	return new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => max( 1, absint( $count ) ),
			'post__not_in'        => $course_id ? array( $course_id ) : array(),
			'orderby'             => 'date',
			'order'               => 'DESC',
			'ignore_sticky_posts' => true,
		)
	);
}

/**
 * Uses the theme-level template override for Tutor single course renders.
 *
 * @param string $template Active template.
 * @return string
 */
function minhaz_lms_course_single_template( $template ) {
	if ( ! is_singular() || ! function_exists( 'tutor' ) ) {
		return $template;
	}

	$course_post_type = isset( tutor()->course_post_type ) ? tutor()->course_post_type : '';
	if ( empty( $course_post_type ) || ! is_singular( $course_post_type ) ) {
		return $template;
	}

	$theme_template = locate_template( array( 'single-course.php' ) );
	if ( $theme_template ) {
		return $theme_template;
	}

	return $template;
}
add_filter( 'single_template', 'minhaz_lms_course_single_template' );
