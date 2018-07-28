<?php
/**
 * The template for displaying easy digital downloads products Category.
 */
get_header();
$layout = utouch_sidebar_conf();
set_query_var( 'page_layout', $layout['position'] );
?>
    <!-- Case Item -->
    <div id="primary" class="container">
        <div class="row medium-padding30">
            <div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
                <main id="main" class="site-main" >
                    <div class="row" id="downloads-loop">
	                    <?php if ( have_posts() ) : ?>

                            <div class="row" id="downloads-loop">

			                    <?php while ( have_posts() ) : the_post();

				                    get_template_part( 'parts/downloads', 'item' );

			                    endwhile; ?>

                            </div>

		                    <?php utouch_paging_nav();

	                    else :

		                    get_template_part( 'parts/content', 'none' );

	                    endif; ?>
                    </div>
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