<?php

/**
 * Sweetweb Theme Customizer
 *
 * @package Sweetweb Dealer
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// membuat post type mobil
function create_post_type_mobil()
{
    register_post_type(
        'mobil',
        array(
            'labels' => array(
                'name' => 'Mobil',
                'singular_name' => 'Mobil'
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'mobil'),
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon'   => 'dashicons-car',
            'show_in_rest' => false
        )
    );
}
add_action('init', 'create_post_type_mobil');
