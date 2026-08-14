<?php
/**
 * 404 template.
 *
 * @package Minhaz_LMS
 */

get_header();
?>
<div class="content-area"><section class="site-content not-found">
	<header class="page-header"><h1 class="page-title"><?php esc_html_e( 'Page not found', 'minhaz-lms' ); ?></h1></header>
	<p><?php esc_html_e( 'The page you requested could not be found. Try a search instead.', 'minhaz-lms' ); ?></p>
	<?php get_search_form(); ?>
</section></div>
<?php get_footer(); ?>
