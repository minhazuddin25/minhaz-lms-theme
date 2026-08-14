<?php
/**
 * Single post template.
 *
 * @package Minhaz_LMS
 */

get_header();
?>
<div class="content-area content-area--with-sidebar">
	<section class="site-content">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php get_template_part( 'template-parts/content/content', 'single' ); ?>
			<?php the_post_navigation(); ?>
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template(); ?>
			<?php endif; ?>
		<?php endwhile; ?>
	</section>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
