<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Utouch
 */

global $allowedtags;

$logo_image_style = '';
$logo_image    = '';
$logo_retina   = false;
$logo_title    = get_bloginfo( 'name' );
$logo_subtitle = get_bloginfo( 'description' );
$my_theme = wp_get_theme();

if ( function_exists( 'fw_get_db_customizer_option' ) ) {
	$logo_image    = fw_get_db_customizer_option( 'logo-image/url' );
	$logo_retina   = fw_get_db_customizer_option( 'logo-retina' );
	$logo_title    = fw_get_db_customizer_option( 'logo-title', $logo_title );
	$logo_subtitle = fw_get_db_customizer_option( 'logo-subtitle', $logo_subtitle );
}
if ( true === $logo_retina && ! empty( $logo_image ) ) {
	$logo_id    = fw_get_db_customizer_option( 'logo-image/attachment_id' );
	$image_atts = wp_get_attachment_metadata( $logo_id );

	$logo_image_style = 'style="width:' . intval( $image_atts['width'] / 2 ) . 'px; height:' . intval( $image_atts['height'] / 2 ) . 'px;"';
}
$footer_copyright = '<span>Copyright &copy; 2017 <a href="' . esc_html( $my_theme->get( 'AuthorURI' ) ) . '" class="sub-footer__link">Utouch by Crumina</a></span>
                    <span>Site is built on WordPress <a href="https://wordpress.org" class="sub-footer__link">WordPress</a></span>';

if ( function_exists( 'fw_get_db_customizer_option' ) ) {
	$footer_copyright = fw_get_db_customizer_option( 'footer_copyright', $footer_copyright );
}

do_action('get_header');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>


	<section class="page404">
		<div class="site-logo logo--center">
			<a href="<?php echo esc_url( home_url( '' ) )?>" class="full-block"></a>
			<?php
			if ( ! empty( $logo_image ) ) {
				echo '<img src="' . esc_html( $logo_image ) . '" alt="' . get_bloginfo( 'name' ) . '" ' . $logo_image_style . '/>';
			}
			?>
			<div class="logo-text">
				<div class="logo-title"><?php echo esc_html( $logo_title )?></div>
				<div class="logo-sub-title"><?php echo esc_html( $logo_subtitle )?></div>
			</div>
		</div>


		<div class="page404-content">
			<h2 class="error"><?php echo esc_html__( 'Error', 'utouch' ); ?></h2>
			<h2 class="number">404</h2>
			<h2 class="title"><?php echo esc_html__( 'Sorry! The Page Not Found.', 'utouch' ); ?></h2>
			<h5 class="sub-title"><?php echo esc_html__( 'We can\'t find the page you are looking for. Please go to', 'utouch' ); ?>
				<a
					href="<?php echo esc_url( site_url() ) ?>"><?php echo esc_html__( 'Homepage', 'utouch' ) ?>
				</a>.
			</h5>

		</div>
		<?php if ( ! empty( $footer_copyright ) ) { ?>
			<div class="sub-footer c-white">
				<?php echo wp_kses( $footer_copyright, $allowedtags ) ?>
			</div>
		<?php } ?>

	</section>
	<?php get_template_part( 'svg/icons.svg' ); ?>
	<?php wp_footer(); ?>
</body>
</html>
