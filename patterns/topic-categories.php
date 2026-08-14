<?php
/**
 * Title: Topic categories
 * Slug: minhaz-lms/topic-categories
 * Categories: text
 * Description: A section that displays native WordPress post categories.
 *
 * @package Minhaz_LMS
 */
?>
<!-- wp:group {"tagName":"section","className":"minhaz-lms-pattern-section","layout":{"type":"constrained"}} --><section class="wp-block-group minhaz-lms-pattern-section">
<!-- wp:heading {"textAlign":"center","level":2} --><h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Explore topics', 'minhaz-lms' ); ?></h2><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center"><?php esc_html_e( 'Use your existing WordPress categories to help visitors find relevant content.', 'minhaz-lms' ); ?></p><!-- /wp:paragraph -->
<!-- wp:categories {"showHierarchy":true,"showPostCounts":true,"className":"minhaz-lms-category-list"} /-->
</section><!-- /wp:group -->
