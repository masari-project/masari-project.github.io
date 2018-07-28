<?php
/**
 * Template for displaying search forms in utouch
 *
 * @package utouch
 */
?>
<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="w-search">
	<div class="with-icon">
		<input name="s"  id="search-widget-input" placeholder="<?php echo esc_attr__( 'Search', 'utouch' ); ?>"  value="<?php echo get_search_query(); ?>" type="search">
		<svg class="utouch-icon utouch-icon-search"><use xlink:href="#utouch-icon-search"></use></svg>
	</div>
</form>
