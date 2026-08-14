<?php
/**
 * Front-page hero based on presentation settings.
 *
 * @package Minhaz_LMS
 */
?>
<?php
$minhaz_lms_hero_eyebrow     = get_theme_mod( 'minhaz_lms_hero_eyebrow', esc_html__( 'LEARN WITHOUT LIMITS', 'minhaz-lms' ) );
$minhaz_lms_hero_heading     = get_theme_mod( 'minhaz_lms_hero_heading', esc_html__( 'Learn. Grow. Succeed.', 'minhaz-lms' ) );
$minhaz_lms_hero_description = get_theme_mod( 'minhaz_lms_hero_description', esc_html__( 'Build your skills with professional online courses designed to help you learn faster and achieve more.', 'minhaz-lms' ) );
$minhaz_lms_hero_image_id    = absint( get_theme_mod( 'minhaz_lms_hero_image', 0 ) );
?>
<section class="front-page-hero">
	<div class="front-page-hero__inner">
		<div class="front-page-hero__content">
			<?php if ( $minhaz_lms_hero_eyebrow ) : ?>
				<p class="front-page-hero__eyebrow"><?php echo esc_html( $minhaz_lms_hero_eyebrow ); ?></p>
			<?php endif; ?>
			<?php if ( $minhaz_lms_hero_heading ) : ?>
				<h1 class="front-page-hero__title"><?php echo esc_html( $minhaz_lms_hero_heading ); ?></h1>
			<?php endif; ?>
			<?php if ( $minhaz_lms_hero_description ) : ?>
				<p class="front-page-hero__description"><?php echo esc_html( $minhaz_lms_hero_description ); ?></p>
			<?php endif; ?>
			<?php $minhaz_lms_primary_cta = minhaz_lms_get_cta( 'primary' ); ?>
			<?php $minhaz_lms_secondary_cta = minhaz_lms_get_cta( 'secondary' ); ?>
			<?php if ( minhaz_lms_has_cta( $minhaz_lms_primary_cta ) || minhaz_lms_has_cta( $minhaz_lms_secondary_cta ) ) : ?>
				<div class="front-page-hero__actions">
					<?php if ( minhaz_lms_has_cta( $minhaz_lms_primary_cta ) ) : ?>
						<a class="button" href="<?php echo esc_url( $minhaz_lms_primary_cta['url'] ); ?>"><?php echo esc_html( $minhaz_lms_primary_cta['label'] ); ?></a>
					<?php endif; ?>
					<?php if ( minhaz_lms_has_cta( $minhaz_lms_secondary_cta ) ) : ?>
						<a class="button button--secondary" href="<?php echo esc_url( $minhaz_lms_secondary_cta['url'] ); ?>"><?php echo esc_html( $minhaz_lms_secondary_cta['label'] ); ?></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="front-page-hero__visual">
			<?php if ( $minhaz_lms_hero_image_id ) : ?>
				<?php echo wp_get_attachment_image( $minhaz_lms_hero_image_id, 'large', false, array( 'class' => 'front-page-hero__image' ) ); ?>
			<?php else : ?>
				<div class="front-page-hero__placeholder" aria-hidden="true"><span></span><span></span><span></span></div>
			<?php endif; ?>
		</div>
	</div>
</section>
