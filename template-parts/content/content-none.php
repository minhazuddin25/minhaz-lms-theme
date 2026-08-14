<?php
/**
 * No-results content.
 *
 * @package Minhaz_LMS
 */
?>
<section class="no-results not-found">
	<header class="page-header"><h1 class="page-title"><?php esc_html_e( 'Nothing found', 'minhaz-lms' ); ?></h1></header>
	<div class="page-content">
		<?php if ( is_search() ) : ?>
			<p><?php esc_html_e( 'No results matched your search. Please try again.', 'minhaz-lms' ); ?></p>
		<?php else : ?>
			<p><?php esc_html_e( 'There is no content to display yet.', 'minhaz-lms' ); ?></p>
		<?php endif; ?>
		<?php get_search_form(); ?>
	</div>
</section>
