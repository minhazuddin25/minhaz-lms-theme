<?php
/**
 * Featured real WordPress author.
 *
 * @package Minhaz_LMS
 */

$minhaz_lms_author = minhaz_lms_get_featured_author();
?>
<section class="front-page-section featured-author" aria-labelledby="featured-author-title">
	<div class="content-area">
		<?php if ( $minhaz_lms_author ) : ?>
			<?php $minhaz_lms_author_bio = get_user_meta( $minhaz_lms_author->ID, 'description', true ); ?>
			<article class="author-card">
				<div class="author-card__initials" aria-hidden="true"><?php echo esc_html( strtoupper( substr( $minhaz_lms_author->display_name, 0, 1 ) ) ); ?></div>
				<div class="author-card__content">
					<p class="section-heading__eyebrow"><?php esc_html_e( 'From our authors', 'minhaz-lms' ); ?></p>
					<h2 id="featured-author-title" class="section-heading__title"><?php echo esc_html( $minhaz_lms_author->display_name ); ?></h2>
					<?php if ( $minhaz_lms_author_bio ) : ?>
						<p><?php echo esc_html( $minhaz_lms_author_bio ); ?></p>
					<?php else : ?>
						<p><?php esc_html_e( 'This author’s published WordPress content is featured throughout the site.', 'minhaz-lms' ); ?></p>
					<?php endif; ?>
					<a class="button button--secondary" href="<?php echo esc_url( get_author_posts_url( $minhaz_lms_author->ID ) ); ?>"><?php esc_html_e( 'View author posts', 'minhaz-lms' ); ?></a>
				</div>
			</article>
		<?php else : ?>
			<div class="homepage-empty-state"><h2 id="featured-author-title" class="homepage-empty-state__title"><?php esc_html_e( 'Your author spotlight will appear here.', 'minhaz-lms' ); ?></h2><p><?php esc_html_e( 'Publish a WordPress post to feature its real author in this section.', 'minhaz-lms' ); ?></p></div>
		<?php endif; ?>
	</div>
</section>
