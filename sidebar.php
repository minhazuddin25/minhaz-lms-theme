<?php
/**
 * Primary sidebar.
 *
 * @package Minhaz_LMS
 */

if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
	return;
}
?>
<aside id="secondary" class="widget-area" aria-label="<?php esc_attr_e( 'Sidebar', 'minhaz-lms' ); ?>">
	<?php dynamic_sidebar( 'primary-sidebar' ); ?>
</aside>
