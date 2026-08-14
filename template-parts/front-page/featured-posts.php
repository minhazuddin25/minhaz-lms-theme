<?php
/**
 * Optional latest-posts section for the front page.
 *
 * @package Minhaz_LMS
 */

$minhaz_lms_featured_posts = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => false,
		'no_found_rows'       => true,
	)
);

?>
<section class="front-page-section front-page-featured-posts" aria-labelledby="featured-content-title">
	<div class="content-area">
		<div class="section-heading">
			<p class="section-heading__eyebrow"><?php esc_html_e( 'From the journal', 'minhaz-lms' ); ?></p>
			<h2 id="featured-content-title" class="section-heading__title"><?php esc_html_e( 'Featured learning content', 'minhaz-lms' ); ?></h2>
		</div>
		<div class="featured-posts-grid">
			<?php if ( $minhaz_lms_featured_posts->have_posts() ) : ?>
				<?php while ( $minhaz_lms_featured_posts->have_posts() ) : ?>
					<?php $minhaz_lms_featured_posts->the_post(); ?>
					<?php get_template_part( 'template-parts/content/content', get_post_type() ); ?>
				<?php endwhile; ?>
			<?php else : ?>
				<div class="homepage-empty-state">
					<p class="homepage-empty-state__title"><?php esc_html_e( 'Your featured learning content will appear here.', 'minhaz-lms' ); ?></p>
					<p><?php esc_html_e( 'Publish WordPress posts to begin building this section with your own content.', 'minhaz-lms' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php wp_reset_postdata(); ?>
