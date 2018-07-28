<?php
/**
 * Template Name: Blog
 */
get_header();

$the_query = utouch_custom_loop( 'post' );

$page_title         = '' !== get_the_excerpt() ? get_the_excerpt() : get_the_title();
$layout             = utouch_sidebar_conf();

$options = Utouch::options();
$sort_panel         = $options->get_option('sorting_panel/value', 'yes',Utouch_Options::SOURCE_POST);
$sort_type          =$options->get_option('sorting_panel/yes/action', 'sort',Utouch_Options::SOURCE_POST);
$pagination         = $options->get_option('pagination_type', false,Utouch_Options::SOURCE_POST);
$sort_wrapper_class = 'sort' == $sort_type ? 'sorting-menu' : '';

?>
	<div id="primary" class="container">
		<div class="row">
			<div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
				<main id="main" class="site-main">
					<div id="page-content" class="ovh">
						<?php while ( have_posts() ) : the_post();
							the_content();
						endwhile; ?>
					</div>
					<?php if ( $the_query->have_posts() ) { ?>
						<?php if ( ! empty( $categories ) && 'no' !== $sort_panel ) : ?>
							<ul class="cat-list align-center <?php echo esc_attr( $sort_wrapper_class ) ?>">
								<?php if ( 'sort' === $sort_type ) { ?>
									<li class="cat-list__item active" data-filter="*"><a href="#"
																						 class=""><?php esc_html_e( 'All Projects', 'utouch' ); ?></a>
									</li>
									<?php foreach ( $categories as $category ) : ?>
										<li class="cat-list__item"
											data-filter=".category_<?php echo esc_attr( $category->term_id ) ?>"><a
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
						<div id="blog-loop">
							<?php while ( $the_query->have_posts() ) : $the_query->the_post();
								$format = get_post_format();
								if ( false === $format ) {
									$format = 'standard';
								}
								get_template_part( 'post-format/post', $format );
							endwhile;
							wp_reset_postdata();
							?>
						</div>

						<?php if ( 'loadmore' === $pagination ) {
							utouch_ajax_loadmore( $the_query, $container_id = 'blog-loop' );
						} elseif ( 'numbers' === $pagination ) {
							utouch_paging_nav( $the_query );
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

<?php


get_footer();