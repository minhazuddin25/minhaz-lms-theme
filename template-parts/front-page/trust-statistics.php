<?php
/**
 * Native WordPress statistics strip.
 *
 * @package Minhaz_LMS
 */

$minhaz_lms_statistics = minhaz_lms_get_site_statistics();
?>
<section class="trust-statistics" aria-label="<?php esc_attr_e( 'Site statistics', 'minhaz-lms' ); ?>">
	<div class="content-area trust-statistics__inner">
		<?php foreach ( $minhaz_lms_statistics as $minhaz_lms_statistic ) : ?>
			<div class="trust-statistics__item">
				<strong><?php echo esc_html( number_format_i18n( $minhaz_lms_statistic['value'] ) ); ?></strong>
				<span><?php echo esc_html( $minhaz_lms_statistic['label'] ); ?></span>
			</div>
		<?php endforeach; ?>
	</div>
</section>
