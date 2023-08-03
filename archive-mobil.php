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

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php get_template_part('global-templates/left-sidebar-check'); ?>

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
                            // print_r($image);
                        ?>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="<?php echo get_the_permalink(); ?>">
                                <img class="rounded sweet-child ratio ratio-4x3"
                                    src="<?php echo $image[0] ? $image[0] : ''; ?>"
                                    alt="<?php echo get_the_title() ?>;">
                            </a>
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

            <?php
            // Display the pagination component.
            sweetweb_pagination();
            // Do the right sidebar check.
            get_template_part('global-templates/right-sidebar-check');
            ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();