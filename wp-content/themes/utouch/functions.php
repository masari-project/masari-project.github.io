<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
require_once get_template_directory() . '/inc/init.php';


require get_template_directory() . '/inc/classes/utouch-class-autoload.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


function utouch_admin_customizations() {
	// Load admin panel customizations
	wp_enqueue_style(
		'utouch-admin-custom',
		get_template_directory_uri() . '/css/admin.css',
		array(),
		'1.0'
	);
	wp_enqueue_script(
		'utouch-admin-scripts',
		get_template_directory_uri() . '/js/admin-scripts.js',
		array( 'jquery' ),
		'1.0'
	);
}

add_action( 'admin_enqueue_scripts', 'utouch_admin_customizations' );

function utouch_yoast_kc_compitablity() {
	$active = false;
	if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
		$active = true;
	} elseif ( defined( 'WPSEO_VERSION' ) ) {
		$active = true;
	}
	if ( true === $active ) {
		global $pagenow, $typenow;
		if ( empty( $typenow ) && ! empty( $_GET['post'] ) ) {
			$post    = get_post( $_GET['post'] );
			$typenow = $post->post_type;
		}
		if ( ( $pagenow == 'post.php' && $typenow == 'page' ) || ( $pagenow == 'post-new.php' && $typenow == 'page' ) ) {
			wp_enqueue_script( 'crum-yoast-seo', get_template_directory_uri() . '/js/king-yoast.js', array( 'jquery' ), '', true );
		}
	}
}


add_action( 'admin_enqueue_scripts', 'utouch_yoast_kc_compitablity' );