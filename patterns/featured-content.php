<?php
/**
 * Title: Featured learning content
 * Slug: minhaz-lms/featured-learning-content
 * Categories: text
 * Description: A section that displays recent native WordPress posts.
 *
 * @package Minhaz_LMS
 */
?>
<!-- wp:group {"tagName":"section","className":"minhaz-lms-pattern-section","layout":{"type":"constrained"}} --><section class="wp-block-group minhaz-lms-pattern-section">
<!-- wp:heading {"textAlign":"center","level":2} --><h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Featured learning content', 'minhaz-lms' ); ?></h2><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center"><?php esc_html_e( 'This section automatically displays your most recent WordPress posts.', 'minhaz-lms' ); ?></p><!-- /wp:paragraph -->
<!-- wp:latest-posts {"displayPostDate":true,"displayFeaturedImage":true,"featuredImageSizeSlug":"medium","className":"minhaz-lms-featured-content-list"} /-->
</section><!-- /wp:group -->
