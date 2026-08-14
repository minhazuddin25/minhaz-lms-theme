<?php
/**
 * Presentation-only learning benefits section.
 *
 * @package Minhaz_LMS
 */

$minhaz_lms_benefits = array(
	array(
		'title'       => esc_html__( 'Thoughtful learning paths', 'minhaz-lms' ),
		'description' => esc_html__( 'Organize your own content into clear, purposeful journeys for visitors.', 'minhaz-lms' ),
	),
	array(
		'title'       => esc_html__( 'Focused knowledge', 'minhaz-lms' ),
		'description' => esc_html__( 'Share useful articles and resources in a calm, distraction-free reading experience.', 'minhaz-lms' ),
	),
	array(
		'title'       => esc_html__( 'Built to grow with you', 'minhaz-lms' ),
		'description' => esc_html__( 'Start with native WordPress content and extend your learning platform when you are ready.', 'minhaz-lms' ),
	),
);
?>
<section class="front-page-section learning-benefits" aria-labelledby="learning-benefits-title">
	<div class="content-area">
		<div class="section-heading section-heading--centered">
			<p class="section-heading__eyebrow"><?php esc_html_e( 'Made for meaningful progress', 'minhaz-lms' ); ?></p>
			<h2 id="learning-benefits-title" class="section-heading__title"><?php esc_html_e( 'A stronger learning experience starts here', 'minhaz-lms' ); ?></h2>
		</div>
		<div class="benefits-grid">
			<?php foreach ( $minhaz_lms_benefits as $minhaz_lms_benefit ) : ?>
				<article class="benefit-card">
					<span class="benefit-card__number" aria-hidden="true"></span>
					<h3><?php echo esc_html( $minhaz_lms_benefit['title'] ); ?></h3>
					<p><?php echo esc_html( $minhaz_lms_benefit['description'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
