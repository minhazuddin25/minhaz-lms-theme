<?php
/**
 * Page template.
 *
 * @package Minhaz_LMS
 */

get_header();
?>
<div class="content-area">
	<section class="site-content">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php get_template_part( 'template-parts/content/content', 'page' ); ?>
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template(); ?>
			<?php endif; ?>
		<?php endwhile; ?>
	</section>
</div>
<?php get_footer(); ?>
