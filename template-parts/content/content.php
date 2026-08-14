<?php
/**
 * Standard loop content.
 *
 * @package Minhaz_LMS
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="entry-card__thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" aria-hidden="true" tabindex="-1"><?php the_post_thumbnail( 'large' ); ?></a>
	<?php endif; ?>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<?php minhaz_lms_posted_on(); ?>
	</header>
	<div class="entry-summary"><?php the_excerpt(); ?></div>
</article>
