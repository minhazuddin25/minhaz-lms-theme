<?php
/**
 * Search results template.
 *
 * @package Minhaz_LMS
 */

get_header();
?>
<div class="content-area content-area--with-sidebar">
	<section class="site-content">
		<header class="archive-header"><h1 class="archive-title"><?php printf( esc_html__( 'Search results for: %s', 'minhaz-lms' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1></header>
		<?php if ( have_posts() ) : ?>
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
