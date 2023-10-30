<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sweetweb
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('sweetweb_container_type');
?>

<div class="wrapper" id="archive-wrapper">
    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">
        <main class="site-main" id="main">
            <div class="">
                <?php
                if (have_posts()) {
                    // Start the loop.
                    while (have_posts()) {
                        the_post();
                        $post_id = get_the_ID();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'large');
                        // print_r($image);
                    ?>
                        <div class="row mt-3">
                            <div class="col-md-8">
                                <div class="shadow-sm px-3 py-2 bg-white rounded mb-3 heading-style">
                                    <h1 class="h3">
                                        <?php echo get_the_title(); ?>
                                    </h1>
                                </div>
                                <div class="ratio ratio-21x9 mb-3">
                                    <img class="rounded object-fit-cover w-100 h-100" src="<?php echo $image[0] ? $image[0] : ''; ?>" alt="<?php echo get_the_title() ?>;">
                                </div>
                                <div class="card mb-3 border-0 shadow-sm">
                                    <div class="card-header border-0 heading-style">
                                        <h3>Special Features</h3>
                                    </div>
                                    <div class="card-body">
                                        <?php echo wss_list_feature(); ?>
                                    </div>
                                </div>
                                <div class="card border-0 mb-3 shadow-sm">
                                    <div class="card-header border-0 heading-style">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <h3>Galeri Gambar</h3>
                                            </div>
                                            <div class="col-3 text-end">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                    <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php echo wss_gallery() ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <?php
                                    // Panggil fungsi untuk mendapatkan video dalam elemen HTML dengan format oembed dari custom post meta dengan nama "video"
                                    $video_html = wss_get_video();

                                    // Tampilkan video dalam elemen HTML
                                    echo $video_html;
                                    ?>
                                </div>
                                <div class="card mb-3 border-0 shadow-sm">
                                    <div class="card-header border-0 heading-style">
                                        <h2 >
                                            <?php echo get_the_title(); ?>
                                        </h2>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        // Panggil fungsi untuk mendapatkan konten deskripsi dari custom post meta dengan nama "deskripsi"
                                        echo '<div class="description-content">';
                                        echo get_the_content();
                                        echo '</div>';
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <?php
                                echo wss_data_sales();
                                echo wss_daftar_harga();
                                ?>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    get_template_part('loop-templates/content', 'none');
                }
                ?>
            </div>
        </main><!-- #main -->

    </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
