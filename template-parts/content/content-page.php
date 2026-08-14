<?php
/**
 * Page content.
 *
 * @package Minhaz_LMS
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<header class="entry-header"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></header>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'minhaz-lms' ) . '">', 'after' => '</nav>' ) ); ?>
	</div>
</article>
