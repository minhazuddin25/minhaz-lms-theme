<?php
/**
 * Header partial.
 *
 * @package Minhaz_LMS
 */
?>
<header id="masthead" class="site-header">
	<div class="site-header__inner">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif; ?>
			<?php endif; ?>
			<?php $minhaz_lms_description = get_bloginfo( 'description', 'display' ); ?>
			<?php if ( $minhaz_lms_description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo esc_html( $minhaz_lms_description ); ?></p>
			<?php endif; ?>
		</div>
		<?php $minhaz_lms_header_cta = minhaz_lms_get_cta( 'primary' ); ?>
		<?php if ( function_exists( 'wp_login_url' ) ) : ?>
			<div class="site-header__actions">
				<?php if ( has_nav_menu( 'primary' ) || current_user_can( 'edit_theme_options' ) ) : ?>
					<button class="minhaz-lms-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<span class="screen-reader-text"><?php esc_html_e( 'Toggle primary navigation', 'minhaz-lms' ); ?></span>
						<span class="minhaz-lms-menu-toggle__icon" aria-hidden="true"></span>
					</button>
					<nav class="minhaz-lms-primary-menu" aria-label="<?php esc_attr_e( 'Primary navigation', 'minhaz-lms' ); ?>">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => false, 'fallback_cb' => 'minhaz_lms_primary_menu_fallback' ) ); ?>
					</nav>
				<?php endif; ?>
				<?php if ( minhaz_lms_has_cta( $minhaz_lms_header_cta ) ) : ?>
					<a class="button button--compact site-header__cta" href="<?php echo esc_url( $minhaz_lms_header_cta['url'] ); ?>"><?php echo esc_html( $minhaz_lms_header_cta['label'] ); ?></a>
				<?php endif; ?>
				<a class="site-header__account" href="<?php echo esc_url( is_user_logged_in() ? admin_url( 'profile.php' ) : wp_login_url() ); ?>">
					<?php echo esc_html( is_user_logged_in() ? __( 'My account', 'minhaz-lms' ) : __( 'Log in', 'minhaz-lms' ) ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</header>
