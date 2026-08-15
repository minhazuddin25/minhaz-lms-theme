<?php
/**
 * Single course template for Tutor LMS.
 *
 * @package Minhaz_LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$course_id = absint( get_the_ID() );
$course_rating = null;
if ( function_exists( 'tutor_utils' ) && is_object( tutor_utils() ) && method_exists( tutor_utils(), 'get_course_rating' ) ) {
	$course_rating = tutor_utils()->get_course_rating( $course_id );
}

$instructors = array();
if ( function_exists( 'tutor_utils' ) && is_object( tutor_utils() ) && method_exists( tutor_utils(), 'get_instructors_by_course' ) ) {
	$instructors = tutor_utils()->get_instructors_by_course( $course_id );
}

$course_categories = get_the_terms( $course_id, 'course-category' );
$meta_items        = minhaz_lms_get_single_course_meta( $course_id );
$related_query     = minhaz_lms_get_related_course_query( $course_id, 3 );
$course_excerpt    = get_the_excerpt( $course_id );
if ( empty( $course_excerpt ) ) {
	$course_excerpt = wp_trim_excerpt( get_the_content( null, false, $course_id ) );
}
?>
<div class="content-area">
	<div class="course-single">
		<div class="course-single__hero">
			<nav class="course-single__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'minhaz-lms' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'minhaz-lms' ); ?></a>
				<span aria-hidden="true">/</span>
				<?php
				$course_archive_url = get_post_type_archive_link( minhaz_lms_get_featured_course_post_type() );
				if ( $course_archive_url ) :
					?>
					<a href="<?php echo esc_url( $course_archive_url ); ?>"><?php esc_html_e( 'Courses', 'minhaz-lms' ); ?></a>
					<span aria-hidden="true">/</span>
				<?php endif; ?>
				<?php if ( ! empty( $course_categories ) && ! is_wp_error( $course_categories ) ) : ?>
					<?php $primary_category = $course_categories[0]; ?>
					<a href="<?php echo esc_url( get_term_link( $primary_category ) ); ?>"><?php echo esc_html( $primary_category->name ); ?></a>
					<span aria-hidden="true">/</span>
				<?php endif; ?>
				<span aria-current="page"><?php the_title(); ?></span>
			</nav>

			<div class="course-single__hero-inner">
				<div class="course-single__summary">
					<?php if ( ! empty( $course_categories ) && ! is_wp_error( $course_categories ) ) : ?>
						<p class="course-single__eyebrow"><?php echo esc_html( $course_categories[0]->name ); ?></p>
					<?php endif; ?>
					<h1 class="course-single__title"><?php the_title(); ?></h1>
					<?php if ( ! empty( $course_excerpt ) ) : ?>
						<p class="course-single__excerpt"><?php echo wp_kses_post( $course_excerpt ); ?></p>
					<?php endif; ?>

					<div class="course-single__rating-row" aria-label="<?php esc_attr_e( 'Course rating', 'minhaz-lms' ); ?>">
						<?php
						if ( $course_rating && isset( $course_rating->rating_avg ) && (float) $course_rating->rating_avg > 0 ) :
							$average = (float) $course_rating->rating_avg;
							$count   = isset( $course_rating->rating_count ) ? (int) $course_rating->rating_count : 0;
							?>
							<span class="course-single__stars" aria-hidden="true">★★★★★</span>
							<span class="course-single__rating-value"><?php echo esc_html( number_format_i18n( $average, 1 ) ); ?></span>
							<?php if ( $count > 0 ) : ?>
								<span class="course-single__rating-count">(<?php echo esc_html( sprintf( _n( '%s review', '%s reviews', $count, 'minhaz-lms' ), number_format_i18n( $count ) ) ); ?>)</span>
							<?php endif; ?>
						<?php endif; ?>
					</div>

					<div class="course-single__instructor">
						<?php if ( ! empty( $instructors ) ) : ?>
							<?php $instructor = $instructors[0]; ?>
							<?php
							$profile_url = function_exists( 'tutor_utils' ) && is_object( tutor_utils() ) && method_exists( tutor_utils(), 'profile_url' )
								? tutor_utils()->profile_url( $instructor->ID, true )
								: '';
							$avatar = function_exists( 'tutor_utils' ) && is_object( tutor_utils() ) && method_exists( tutor_utils(), 'get_tutor_avatar' )
								? tutor_utils()->get_tutor_avatar( $instructor, 'md' )
								: get_avatar( $instructor->ID, 48 );
							?>
							<?php if ( ! empty( $profile_url ) ) : ?>
								<a class="course-single__instructor-link" href="<?php echo esc_url( $profile_url ); ?>">
									<?php echo wp_kses( $avatar, array( 'img' => array( 'src' => true, 'alt' => true, 'class' => true, 'width' => true, 'height' => true, 'loading' => true, 'decoding' => true ) ) ); ?>
									<span><?php echo esc_html( $instructor->display_name ); ?></span>
								</a>
							<?php else : ?>
								<div class="course-single__instructor-link course-single__instructor-link--static">
									<?php echo wp_kses( $avatar, array( 'img' => array( 'src' => true, 'alt' => true, 'class' => true, 'width' => true, 'height' => true, 'loading' => true, 'decoding' => true ) ) ); ?>
									<span><?php echo esc_html( $instructor->display_name ); ?></span>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>

				<div class="course-single__media">
					<?php
					if ( has_post_thumbnail( $course_id ) ) {
						echo get_the_post_thumbnail( $course_id, 'large', array( 'class' => 'course-single__image', 'alt' => get_the_title( $course_id ) ) );
					} else {
						?>
						<div class="course-single__placeholder" aria-hidden="true">
							<span></span>
							<span></span>
						</div>
					<?php }
				</div>
			</div>
		</div>

		<div class="course-single__body">
			<main class="course-single__content">
				<?php if ( ! empty( $meta_items ) ) : ?>
					<div class="course-single__meta" aria-label="<?php esc_attr_e( 'Course details', 'minhaz-lms' ); ?>">
						<?php foreach ( $meta_items as $meta ) : ?>
							<div class="course-single__meta-item">
								<span class="course-single__meta-label"><?php echo esc_html( $meta['label'] ); ?></span>
								<strong class="course-single__meta-value"><?php echo wp_kses_post( $meta['value'] ); ?></strong>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<section class="course-single__section">
					<h2><?php esc_html_e( 'About this course', 'minhaz-lms' ); ?></h2>
					<div class="entry-content course-single__entry-content">
						<?php the_content(); ?>
					</div>
				</section>

				<?php if ( function_exists( 'tutor_load_template' ) ) : ?>
					<section class="course-single__section">
						<?php tutor_load_template( 'single.course.course-benefits' ); ?>
					</section>
				<?php endif; ?>

				<?php if ( function_exists( 'tutor_load_template' ) ) : ?>
					<section class="course-single__section">
						<?php tutor_load_template( 'single.course.course-topics' ); ?>
					</section>
				<?php endif; ?>

				<?php if ( function_exists( 'tutor_load_template' ) ) : ?>
					<section class="course-single__section">
						<?php tutor_load_template( 'single.course.course-requirements' ); ?>
					</section>
				<?php endif; ?>

				<?php if ( function_exists( 'tutor_load_template' ) ) : ?>
					<section class="course-single__section">
						<?php tutor_load_template( 'single.course.instructors' ); ?>
					</section>
				<?php endif; ?>

				<?php if ( function_exists( 'tutor_load_template' ) ) : ?>
					<section class="course-single__section">
						<?php tutor_load_template( 'single.course.reviews' ); ?>
					</section>
				<?php endif; ?>
			</main>

			<aside class="course-single__sidebar">
				<div class="course-single__purchase-card">
					<?php if ( function_exists( 'tutor_load_template' ) ) : ?>
						<?php tutor_load_template( 'single.course.course-entry-box' ); ?>
					<?php endif; ?>
				</div>
			</aside>
		</div>

		<?php if ( $related_query && $related_query->have_posts() ) : ?>
			<section class="course-single__related" aria-labelledby="related-courses-title">
				<div class="section-heading section-heading--centered">
					<p class="section-heading__eyebrow"><?php esc_html_e( 'Continue learning', 'minhaz-lms' ); ?></p>
					<h2 id="related-courses-title" class="section-heading__title"><?php esc_html_e( 'Related courses', 'minhaz-lms' ); ?></h2>
				</div>
				<div class="course-grid" role="list" aria-label="<?php esc_attr_e( 'Related courses', 'minhaz-lms' ); ?>">
					<?php while ( $related_query->have_posts() ) : ?>
						<?php $related_query->the_post(); ?>
						<?php $related_course = minhaz_lms_get_course_data( get_the_ID() ); ?>
						<?php if ( $related_course ) : ?>
							<article class="course-card" role="listitem" aria-label="<?php echo esc_attr( $related_course['title'] ); ?>">
								<a class="course-card__media" href="<?php echo esc_url( $related_course['link'] ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View course: %s', 'minhaz-lms' ), $related_course['title'] ) ); ?>">
									<?php echo $related_course['image']; ?>
								</a>
								<div class="course-card__body">
									<div class="course-card__meta">
										<span class="course-card__rating" aria-label="<?php echo esc_attr( sprintf( __( 'Rated %s out of 5', 'minhaz-lms' ), $related_course['rating'] ) ); ?>">
											<span aria-hidden="true">★</span> <?php echo esc_html( $related_course['rating'] ); ?>
										</span>
										<span class="course-card__price"><?php echo esc_html( $related_course['price'] ); ?></span>
									</div>
									<h3 class="course-card__title"><a href="<?php echo esc_url( $related_course['link'] ); ?>"><?php echo esc_html( $related_course['title'] ); ?></a></h3>
									<p class="course-card__instructor"><?php echo esc_html( sprintf( __( 'By %s', 'minhaz-lms' ), $related_course['instructor'] ) ); ?></p>
									<div class="course-card__actions">
										<a class="button button--compact" href="<?php echo esc_url( $related_course['link'] ); ?>"><?php echo esc_html( $related_course['cta_label'] ); ?></a>
									</div>
								</div>
							</article>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			</section>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
</div>
<?php get_footer(); ?>
