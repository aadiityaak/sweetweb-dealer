<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sweetweb
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'sweetweb_container_type' );
?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

			<main class="site-main" id="main">
				<div class="row">
					<?php
					$query = new WP_Query( array( 'post_type' => 'mobil' ) );
					if ( $query->have_posts() ) {
						// Start the Loop.
						while ( $query->have_posts() ) {
							$query->the_post();

							/*
							* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
							get_template_part( 'template/post-grid' );
						}
					} else {
						get_template_part( 'loop-templates/content', 'none' );
					}
					?>
				</div>
			</main><!-- #main -->

			<!-- The pagination component -->
			<?php sweetweb_pagination(); ?>

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
