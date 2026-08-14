<?php
/**
 * Optional testimonial presentation section.
 *
 * @package Minhaz_LMS
 */

$minhaz_lms_testimonial_quote = get_theme_mod( 'minhaz_lms_testimonial_quote', '' );
$minhaz_lms_testimonial_name  = get_theme_mod( 'minhaz_lms_testimonial_name', '' );
?>
<section class="front-page-section testimonial-section" aria-labelledby="testimonial-title">
	<div class="content-area">
		<div class="testimonial-panel">
			<?php if ( $minhaz_lms_testimonial_quote ) : ?>
				<p class="section-heading__eyebrow"><?php esc_html_e( 'Shared experience', 'minhaz-lms' ); ?></p>
				<blockquote id="testimonial-title"><p><?php echo esc_html( $minhaz_lms_testimonial_quote ); ?></p><?php if ( $minhaz_lms_testimonial_name ) : ?><cite><?php echo esc_html( $minhaz_lms_testimonial_name ); ?></cite><?php endif; ?></blockquote>
			<?php else : ?>
				<h2 id="testimonial-title" class="section-heading__title"><?php esc_html_e( 'Share a real learner experience', 'minhaz-lms' ); ?></h2>
				<p><?php esc_html_e( 'Add a verified, permissioned testimonial in the Customizer when one is available. Until then, this intentional placeholder keeps the section honest.', 'minhaz-lms' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
