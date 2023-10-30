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
                        get_template_part( 'template/post-grid' );
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