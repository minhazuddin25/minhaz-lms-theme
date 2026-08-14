<?php
/**
 * Single post content.
 *
 * @package Minhaz_LMS
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php minhaz_lms_posted_on(); ?>
	</header>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail"><?php the_post_thumbnail( 'large' ); ?></div>
	<?php endif; ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'minhaz-lms' ) . '">', 'after' => '</nav>' ) ); ?>
	</div>
	<footer class="entry-footer"><?php the_category( ', ' ); ?> <?php the_tags( '<span class="tags-links">', ', ', '</span>' ); ?></footer>
</article>
