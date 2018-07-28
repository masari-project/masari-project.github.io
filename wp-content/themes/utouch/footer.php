<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Utouch
 */


$copyright_class = $footer_contacts = $description_enable = $description_title = $description_text = $description_columns = $description_class = $description_socials = $footer_fixed = $footer_text = '';

global $allowedtags;
global $allowedposttags;
$my_theme = wp_get_theme();

$show_to_top      = 'yes';
$fixed_totop      = false;
$show_search      = 'yes';
$show_subscribe   = 'no';
$search_style     = 'fullscreen';
$footer_copyright = '<span>Copyright &copy; 2017 <a href="' . esc_html( $my_theme->get( 'AuthorURI' ) ) . '" class="sub-footer__link">Utouch by Crumina</a></span>
                    <span>Site is built on WordPress <a href="https://wordpress.org" class="sub-footer__link">WordPress</a></span>';

if ( function_exists( 'fw_get_db_customizer_option' ) ) {
	$show_search  = fw_get_db_customizer_option( 'search-icon/value', 'yes' );
	$search_style = fw_get_db_customizer_option( 'search-icon/yes/style', 'fullscreen' );

	$show_subscribe = fw_get_db_customizer_option( 'show_subscribe_section', 'yes' );

	$footer_fixed = fw_get_db_customizer_option( 'footer_fixed', false );
	$footer_text  = fw_get_db_customizer_option( 'footer_text_color', '' );
	$footer_title = fw_get_db_customizer_option( 'footer_title_color', '' );

	$site_description    = fw_get_db_customizer_option( 'site-description', '' );
	$description_enable  = utouch_akg( 'value', $site_description, 'no' );
	$description_title   = utouch_akg( 'yes/description/title', $site_description, '' );
	$description_text    = utouch_akg( 'yes/description/desc', $site_description, '' );
	$description_columns = utouch_akg( 'yes/width-columns', $site_description, '7' );
	$description_class   = utouch_akg( 'yes/class', $site_description, '' );
	$description_socials = utouch_akg( 'yes/social-networks', $site_description, array() );

	$footer_contacts  = fw_get_db_customizer_option( 'footer_contacts', '' );
	$footer_copyright = fw_get_db_customizer_option( 'footer_copyright', '' );
	$copyright_class  = fw_get_db_customizer_option( 'size_copyright_section', 'large' );

	$copyright_text = fw_get_db_customizer_option( 'copyright_text_color', '' );

	$scroll_option = fw_get_db_customizer_option( 'scroll_top_icon', array() );
	$show_to_top   = utouch_akg( 'value', $scroll_option, 'yes' );
	$fixed_totop   = utouch_akg( 'yes/fixed', $scroll_option, false );

}
$footer_class = true === $footer_fixed ? 'js-fixed-footer' : '';
if ( ! empty( $footer_text ) || ! empty( $footer_title ) ) {
	$footer_class .= ' font-color-custom';
}
if ( ! empty( $copyright_text ) ) {
	$copyright_class .= ' font-color-custom';
}

$scroll_button_class = true === $fixed_totop ? 'back-to-top-fixed' : '';
$desc_columns_class  = 'col-lg-' . $description_columns . ' col-md-' . $description_columns . ' col-sm-12 col-xs-12';

if ( 'yes' === $description_enable ) {
	$column = intval( 11 - $description_columns );
	$offset = '1';
	if ( $column < 2 ) {
		$column = 12;
		$offset = '0';
	}
	$sidebar_columns = 'col-lg-offset-' . $offset . ' col-lg-' . $column . ' col-md-' . ( $column + 1 ) . ' col-sm-12 col-xs-12';
} else {
	$sidebar_columns = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 row info';
}


if ( ( 'yes' !== $description_enable || ( empty( $description_title ) && empty( $description_text ) ) ) && ! is_active_sidebar( 'sidebar-footer' ) ) {
	$footer_class .= ' footer-empty ';
}
?>



<?php if ( 'yes' === $show_subscribe ) {
	//get_template_part( 'parts/subscribe', 'section' );
} ?>
</div><!-- ! .content-wrapper Close -->
<!-- Footer -->

<?php if ( 'landing-template.php' !== get_page_template_slug() ) { ?>

<footer class="footer  <?php echo esc_attr( $footer_class ) ?>" id="site-footer">
	<div class="header-lines-decoration">
		<span class="bg-secondary-color"></span>
		<span class="bg-blue"></span>
		<span class="bg-blue-light"></span>
		<span class="bg-orange-light"></span>
		<span class="bg-red"></span>
		<span class="bg-green"></span>
		<span class="bg-secondary-color"></span>
	</div>

	<div class="container">
		<div class="row">
			<?php if ( 'yes' === $description_enable &&
			           ( ! empty( $description_title ) || ! empty( $description_text ) ) ||
			           ( ! empty( $description_socials ) && is_array( $description_socials ) )
			) { ?>
				<div class="<?php echo esc_attr( $desc_columns_class ) ?>">
					<?php if ( ! empty( $description_title ) || ! empty( $description_text ) ) { ?>
						<div class="widget w-info">
							<?php if ( ! empty( $description_title ) ) { ?>
								<h5 class="widget-title"><?php echo esc_html( $description_title ) ?></h5>
								<div class="heading-line">
									<span class="short-line"></span>
									<span class="long-line"></span>
								</div>
							<?php }
							if ( ! empty( $description_text ) ) {

								?>
								<div class="heading-text">
									<?php echo( $description_text ) ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>

			<?php } ?>

			<?php
			if ( is_active_sidebar( 'sidebar-footer' ) ) {
				?>
				<div class="<?php echo esc_attr( $sidebar_columns ); ?>">
					<div class="row">
						<?php
						ob_start();
						dynamic_sidebar( 'sidebar-footer' );
						$output                 = ob_get_clean();
						$footer_sibebar_columns = utouch_get_widget_columns( 'sidebar-footer' );
						$footer_sibebar_columns = 'col-lg-' . $footer_sibebar_columns . ' col-md-' . $footer_sibebar_columns . ' col-sm-12 col-xs-12';
						echo str_replace( 'columns_class_replace', $footer_sibebar_columns, $output );
						?>
					</div>
				</div>
			<?php } ?>
		</div>

	</div>

	<div class="sub-footer">
		<?php if ( 'yes' === $show_to_top ) { ?>

			<a class="back-to-top <?php echo esc_attr( $scroll_button_class ); ?>" href="#">
				<svg class="utouch-icon utouch-icon-arrow-top">
					<use xlink:href="#utouch-icon-arrow-top"></use>
				</svg>
			</a>
		<?php } ?>

		<?php if ( ! empty( $footer_copyright ) ) { ?>

			<div class="container  <?php echo esc_attr( $copyright_class ) ?>">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                		<span class="site-copyright-text">
							<?php echo wp_kses( $footer_copyright, $allowedtags ) ?>
						</span>
					</div>
				</div>
			</div>
		<?php } ?>

	</div>

</footer>
<!-- End Footer -->
<?php } ?>

<!-- Contact Form popup -->
<?php get_template_part('parts/contact','form') ?>

<!-- SVG ICON SPRITE -->
<?php get_template_part( 'svg/icons.svg' ); ?>
<?php wp_footer(); ?>


</body>
</html>
