<?php
/**
 * Presentation settings for the Customizer.
 *
 * @package Minhaz_LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers optional presentation settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function minhaz_lms_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'minhaz_lms_presentation',
		array(
			'title'       => esc_html__( 'Minhaz LMS Presentation', 'minhaz-lms' ),
			'description' => esc_html__( 'Optional calls to action and front-page presentation controls.', 'minhaz-lms' ),
			'priority'    => 30,
		)
	);

	$wp_customize->add_section(
		'minhaz_lms_hero',
		array(
			'title' => esc_html__( 'Hero', 'minhaz-lms' ),
			'panel' => 'minhaz_lms_presentation',
		)
	);

	$minhaz_lms_hero_text_settings = array(
		'minhaz_lms_hero_eyebrow'     => array(
			'label'   => esc_html__( 'Hero eyebrow', 'minhaz-lms' ),
			'default' => esc_html__( 'LEARN WITHOUT LIMITS', 'minhaz-lms' ),
		),
		'minhaz_lms_hero_heading'     => array(
			'label'   => esc_html__( 'Hero heading', 'minhaz-lms' ),
			'default' => esc_html__( 'Learn. Grow. Succeed.', 'minhaz-lms' ),
		),
		'minhaz_lms_hero_description' => array(
			'label'   => esc_html__( 'Hero description', 'minhaz-lms' ),
			'default' => esc_html__( 'Build your skills with professional online courses designed to help you learn faster and achieve more.', 'minhaz-lms' ),
		),
	);

	foreach ( $minhaz_lms_hero_text_settings as $minhaz_lms_setting => $minhaz_lms_setting_args ) {
		$wp_customize->add_setting(
			$minhaz_lms_setting,
			array(
				'default'           => $minhaz_lms_setting_args['default'],
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);
		$wp_customize->add_control(
			$minhaz_lms_setting,
			array(
				'label'   => $minhaz_lms_setting_args['label'],
				'section' => 'minhaz_lms_hero',
				'type'    => 'textarea',
			)
		);
	}

	$wp_customize->add_setting(
		'minhaz_lms_hero_image',
		array(
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'minhaz_lms_hero_image',
			array(
				'label'       => esc_html__( 'Hero image', 'minhaz-lms' ),
				'description' => esc_html__( 'Optional image displayed on the right side of the homepage hero.', 'minhaz-lms' ),
				'section'     => 'minhaz_lms_hero',
				'mime_type'   => 'image',
			)
		)
	);

	$wp_customize->add_section(
		'minhaz_lms_calls_to_action',
		array(
			'title' => esc_html__( 'Calls to Action', 'minhaz-lms' ),
			'panel' => 'minhaz_lms_presentation',
		)
	);

	$minhaz_lms_text_settings = array(
		'minhaz_lms_primary_cta_label'   => array(
			'label'   => esc_html__( 'Primary CTA label', 'minhaz-lms' ),
			'default' => esc_html__( 'Explore Courses', 'minhaz-lms' ),
		),
		'minhaz_lms_secondary_cta_label' => array(
			'label'   => esc_html__( 'Secondary CTA label', 'minhaz-lms' ),
			'default' => esc_html__( 'Get Started', 'minhaz-lms' ),
		),
	);

	foreach ( $minhaz_lms_text_settings as $minhaz_lms_setting => $minhaz_lms_setting_args ) {
		$wp_customize->add_setting(
			$minhaz_lms_setting,
			array(
				'default'           => $minhaz_lms_setting_args['default'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$minhaz_lms_setting,
			array(
				'label'   => $minhaz_lms_setting_args['label'],
				'section' => 'minhaz_lms_calls_to_action',
				'type'    => 'text',
			)
		);
	}

	$minhaz_lms_url_settings = array(
		'minhaz_lms_primary_cta_url'   => esc_html__( 'Primary CTA URL', 'minhaz-lms' ),
		'minhaz_lms_secondary_cta_url' => esc_html__( 'Secondary CTA URL', 'minhaz-lms' ),
	);

	foreach ( $minhaz_lms_url_settings as $minhaz_lms_setting => $minhaz_lms_label ) {
		$wp_customize->add_setting(
			$minhaz_lms_setting,
			array(
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			$minhaz_lms_setting,
			array(
				'label'   => $minhaz_lms_label,
				'section' => 'minhaz_lms_calls_to_action',
				'type'    => 'url',
			)
		);
	}

	$wp_customize->add_section(
		'minhaz_lms_testimonial',
		array(
			'title' => esc_html__( 'Testimonial', 'minhaz-lms' ),
			'panel' => 'minhaz_lms_presentation',
		)
	);
	$minhaz_lms_testimonial_settings = array(
		'minhaz_lms_testimonial_quote' => esc_html__( 'Testimonial quote', 'minhaz-lms' ),
		'minhaz_lms_testimonial_name'  => esc_html__( 'Testimonial name and role', 'minhaz-lms' ),
	);
	foreach ( $minhaz_lms_testimonial_settings as $minhaz_lms_setting => $minhaz_lms_label ) {
		$wp_customize->add_setting(
			$minhaz_lms_setting,
			array(
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);
		$wp_customize->add_control(
			$minhaz_lms_setting,
			array(
				'label'   => $minhaz_lms_label,
				'section' => 'minhaz_lms_testimonial',
				'type'    => 'textarea',
			)
		);
	}

	$wp_customize->add_section(
		'minhaz_lms_final_cta',
		array(
			'title' => esc_html__( 'Final Call to Action', 'minhaz-lms' ),
			'panel' => 'minhaz_lms_presentation',
		)
	);
	$minhaz_lms_final_cta_settings = array(
		'minhaz_lms_final_cta_heading'     => array(
			'label'   => esc_html__( 'Final CTA heading', 'minhaz-lms' ),
			'default' => esc_html__( 'Ready for your next learning step?', 'minhaz-lms' ),
		),
		'minhaz_lms_final_cta_description' => array(
			'label'   => esc_html__( 'Final CTA description', 'minhaz-lms' ),
			'default' => esc_html__( 'Choose a clear next step for your visitors and guide them to the right destination.', 'minhaz-lms' ),
		),
	);
	foreach ( $minhaz_lms_final_cta_settings as $minhaz_lms_setting => $minhaz_lms_setting_args ) {
		$wp_customize->add_setting(
			$minhaz_lms_setting,
			array(
				'default'           => $minhaz_lms_setting_args['default'],
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);
		$wp_customize->add_control(
			$minhaz_lms_setting,
			array(
				'label'   => $minhaz_lms_setting_args['label'],
				'section' => 'minhaz_lms_final_cta',
				'type'    => 'textarea',
			)
		);
	}
}
add_action( 'customize_register', 'minhaz_lms_customize_register' );
