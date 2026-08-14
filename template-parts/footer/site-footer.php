<?php
/**
 * Footer partial.
 *
 * @package Minhaz_LMS
 */
?>
<footer id="colophon" class="site-footer">
	<div class="site-footer__inner">
		<div class="site-footer__brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<p class="site-footer__title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
			<?php $minhaz_lms_footer_description = get_bloginfo( 'description', 'display' ); ?>
			<?php if ( $minhaz_lms_footer_description ) : ?>
				<p class="site-footer__description"><?php echo esc_html( $minhaz_lms_footer_description ); ?></p>
			<?php endif; ?>
		</div>
		<?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
			<div class="footer-widgets"><?php dynamic_sidebar( 'footer-widgets' ); ?></div>
		<?php endif; ?>
		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social links', 'minhaz-lms' ); ?>">
				<?php wp_nav_menu( array( 'theme_location' => 'social', 'container' => false, 'menu_class' => 'social-menu' ) ); ?>
			</nav>
		<?php endif; ?>
		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav aria-label="<?php esc_attr_e( 'Footer navigation', 'minhaz-lms' ); ?>">
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'menu_class' => 'footer-menu' ) ); ?>
			</nav>
		<?php endif; ?>
		<p class="site-info">&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>. <?php esc_html_e( 'Built for learning.', 'minhaz-lms' ); ?></p>
	</div>
</footer>
