<?php

/**
 * Sweetweb Theme Customizer
 *
 * @package Sweetweb Dealer
 */

use Kirki\Util\Helper;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Do not proceed if Kirki does not exist.
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

Kirki::add_config(
	'wss_dealer_config',
	[
		'option_type' => 'theme_mod',
		'capability'  => 'manage_options',
	]
);

/**
 * Add a panel.
 *
 * @link https://docs.themeum.com/kirki/getting-started/panels-sections/
 */
new \Kirki\Panel(
	'wss_dealer_panel',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Option Dealer', 'kirki' ),
		'description' => esc_html__( 'Option Dealer', 'kirki' ),
	]
);

/**
 * Add Sections.
 *
 * We'll be doing things a bit differently here, just to demonstrate an example.
 * We're going to define 1 section per control-type just to keep things clean and separate.
 *
 * @link https://docs.themeum.com/kirki/getting-started/panels-sections/
 */
$sections = [
    'global'      => [ esc_html__( 'Style', 'kirki' ), '' ],
	'sales'      => [ esc_html__( 'Sales', 'kirki' ), '' ],
];

foreach ( $sections as $section_id => $section ) {
	$section_args = [
		'title'       => $section[0],
		'description' => $section[1],
		'panel'       => 'wss_dealer_panel',
	];
	if ( isset( $section[2] ) ) {
		$section_args['type'] = $section[2];
	}
	new \Kirki\Section( str_replace( '-', '_', $section_id ) . '_section', $section_args );
}


new \Kirki\Field\Color(
	[
		'settings'    => 'primary_color',
		'label'       => __( 'Primary Color', 'kirki' ),
		'description' => esc_html__( 'Warna Utama Website', 'kirki' ),
		'section'     => 'global_section',
		'transport'   => 'postMessage',
		'default'     => 'rgb(145, 0, 0)',
		'choices'     => [
			'alpha' => true,
		],
		'output'   => [
			[
				'element'  => '.bg-primary',
				'property' => 'background-color',
				'suffix'   => ' !important',
			],
			[
				'element'  => '.text-primary',
				'property' => 'color',
				'suffix'   => ' !important',
			]
		],
	]
);

new \Kirki\Field\Background(
	[
		'settings'    => 'wss_dealer_background',
		'label'       => esc_html__( 'Background Control', 'kirki' ),
		'description' => esc_html__( 'Background conrols are pretty complex! (but useful if properly used)', 'kirki' ),
		'section'     => 'global_section',
		'default'     => [
			'background-color'      => 'rgba(255,255,255,1)',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'scroll',
		],
		'output'      => [
			[
				'element' => 'body',
			],
		],
	]
);

new \Kirki\Field\Image(
	[
		'settings'    => 'sales_photo',
		'label'       => esc_html__( 'Foto Sales', 'kirki' ),
		'description' => esc_html__( 'Upload Foto Sales', 'kirki' ),
		'section'     => 'sales_section',
		'default'     => '',
	]
);

new \Kirki\Field\Text(
	[
		'settings'        => 'sales_name',
		'label'           => esc_html__( 'Nama Sales', 'kirki' ),
		'description'     => esc_html__( 'Isi Dengan Nama Sales', 'kirki' ),
		'section'         => 'sales_section',
		'transport'       => 'postMessage',
		'default'         => 'Nur Saputri',
		'partial_refresh' => [
			'generic_text_refresh' => [
				'selector'        => '.sales-name',
				'render_callback' => function() {
					$value = get_theme_mod( 'sales_name' );
					return $value ?? '';
				},
			],
		],
	]
);

new \Kirki\Field\Textarea(
	[
		'settings'    => 'sales_bio',
		'label'       => esc_html__( 'Bio', 'kirki' ),
		'description' => esc_html__( 'Biografi / slogan sales', 'kirki' ),
		'section'     => 'sales_section',
		'default'     => 'Datang dan lihat apa yang kami tawarkan kepada Anda.',
		'partial_refresh' => [
			'generic_text_refresh' => [
				'selector'        => '.sales-bio',
				'render_callback' => function() {
					$value = get_theme_mod( 'sales_bio' );
					return $value ?? '';
				},
			],
		],
	]
);