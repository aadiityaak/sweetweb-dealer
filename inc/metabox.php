<?php

/**
 * Sweetweb Theme Customizer
 *
 * @package Sweetweb Dealer
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// METABOX CUSTOM MOBIL
add_filter('rwmb_meta_boxes', 'your_prefix_register_meta_boxes');

function your_prefix_register_meta_boxes($meta_boxes)
{
    $prefix = '';

    $meta_boxes[] = [
        'title'      => esc_html__('Detail Produk', 'online-generator'),
        'id'         => 'detail-produk',
        'post_types' => ['mobil'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type'  => 'key_value',
                'name'  => esc_html__('Harga', 'online-generator'),
                'id'    => $prefix . 'harga',
                'desc'  => esc_html__('Tuliskan Type = harga Contoh: Civic tipe R=IDR 1.400.500.000', 'online-generator'),
                'clone' => true,
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Fitur Spesial', 'online-generator'),
                'id'   => $prefix . 'fitur_spesial',
                'clone' => true,
            ],
            [
                'type' => 'image_advanced',
                'name' => esc_html__('Gallery', 'online-generator'),
                'id'   => $prefix . 'gallery',
            ],
            [
                'type' => 'oembed',
                'name' => esc_html__('Video', 'online-generator'),
                'id'   => $prefix . 'video',
            ],
        ],
    ];

    return $meta_boxes;
}
