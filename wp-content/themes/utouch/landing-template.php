<?php
/**
 * Template Name: Landing page
 */

get_header();

$layout = utouch_sidebar_conf(true);
$main_class = 'full' !== $layout['position'] ? 'site-main content-main-sidebar' : 'site-main content-main-full';
$container_width = 'container';
$padding_class = 'medium-padding30';
$builder_meta = get_post_meta( get_the_ID(), 'kc_data', true );
	if ( isset( $builder_meta['mode'] ) && 'kc' === $builder_meta['mode'] && 'full' === $layout['position'] ) {
	$container_width = 'page-builder-wrap';
    $padding_class = '';
} ?>
	<div id="primary" class="<?php echo esc_attr( $container_width ) ?>">
		<div class="row <?php echo esc_attr( $padding_class ) ?>">
			<div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
				<main id="main" class="<?php echo esc_attr( $main_class ) ?>"  >

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->
			</div>
			<?php if ( 'full' !== $layout['position'] ) { ?>
				<div class="<?php echo esc_attr( $layout['sidebar-classes'] ) ?>">
					<?php get_sidebar(); ?>
				</div>
			<?php } ?>
		</div><!-- #row -->
	</div><!-- #primary -->
<?php
get_footer();
