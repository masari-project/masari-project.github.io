<?php
/**
 * Template Name: Event
 */

get_header();
$the_query = utouch_custom_loop( 'fw-event' );


$page_title = '' !== get_the_excerpt() ? get_the_excerpt() : get_the_title();
$layout     = utouch_sidebar_conf();
$sort_panel = fw_get_db_post_option( get_the_ID(), 'sorting_panel/value', 'yes' );
$sort_type  = fw_get_db_post_option( get_the_ID(), 'sorting_panel/yes/action', 'sort' );
$pagination = fw_get_db_post_option( get_the_ID(), 'pagination_type', false );

$sort_wrapper_class = 'sort' == $sort_type ? 'sorting-menu' : '';

$categories = get_terms( 'fw-event-taxonomy-name' );

if('full' !== $layout['position']){
	Utouch::set_var('utouch_sidebar_enabled',true);
}
?>
	<!-- Case Item -->
	<div id="primary" class="container">
		<div class="row medium-padding30">
			<div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
				<main id="main" class="site-main">
					<div id="page-content" class="ovh">
						<?php while ( have_posts() ) : the_post();
							the_content();
						endwhile; ?>
					</div>
					<?php if ( $the_query->have_posts() ) { ?>
						<div class="row">
							<div class="curriculum-event-wrap case-item-wrap portfolio-loop"
								 data-layout="packery" id="event-loop">
								<?php while ( $the_query->have_posts() ) : $the_query->the_post();
									get_template_part( 'parts/event/preview/item-style-'. Utouch::get_event( get_the_ID() )->preview_style );
								endwhile;
								?>
							</div>
						</div>

						<?php if ( 'loadmore' === $pagination ) {
							utouch_ajax_loadmore( $the_query, 'event-loop' );
						} elseif('numbers' === $pagination) {
							utouch_paging_nav( $the_query,'align-center' );
						}elseif('prev_next' === $pagination){
							utouch_prev_next_nav($the_query);

						} ?>
					<?php } ?>
				</main><!-- #main -->
			</div>
			<?php if ( 'full' !== $layout['position'] ) { ?>
				<div class="<?php echo esc_attr( $layout['sidebar-classes'] ) ?>">
					<?php get_sidebar(); ?>
				</div>
			<?php } ?>
		</div><!-- #row -->
	</div><!-- #primary -->
	<!-- End Case Item -->
<?php
get_footer();