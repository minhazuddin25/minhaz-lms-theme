<?php
/**
 * Archive template.
 *
 * @package Minhaz_LMS
 */

get_header();
?>
<div class="content-area content-area--with-sidebar">
	<section class="site-content">
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<?php the_archive_title( '<h1 class="archive-title">', '</h1>' ); ?>
				<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
			</header>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php get_template_part( 'template-parts/content/content', get_post_type() ); ?>
			<?php endwhile; ?>
			<?php the_posts_navigation(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
		<?php endif; ?>
	</section>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
