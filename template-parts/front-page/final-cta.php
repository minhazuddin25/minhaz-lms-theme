<?php
/**
 * Editable final call to action.
 *
 * @package Minhaz_LMS
 */

$minhaz_lms_final_heading = get_theme_mod( 'minhaz_lms_final_cta_heading', esc_html__( 'Ready for your next learning step?', 'minhaz-lms' ) );
$minhaz_lms_final_text    = get_theme_mod( 'minhaz_lms_final_cta_description', esc_html__( 'Choose a clear next step for your visitors and guide them to the right destination.', 'minhaz-lms' ) );
$minhaz_lms_primary_cta   = minhaz_lms_get_cta( 'primary' );
$minhaz_lms_secondary_cta = minhaz_lms_get_cta( 'secondary' );
?>
<section class="front-page-section final-cta" aria-labelledby="final-cta-title">
	<div class="content-area">
		<div class="final-cta__panel">
			<h2 id="final-cta-title" class="section-heading__title"><?php echo esc_html( $minhaz_lms_final_heading ); ?></h2>
			<?php if ( $minhaz_lms_final_text ) : ?><p><?php echo esc_html( $minhaz_lms_final_text ); ?></p><?php endif; ?>
			<?php if ( minhaz_lms_has_cta( $minhaz_lms_primary_cta ) || minhaz_lms_has_cta( $minhaz_lms_secondary_cta ) ) : ?>
				<div class="front-page-hero__actions">
					<?php if ( minhaz_lms_has_cta( $minhaz_lms_primary_cta ) ) : ?><a class="button" href="<?php echo esc_url( $minhaz_lms_primary_cta['url'] ); ?>"><?php echo esc_html( $minhaz_lms_primary_cta['label'] ); ?></a><?php endif; ?>
					<?php if ( minhaz_lms_has_cta( $minhaz_lms_secondary_cta ) ) : ?><a class="button button--secondary" href="<?php echo esc_url( $minhaz_lms_secondary_cta['url'] ); ?>"><?php echo esc_html( $minhaz_lms_secondary_cta['label'] ); ?></a><?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
