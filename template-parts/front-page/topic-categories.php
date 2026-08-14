<?php
/**
 * Native WordPress topic categories.
 *
 * @package Minhaz_LMS
 */

$minhaz_lms_categories = get_categories(
	array(
		'hide_empty' => true,
		'number'     => 6,
		'orderby'    => 'count',
		'order'      => 'DESC',
	)
);
?>
<section class="front-page-section topic-categories" aria-labelledby="topic-categories-title">
	<div class="content-area">
		<div class="section-heading">
			<p class="section-heading__eyebrow"><?php esc_html_e( 'Browse by topic', 'minhaz-lms' ); ?></p>
			<h2 id="topic-categories-title" class="section-heading__title"><?php esc_html_e( 'Discover what interests you', 'minhaz-lms' ); ?></h2>
		</div>
		<?php if ( $minhaz_lms_categories ) : ?>
			<div class="topic-categories__grid">
				<?php foreach ( $minhaz_lms_categories as $minhaz_lms_category ) : ?>
					<a class="topic-category-card" href="<?php echo esc_url( get_category_link( $minhaz_lms_category ) ); ?>">
						<span class="topic-category-card__count"><?php echo esc_html( number_format_i18n( $minhaz_lms_category->count ) ); ?></span>
						<span class="topic-category-card__name"><?php echo esc_html( $minhaz_lms_category->name ); ?></span>
					</a>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<div class="homepage-empty-state"><p class="homepage-empty-state__title"><?php esc_html_e( 'Topics will appear here as your content grows.', 'minhaz-lms' ); ?></p><p><?php esc_html_e( 'Assign native WordPress categories to published posts to populate this area.', 'minhaz-lms' ); ?></p></div>
		<?php endif; ?>
	</div>
</section>
