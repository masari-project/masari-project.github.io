<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Utouch
 */

?>

<aside aria-label="sidebar" class="sidebar">
	<?php
	if ( function_exists( 'fw_ext_sidebars_get_current_position' ) && function_exists( 'fw_ext_sidebars_show' ) ) {
		$current_position = fw_ext_sidebars_get_current_position();

		if ( $current_position === 'left' ) {
			echo fw_ext_sidebars_show( 'blue' );
		} elseif ( $current_position === 'right' ) {
			echo fw_ext_sidebars_show( 'blue' );
		} else {
			dynamic_sidebar( 'sidebar-main' );
		}
	} else {
		dynamic_sidebar( 'sidebar-main' );
	} ?>
</aside>

