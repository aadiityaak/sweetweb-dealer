<?php

/**
 * Sweetweb Theme Customizer
 *
 * @package Sweetweb Dealer
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// Funsdi untuk mendapatkan harga pertama dari post meta harga
function wss_first_price($post_id = null)
{
    ob_start();
    $harga_array = get_post_meta($post_id, 'harga', true); // output array
    $harga_mobil = isset($harga_array[0][1]) ? 'Rp ' . number_format(preg_replace("/[^0-9]/", "", $harga_array[0][1]), 2, ',', '.') : '-';
    return $harga_mobil; // Capture and return the buffered output
}


//Fungsi Feature Spesial
function wss_list_feature() {
    global $post;
    $fitur_spesial_values = get_post_meta($post->ID, 'fitur_spesial', true);

    if (!empty($fitur_spesial_values) && is_array($fitur_spesial_values)) {
        $columns_per_row = 3;
        $chunks = array_chunk($fitur_spesial_values, ceil(count($fitur_spesial_values) / $columns_per_row));

        echo '<div class="row">';
        foreach ($chunks as $chunk) {
            echo '<div class="col-md-' . (12 / $columns_per_row) . '">';
            foreach ($chunk as $fitur_spesial_value) {
                echo '<p class="my-1">';
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/></svg> ';
                echo esc_html($fitur_spesial_value);
                echo '</p>';
            }
            echo '</div>';
        }
        echo '</div>';
    }
}

// Fungsi total type mobil
function wss_count_types() {
    global $post;
    $harga_values = get_post_meta($post->ID, 'harga', true);
    return count($harga_values);
}


// Fungsi harga produk
function wss_price() {
    $hargas = get_post_meta(get_the_ID(), 'harga', true);
    ob_start();
    ?>
    <table class="table table-pricelist">
        <thead class="">
            <tr>
                  <th scope="col">Type</th>
                  <th class="text-end" scope="col">Chat</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($hargas) {
            foreach ($hargas as $harga) {
                $tipe_mobil = isset($harga[0]) ? $harga[0] : '-';
                $harga_mobil = isset($harga[1]) ? 'Rp ' . number_format(preg_replace("/[^0-9]/", "", $harga[1]), 2, ',', '.') : '-';
                $whatsapp_url = 'https://api.whatsapp.com/send?phone=628512345678&text=Saya%20tertarik%20dengan%20' . rawurlencode($tipe_mobil);
                ?>
                <tr>
                    <td>
                        <?php echo $tipe_mobil;?><br> <small><?php echo $harga_mobil;?></small>
                    </td>
                    <td class="text-end"><a class="btn btn-success text-white " href="' . esc_url($whatsapp_url) . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/></svg></a></td>
                </tr>
            <?php
            }
        } else {
        ?>
        <tr>
            <td colspan="3">Tidak Ada Data</td>
        </tr>
    
    <?php
    }
    ?>
        </tbody>
    </table>
    <?php
    return ob_get_clean();
}




//FUNGSI GALERI
function wss_gallery()
{
    ob_start();
    global $post;
    $post_id = $post->ID;
    $gallery = get_post_meta($post_id, 'gallery', false);

    ?>
    <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
        <?php
        $i = 0;
        foreach ($gallery as $gal) {
            $image_url = wp_get_attachment_url($gal);
            $j = $i++;
            $active =  ($j == 0) ? 'active' : '';
            echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$j.'" class="'.$active.'" aria-current="true" aria-label="Slide 1"></button>';
        }
        ?>
    </div>
    <div class="carousel-inner">
    <?php
        $i = 0;
        foreach ($gallery as $gal) {
            $image_url = wp_get_attachment_url($gal);
            $j = $i++;
            $active =  ($j == 0) ? 'active' : '';
            echo '<div class="carousel-item '.$active.'">';
                echo '<div class="px-1 rounded d-block w-100">';
                    // echo '<a href="' . $image_url . '" class="glightbox" data-gallery="gallery1">';
                        echo '<img class="w-100" src="' . $image_url . '" alt="">';
                    // echo '</a>';
                echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
    <?php
    return ob_get_clean();
}


//FUNGSI URL VIDEO
function wss_get_video()
{
    global $post;
    $post_id = $post->ID;

    // Dapatkan kode oembed dari custom post meta dengan nama "video"
    $video_oembed = get_post_meta($post_id, 'video', true);
    $video_oembed = wss_youtube_id($video_oembed);
    // Tampilkan video dalam elemen HTML dengan format oembed
    ob_start();
    if ($video_oembed) {
        echo '<div class="ratio ratio-16x9">';
            echo '<iframe class="rounded" width="100%" src="https://www.youtube.com/embed/'.$video_oembed.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';

        echo '</div>';
    } else {
        echo 'Video tidak tersedia.';
    }

    // Kembalikan video dalam elemen HTML
    return ob_get_clean();
}

// Mendapatkan ID Video
function wss_youtube_id($url) {
    $query = parse_url($url, PHP_URL_QUERY);

    // Check if the video ID is in the query string
    parse_str($query, $params);
    if (isset($params['v'])) {
        return $params['v'];
    }

    // If the video ID is not in the query string, check if it's in the path
    $path = parse_url($url, PHP_URL_PATH);
    $parts = explode('/', trim($path, '/'));
    if (count($parts) > 0) {
        return end($parts); // Get the last part of the path
    }

    return false; // Video ID not found in the URL
}


//FUNCTION SLEDER POST MOBIL
function wss_carousel(){
    ob_start();
    ?>
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <?php
                $query = new WP_Query(array('post_type' => 'mobil'));
                if ($query->have_posts()) {
                ?>
            <header class="page-header">
                <?php
                        the_archive_title('<h1 class="page-title">', '</h1>');
                        the_archive_description('<div class="taxonomy-description">', '</div>');
                        ?>
            </header><!-- .page-header -->
            <?php
                    // Start the loop.
                    $i = 0;
                    while ($query->have_posts()) {
                        $query->the_post();

                        // print_r($image);
                        $active = ($i++ == 0) ? 'active' : '';
                    ?>
            <div class="carousel-item <?php echo $active ?>">
                <?php echo wss_product(); ?>
            </div>
            <?php

                    }
                } else {
                    get_template_part('loop-templates/content', 'none');
                }
                ?>


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php
    return ob_get_clean();
}


// FUNCTION PRODUK
function wss_product()
{
    ob_start();
    $post_id = get_the_ID();
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'large');
    ?>
    <div class="card bg-light p-3 border-0" style="--bs-bg-opacity: .5;">
        <a href="<?php echo get_the_permalink(); ?>">
            <div class="ratio ratio-4x3">
                <img class="rounded sweet-child-ratio" src="<?php echo $image[0] ? $image[0] : ''; ?>"
                    alt="<?php echo get_the_title() ?>;">
            </div>
        </a>
        <h2 >
            <a href="<?php echo get_the_permalink(); ?>">
                <?php echo get_the_title(); ?>
            </a>
        </h2>
        <small>Harga Mulai</small>
        <h4 class="h5"><?php echo wss_first_price($post_id); ?></h3>
            <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-danger">Selengkapnya »</a>
    </div>
    <?php
    return ob_get_clean();
}

function wss_daftar_harga(){
    ob_start();
    ?>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-dark text-white border-0 heading-style">
            <div class="row align-items-center">
                <div class="col-9">
                    <h3>Daftar Harga</h3>
                </div>
                <div class="col-3 text-end">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-car-front-fill" viewBox="0 0 16 16">
                        <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="text-center py-2">
                <?php
                $total_types = wss_count_types();
                ?>
                <button type="button" class="btn btn-outline-dark rounded-pill">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/></svg> 
                    Tersedia <?php echo $total_types; ?> Type
                </button>
            </div>
            <div>
                <?php echo wss_price(); ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

function wss_data_sales() {
    ob_start();
    ?>
    <div class="card mb-3 border-0 shadow-sm">
        <div class="ratio" style="padding-bottom:130%;">
                <?php 
                    $value = get_theme_mod( 'sales_photo');
                    echo '<img class="w-100 h-100 object-fit-cover rounded" src="'.$value.'" class="card-img-top" alt="">';
                ?>
        </div>
        <div class="card-body bg-primary text-white rounded">
            <h5 class="card-title sales-name">
                <?php 
                    $value = get_theme_mod( 'sales_name');
                    echo $value;
                ?>
            </h5>
            <p class="card-text">
                <?php 
                    $value = get_theme_mod( 'sales_bio');
                    echo $value;
                ?>
            </p>
        </div>
    </div>
    <?php
    return ob_get_clean();
}