<?php
/**
 * Course archive template part.
 *
 * @package Minhaz_LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$minhaz_lms_course_post_type = minhaz_lms_get_featured_course_post_type();
$is_tutor_active             = function_exists( 'tutor' ) && 'post' !== $minhaz_lms_course_post_type;
$minhaz_lms_tax_query        = array();

if ( is_tax( 'course-category' ) ) {
	$minhaz_lms_tax_query[] = array(
		'taxonomy' => 'course-category',
		'field'    => 'term_id',
		'terms'    => absint( get_queried_object_id() ),
	);
}

$minhaz_lms_course_query = new WP_Query(
	array(
		'post_type'           => $is_tutor_active ? $minhaz_lms_course_post_type : 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 9,
		'paged'               => max( 1, absint( get_query_var( 'paged' ) ) ),
		'orderby'             => 'date',
		'order'               => 'DESC',
		'ignore_sticky_posts' => true,
		'tax_query'           => ! empty( $minhaz_lms_tax_query ) ? $minhaz_lms_tax_query : null,
	)
);

$minhaz_lms_course_items = array();

if ( $minhaz_lms_course_query->have_posts() ) {
	while ( $minhaz_lms_course_query->have_posts() ) {
		$minhaz_lms_course_query->the_post();
		$course = minhaz_lms_get_course_data( get_the_ID() );
		if ( $course ) {
			$minhaz_lms_course_items[] = $course;
		}
	}
}

wp_reset_postdata();
?>
<div class="content-area">
	<div class="site-content">
		<header class="archive-header">
			<p class="section-heading__eyebrow"><?php esc_html_e( 'Courses', 'minhaz-lms' ); ?></p>
			<h1 class="archive-title">
				<?php
				if ( is_tax( 'course-category' ) ) {
					echo esc_html( get_queried_object()->name );
				} else {
					esc_html_e( 'Explore Our Courses', 'minhaz-lms' );
				}
				?>
			</h1>
			<div class="archive-description">
				<?php
				if ( is_tax( 'course-category' ) ) {
					echo wp_kses_post( term_description() );
				} else {
					esc_html_e( 'Browse our full catalog of learning tracks and build the skills you need for the next step in your career.', 'minhaz-lms' );
				}
				?>
			</div>
		</header>

		<?php if ( ! empty( $minhaz_lms_course_items ) ) : ?>
			<div class="course-grid" role="list" aria-label="<?php esc_attr_e( 'Course archive', 'minhaz-lms' ); ?>">
				<?php foreach ( $minhaz_lms_course_items as $course ) : ?>
					<article class="course-card" role="listitem" aria-label="<?php echo esc_attr( $course['title'] ); ?>">
						<a class="course-card__media" href="<?php echo esc_url( $course['link'] ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View course: %s', 'minhaz-lms' ), $course['title'] ) ); ?>">
							<?php echo $course['image']; ?>
						</a>
						<div class="course-card__body">
							<div class="course-card__meta">
								<span class="course-card__rating" aria-label="<?php echo esc_attr( sprintf( __( 'Rated %s out of 5', 'minhaz-lms' ), $course['rating'] ) ); ?>">
									<span aria-hidden="true">★</span> <?php echo esc_html( $course['rating'] ); ?>
								</span>
								<span class="course-card__price"><?php echo esc_html( $course['price'] ); ?></span>
							</div>
							<h2 class="course-card__title">
								<a href="<?php echo esc_url( $course['link'] ); ?>"><?php echo esc_html( $course['title'] ); ?></a>
							</h2>
							<p class="course-card__instructor"><?php echo esc_html( sprintf( __( 'By %s', 'minhaz-lms' ), $course['instructor'] ) ); ?></p>
							<div class="course-card__actions">
								<a class="button button--compact" href="<?php echo esc_url( $course['link'] ); ?>"><?php echo esc_html( $course['cta_label'] ); ?></a>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<div class="homepage-empty-state">
				<p class="homepage-empty-state__title">
					<?php
					if ( ! $is_tutor_active ) {
						esc_html_e( 'Tutor LMS is inactive.', 'minhaz-lms' );
					} else {
						esc_html_e( 'No courses are available yet.', 'minhaz-lms' );
					}
					?>
				</p>
				<p>
					<?php
					if ( ! $is_tutor_active ) {
						esc_html_e( 'Activate Tutor LMS to show your course catalog here.', 'minhaz-lms' );
					} else {
						esc_html_e( 'New published courses will appear here automatically.', 'minhaz-lms' );
					}
					?>
				</p>
			</div>
		<?php endif; ?>

		<?php
		if ( $minhaz_lms_course_query->max_num_pages > 1 ) {
			echo '<nav class="pagination" aria-label="' . esc_attr__( 'Course archive pagination', 'minhaz-lms' ) . '">';
			echo paginate_links(
				array(
					'total'     => $minhaz_lms_course_query->max_num_pages,
					'current'   => max( 1, absint( get_query_var( 'paged' ) ) ),
					'prev_text' => __( '&laquo; Previous', 'minhaz-lms' ),
					'next_text' => __( 'Next &raquo;', 'minhaz-lms' ),
					'mid_size'  => 2,
				)
			);
			echo '</nav>';
		}
		?>
	</div>
</div>
