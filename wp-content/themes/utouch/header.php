<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Utouch
 */

// Options Variables

$dropdown_style = $color_scheme = $header_style = $custom_menu = $header_absolute = $header_animation = $sticky_atts = $sticky_pinned = $sticky_unpinned = '';
$header_class = array();
$header_class[] = 'header';
$page_id = get_the_ID();
$show_top_bar = 'hide';
$show_sticky_header = 'yes';
$header_animation = 'swing';
$decorative_line = 'show';

$dropdown_styles = array(
	'1' => '',
	'2' => 'header--menu-rounded',
	'3' => 'header--small-lines',
);
if ( function_exists( 'fw_get_db_customizer_option' ) ) {
	$show_top_bar       = fw_get_db_customizer_option( 'sections-top-bar/status', 'hide' );
	$show_sticky_header = fw_get_db_customizer_option( 'sticky_header/value', 'yes' );
	$header_animation   = fw_get_db_customizer_option( 'sticky_header/yes/style', 'swing' );
	$decorative_line    = fw_get_db_customizer_option( 'decorative-line', 'show' );
	$dropdown_animation = fw_get_db_customizer_option( 'dropdown-animation', 'drop-up' );
	$dropdown_style     = fw_get_db_customizer_option( 'dropdown-style/type', '1' );
	$header_text_color  = fw_get_db_customizer_option( 'header-text-color', '' );
}
if ( empty( $dropdown_animation ) ) {
	$dropdown_animation = 'drop-up';
}
if ( is_singular() && function_exists( 'fw_get_db_post_option' ) ) {
	// Header options
	$enable_customization = fw_get_db_post_option( $page_id, 'custom-header/enable', 'no' );
	if ( 'yes' === $enable_customization ) {
		$custom_header_opt = fw_get_db_post_option( $page_id, 'custom-header/yes', array() );
		$show_top_bar      = utouch_akg( 'sections-top-bar/status', $custom_header_opt, 'hide' );
		$decorative_line   = utouch_akg( 'decorative-line', $custom_header_opt, 'show' );
//		$color_scheme      = utouch_akg( 'color-scheme', $custom_header_opt, '' );
		$dropdown_style    = utouch_akg( 'dropdown-style/type', $custom_header_opt, '1' );
		$header_text_color = utouch_akg( 'header-text-color', $custom_header_opt, '' );

		Utouch::set_var( 'header_page_bg_color', utouch_akg( 'header_bg_color', $custom_header_opt, '' ) );
	}
}
if ( ! array_key_exists( $dropdown_style, $dropdown_styles ) ) {
	$dropdown_style = $dropdown_styles[1];
} else {
	$dropdown_style = $dropdown_styles[ $dropdown_style ];

}
if ( ! empty( $header_text_color ) ) {
	$header_class[] = 'header-color-inherit';
}

if ( ! empty( $color_scheme ) ) {
	$header_class[] = $color_scheme;
}
if ( ! empty( $dropdown_style ) ) {
	$header_class[] = $dropdown_style;
}
if ( $show_sticky_header === 'no' ) {
	$header_class[] = 'header-absolute';
	$header_class[] = 'disable-sticky';
} else {
	switch ( $header_animation ) {
		case 'swing':
			$sticky_pinned   = 'swingInX';
			$sticky_unpinned = 'swingOutX';
			break;
		case 'slide':
			$sticky_pinned   = 'slideDown';
			$sticky_unpinned = 'slideUp';
			break;
		case 'flip':
			$sticky_pinned   = 'flipInX';
			$sticky_unpinned = 'flipOutX';
			break;
		case 'bounce':
			$sticky_pinned   = 'bounceInDown';
			$sticky_unpinned = 'bounceOutUp';
			break;
		case 'none':
			$sticky_pinned   = '';
			$sticky_unpinned = '';
			break;
		default:
			$sticky_pinned   = 'swingInX';
			$sticky_unpinned = 'swingOutX';
	}
}

if ( 'show' === $show_top_bar ) {
	$header_class[] = 'header-top-bar';
	$header_class[] = 'header-has-topbar';
}
$menu_args = array(
	'menu'           => $custom_menu,
	'theme_location' => 'primary',
	'menu_id'        => 'primary-menu-menu',
	'menu_class'     => 'primary-menu-menu ',
	'container'      => 'ul',
	'fallback_cb'    => 'utouch_menu_fallback'
);

if ( class_exists( 'Utouch_Mega_Menu_Custom_Walker' ) ) {
	$menu_args['walker'] = new Utouch_Mega_Menu_Custom_Walker();
}
if ( 'header--dark' === $color_scheme ) {
	$menu_args['menu_class'] .= ' primary-menu--dark';
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'utouch' ); ?></a>


