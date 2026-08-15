<?php
/**
 * Featured course section template.
 *
 * Uses Tutor LMS course data when the plugin is active and falls back to WordPress
 * posts only when Tutor is unavailable.
 *
 * @package Minhaz_LMS
 */

$minhaz_lms_course_post_type = minhaz_lms_get_featured_course_post_type();
$minhaz_lms_course_query     = false;
$minhaz_lms_course_items     = array();

if ( function_exists( 'tutor' ) && 'post' !== $minhaz_lms_course_post_type ) {
	$minhaz_lms_course_query = minhaz_lms_get_featured_course_query( 3 );
} else {
	$minhaz_lms_course_query = minhaz_lms_get_featured_course_query( 3 );
}

if ( $minhaz_lms_course_query instanceof WP_Query && $minhaz_lms_course_query->have_posts() ) {
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
<section class="front-page-section front-page-courses" aria-labelledby="featured-courses-title">
	<div class="content-area">
		<div class="section-heading">
			<p class="section-heading__eyebrow"><?php esc_html_e( 'Popular courses', 'minhaz-lms' ); ?></p>
			<h2 id="featured-courses-title" class="section-heading__title"><?php esc_html_e( 'Explore our latest learning tracks', 'minhaz-lms' ); ?></h2>
		</div>

		<?php if ( ! empty( $minhaz_lms_course_items ) ) : ?>
			<div class="course-grid" role="list" aria-label="<?php esc_attr_e( 'Featured courses', 'minhaz-lms' ); ?>">
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
							<h3 class="course-card__title">
								<a href="<?php echo esc_url( $course['link'] ); ?>"><?php echo esc_html( $course['title'] ); ?></a>
							</h3>
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
				<p class="homepage-empty-state__title"><?php esc_html_e( 'Your featured courses will appear here.', 'minhaz-lms' ); ?></p>
				<?php if ( 'post' === $minhaz_lms_course_post_type ) : ?>
					<p><?php esc_html_e( 'Publish WordPress posts to populate this course-ready section.', 'minhaz-lms' ); ?></p>
				<?php else : ?>
					<p><?php esc_html_e( 'No published Tutor LMS courses are available yet.', 'minhaz-lms' ); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
