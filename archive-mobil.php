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
            <div class="row">
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
                        ?>
                        <div class="col-md-4">
                            <div class="card border-0 mb-3">
                                <div class="ratio ratio-4x3">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <img class="w-100 h-100 object-fit-cover rounded"
                                            src="<?php echo $image[0] ? $image[0] : ''; ?>"
                                            alt="<?php echo get_the_title() ?>;">
                                    </a>
                                </div>

                                <div class="py-2">
                                    <h2 class="archive-title mb-1"> 
                                        <a class="text-dark" href="<?php echo get_the_permalink(); ?>">
                                            <?php echo get_the_title() ?>
                                        </a>
                                    </h2>
                                    <small class="text-muted">Mulai Dari <?php echo wss_first_price($post_id); ?></small>
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