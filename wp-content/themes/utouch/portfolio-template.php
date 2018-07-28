<?php
/**
 * Template Name: Portfolio
 */
get_header();
$the_query              = utouch_custom_loop( 'fw-portfolio' );
$ext_portfolio_instance = fw()->extensions->get( 'portfolio' );
$ext_portfolio_settings = $ext_portfolio_instance->get_settings();

$taxonomy   = $ext_portfolio_settings['taxonomy_name'];
$term       = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );
$term_id    = ( ! empty( $term->term_id ) ) ? $term->term_id : 0;
$categories = fw_ext_portfolio_get_listing_categories( $term_id );

$listing_classes = fw_ext_portfolio_get_sort_classes( $the_query->posts, $categories );
$loop_data       = array(
	'settings'        => $ext_portfolio_instance->get_settings(),
	'categories'      => $categories,
	'listing_classes' => $listing_classes
);
set_query_var( 'fw_portfolio_loop_data', $loop_data );

$page_title = '' !== get_the_excerpt() ? get_the_excerpt() : get_the_title();
$layout     = utouch_sidebar_conf();
$sort_panel = fw_get_db_post_option( get_the_ID(), 'sorting_panel/value', 'yes' );
$sort_type  = fw_get_db_post_option( get_the_ID(), 'sorting_panel/yes/action', 'sort' );
$pagination = fw_get_db_post_option( get_the_ID(), 'pagination_type', false );
$read_more = fw_get_db_post_option( get_the_ID(), 'more_text', esc_html__( 'View Case', 'utouch' ) );

set_query_var('read-more-text',$read_more);

$sort_wrapper_class = 'sort' == $sort_type ? 'sorting-menu' : '';

if ( 'full' !== $layout['position'] ) {
	Utouch::set_var( 'utouch_sidebar_enabled', true );
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
						<?php if ( ! empty( $categories ) && 'no' !== $sort_panel ) : ?>
							<ul class="cat-list-bg-style align-center <?php echo esc_attr( $sort_wrapper_class ) ?>">
								<?php if ( 'sort' === $sort_type ) { ?>
									<li class="cat-list__item active" data-filter="*"><a href="#"
																						 class=""><?php esc_html_e( 'All Projects', 'utouch' ); ?></a>
									</li>
									<?php foreach ( $categories as $category ) : ?>
										<li class="cat-list__item"
											data-filter=".<?php echo esc_attr( $category->slug ) ?>"><a
													href="#" class=""><?php echo esc_html( $category->name ); ?></a>
										</li>
									<?php endforeach; ?>
								<?php } else {

									$terms = get_terms( $taxonomy, array( 'hide_empty' => true ) );
									foreach ( $terms as $term ) : ?>
										<?php $active = ( $term->term_id == $term_id ) ? 'active' : ''; ?>
										<li class="cat-list__item <?php echo esc_attr( $active ) ?>"><a
													href="<?php echo esc_url( get_term_link( $term->slug, $taxonomy ) ) ?>"><?php echo esc_html( $term->name ); ?></a>
										</li>
									<?php endforeach; ?>
								<?php } ?>
							</ul>
						<?php endif; ?>
						<div class="row  case-item-wrap portfolio-loop  sorting-container" data-layout="packery"
							 id="portfolio-loop">
							<?php while ( $the_query->have_posts() ) : $the_query->the_post();

								$terms = get_terms( array(
									'taxonomy'   => $taxonomy,
									'object_ids' => get_the_ID(),
									'hide_empty' => true
								) );
								if ( ! is_array( $terms ) ) {
									$terms = array();
								}

								$sorting_item = 'sorting-item';

								foreach ( $terms as $term ) {
									$sorting_item .= ' ' . $term->slug;
								}
								if ( 'full' !== $layout['position'] ) {
									echo '<div class="col-lg-12 col-md-12 col-sm-12 ' . $sorting_item . '">';
								} else {
									echo '<div class="col-lg-6 col-md-6 col-sm-12 ' . $sorting_item . '">';
								}
								get_template_part( 'parts/portfolio/loop', 'item' );
								echo '</div>';
							endwhile;
							?>
						</div>

						<?php if ( 'loadmore' === $pagination ) {
							utouch_ajax_loadmore( $the_query, $container_id = 'portfolio-loop' );
						} elseif ( 'numbers' === $pagination ) {
							utouch_paging_nav( $the_query, 'align-center' );
						} elseif ( 'prev_next' === $pagination ) {
							utouch_prev_next_nav( $the_query );

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
unset( $ext_portfolio_instance );
unset( $ext_portfolio_settings );
set_query_var( 'fw_portfolio_loop_data', '' );

get_footer();