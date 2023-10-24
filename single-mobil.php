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
                ?>
                    <header class="page-header">
                        <?php
                        the_archive_title('<h1 class="page-title">', '</h1>');
                        the_archive_description('<div class="taxonomy-description">', '</div>');
                        ?>
                    </header><!-- .page-header -->
                    <?php
                    // Start the loop.
                    while (have_posts()) {
                        the_post();
                        $post_id = get_the_ID();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'large');
                        // print_r($image);
                    ?>
                        <div class="">
                            <div class="ratio ratio-21x9">
                                <img class="rounded sweet-child-ratio" src="<?php echo $image[0] ? $image[0] : ''; ?>" alt="<?php echo get_the_title() ?>;">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-8">
                                <div class="card  mb-4 rounded-0">
                                    <div class="card-header">
                                        <h3 class="mb-0">Special Features</h3>
                                    </div>
                                    <div class="card-body">
                                        <?php echo create_func_feature(); ?>
                                    </div>
                                </div>
                                <div class="card rounded-0">
                                    <div class="card-header rounded-0 bg-dark text-light">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <h3 class="mb-0">Galeri Gambar</h3>
                                            </div>
                                            <div class="col-3 text-end">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                    <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php echo func_gallery_mobil() ?>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <?php
                                    // Panggil fungsi untuk mendapatkan video dalam elemen HTML dengan format oembed dari custom post meta dengan nama "video"
                                    $video_html = get_video_embed_from_meta();

                                    // Tampilkan video dalam elemen HTML
                                    echo $video_html;
                                    ?>
                                </div>
                                <div class="card my-4 rounded-0">
                                    <div class="card-header">
                                        <h2 class="judul-archive-mobil">
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
                                <div class="card rounded-0">
                                    <div class="card-header rounded-0 bg-dark text-light">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <h3 class="mb-0">Daftar Harga</h3>
                                            </div>
                                            <div class="col-3 text-end">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-car-front-fill" viewBox="0 0 16 16">
                                                    <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <?php
                                            $total_types = count_mobil_types();
                                            ?>
                                            <button type="button" class="btn btn-outline-dark rounded-pill">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/></svg> 
                                                Tersedia <?php echo $total_types; ?> Type
                                            </button>
                                        </div>
                                        <div>
                                            <?php echo harga_produk(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-3" >
                                    <div class="">
                                        <img class="w-100" src="https://template1.sweet.web.id/wp-content/uploads/2023/08/download.webp" class="card-img-top" alt="">
                                    </div>
                                    <div class="card-body bg-dark text-light">
                                        <h5 class="card-title">JULIANA HONDA</h5>
                                        <p class="card-text">
                                            "Apa yang ingin Anda tanyakan? Saya siap membantu untuk
                                            menemukan pilihan yang paling tepat sesuai kebutuhan....."
                                        </p>
                                    </div>
                                </div>
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