<?php

if ( 'landing-template.php' !== get_page_template_slug() ) { ?>
    <!-- Header -->
    <header class="<?php echo esc_attr( implode( ' ', $header_class ) ); ?>" id="site-header"
            data-pinned="<?php echo esc_attr( $sticky_pinned ) ?>"
            data-unpinned="<?php echo esc_attr( $sticky_unpinned ) ?>">

		<?php if ( 'show' === $show_top_bar ) {
			get_template_part( 'parts/section', 'topbar' );
		} ?>
		<?php if ( 'show' === $decorative_line ): ?>
            <div class="header-lines-decoration">
                <span class="bg-secondary-color"></span>
                <span class="bg-blue"></span>
                <span class="bg-blue-light"></span>
                <span class="bg-orange-light"></span>
                <span class="bg-red"></span>
                <span class="bg-green"></span>
                <span class="bg-secondary-color"></span>
            </div>
		<?php endif; ?>


        <div class="container">
			<?php if ( $show_top_bar ) { ?>
                <a href="#" id="top-bar-js" class="top-bar-link">
                    <svg class="utouch-icon utouch-icon-arrow-top">
                        <use xlink:href="#utouch-icon-arrow-top"></use>
                    </svg>
                </a>
			<?php } ?>

            <div class="header-content-wrapper">
                <div class="site-logo">
					<?php utouch_logo(); ?>
                </div>

                <nav id="primary-menu" class="primary-menu"
                     data-dropdown-animation="<?php echo esc_attr( $dropdown_animation ) ?>">

                    <!-- menu-icon-wrapper -->
                    <a href='javascript:void(0)' id="menu-icon-trigger" class="menu-icon-trigger showhide">
                        <span class="mob-menu--title"><?php esc_html_e( 'Menu', 'utouch' ); ?></span>
                        <span id="menu-icon-wrapper" class="menu-icon-wrapper">
                            <svg width="1000px" height="1000px">
                                <path id="pathD"
                                      d="M 300 400 L 700 400 C 900 400 900 750 600 850 A 400 400 0 0 1 200 200 L 800 800"></path>
                                <path id="pathE" d="M 300 500 L 700 500"></path>
                                <path id="pathF"
                                      d="M 700 600 L 300 600 C 100 600 100 200 400 150 A 400 380 0 1 1 200 800 L 800 200"></path>
                            </svg>
                        </span>
                    </a>

                    <!-- menu-icon-wrapper -->

					<?php wp_nav_menu( $menu_args ); ?>
					<?php utouch_additional_nav(); ?>
                </nav>

            </div>
        </div>
    </header>
	<?php
	if ( $header_absolute !== true ) {

		echo '<div id="header-spacer" class="header-spacer"></div>';
	} ?>

	<?php

	$search_color = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'search-icon/yes/color-scheme', 'search--white' ) : 'search--white';

	?>
    <div class="search-popup <?php echo esc_attr( $search_color ) ?>">
        <a href="#" class="popup-close js-popup-close cd-nav-trigger">
            <svg class="utouch-icon utouch-icon-cancel-1">
                <use xlink:href="#utouch-icon-cancel-1"></use>
            </svg>
        </a>

        <div class="search-full-screen">

            <div class="search-standard">
                <form id="search-header" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>"
                      class="search-inline" name="form-search-header">
                    <input class="search-input" name="s" value="<?php get_search_query(); ?>"
                           placeholder="<?php echo esc_html__( 'What are you looking for?', 'utouch' ) ?>"
                           autocomplete="off" type="search">
                    <button type="submit" class="form-icon">
                        <svg class="utouch-icon utouch-icon-search">
                            <use xlink:href="#utouch-icon-search"></use>
                        </svg>
                    </button>
                    <span class="close js-popup-clear-input form-icon">
							<svg class="utouch-icon utouch-icon-cancel-1"><use xlink:href="#utouch-icon-cancel-1"></use></svg>
						</span>
                </form>
            </div>

        </div>

    </div>

    <div class="cd-overlay-nav">
        <span></span>
    </div> <!-- cd-overlay-nav -->

    <div class="cd-overlay-content">
        <span></span>
    </div>
    <!-- ... End Header -->
<?php } ?>

<div class="content-wrapper">

	<?php if ( Utouch::template_stunning()->show && ! is_404() ) {
		get_template_part( 'parts/stunning/' . Utouch::template_stunning()->type );
	}
	?>
