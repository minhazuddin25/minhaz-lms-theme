<?php
/**
 * Front-page WordPress content.
 *
 * @package Minhaz_LMS
 */

if ( '' === trim( get_post_field( 'post_content', get_the_ID() ) ) ) {
	return;
}
?>
<div class="content-area front-page-content">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry--front-page' ); ?>>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'minhaz-lms' ) . '">', 'after' => '</nav>' ) ); ?>
		</div>
	</article>
	<?php if ( comments_open() || get_comments_number() ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>
</div>
