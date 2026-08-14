<?php
/**
 * Static front-page template.
 *
 * @package Minhaz_LMS
 */

get_header();
?>
<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
	<?php get_template_part( 'template-parts/front-page/hero' ); ?>
	<?php get_template_part( 'template-parts/front-page/trust-statistics' ); ?>
	<?php get_template_part( 'template-parts/front-page/learning-benefits' ); ?>
	<?php get_template_part( 'template-parts/front-page/featured-posts' ); ?>
	<?php get_template_part( 'template-parts/front-page/topic-categories' ); ?>
	<?php get_template_part( 'template-parts/front-page/featured-author' ); ?>
	<?php get_template_part( 'template-parts/front-page/testimonial' ); ?>
	<?php get_template_part( 'template-parts/front-page/final-cta' ); ?>
	<?php get_template_part( 'template-parts/front-page/content' ); ?>
<?php endwhile; ?>
<?php get_footer(); ?>
