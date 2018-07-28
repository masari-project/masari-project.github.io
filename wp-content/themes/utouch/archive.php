<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */

get_header();
$layout     = utouch_sidebar_conf();
if('full' !== $layout['position']){
	Utouch::set_var('utouch_sidebar_enabled',true);
}
$main_class = 'full' !== $layout['position'] ? 'site-main content-main-sidebar' : 'site-main content-main-full';
set_query_var( 'post_excerpt', get_option( 'rss_use_excerpt' ) );
set_query_var( 'post_layout', $layout['position'] );
?>

	<div id="primary" class="container">
		<div class="row medium-padding30">

			<div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
				<main id="main" class="<?php echo esc_attr( $main_class ) ?>">

					<?php if ( is_author() ) {

						get_template_part( 'parts/author', 'box' );
					} ?>

					<?php
					if ( have_posts() ) :
						$queried_object = get_queried_object();

						if ( is_tax() && 'fw-event-taxonomy-name' === $queried_object->taxonomy ) {

							Utouch::set_var('event_preview_size','small');
							?>
							<div class="row">
								<div class="curriculum-event-wrap case-item-wrap portfolio-loop"
									 data-layout="packery" id="event-loop">
									<?php while ( have_posts() ) : the_post();
										get_template_part( 'parts/event/preview/item-style-' . Utouch::get_event( get_the_ID() )->preview_style );
									endwhile;
									?>
								</div>
							</div>
							<?php
						} elseif ( is_tax() && 'fw-portfolio-category' === $queried_object->taxonomy ) {

							?>
							<div class="row  case-item-wrap portfolio-loop" data-layout="packery" id="portfolio-loop">
								<?php while ( have_posts() ) : the_post();
									if ( 'full' !== $layout['position'] ) {
										echo '<div class="col-lg-12 col-md-12 col-sm-12">';
									}else{
										echo '<div class="col-lg-6 col-md-6 col-sm-12">';
									}
									get_template_part( 'parts/portfolio/loop', 'item' );
									echo '</div>';
								endwhile;
								?>
							</div>
							<?php
						} else {

							/* Start the Loop */
							while ( have_posts() ) : the_post();

								$format = get_post_format();
								if ( false === $format ) {
									$format = 'standard';
								}

								get_template_part( 'post-format/post', $format );

							endwhile;
						}


						utouch_paging_nav();

					else :

						get_template_part( 'parts/content', 'none' );

					endif; ?>

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
