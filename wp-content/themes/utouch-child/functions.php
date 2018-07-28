<?php

/* -------------------------------------------------------
 Enqueue CSS from child theme style.css
-------------------------------------------------------- */


function crum_child_css() {
	wp_enqueue_style( 'child-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'crum_child_css', 99 );


wp_enqueue_script( 'script2', get_template_directory_uri() . '/js/custom.js', array ( 'jquery' ), 1.0, true);
/* -------------------------------------------------------
 You can add your custom functions below
-------------------------------------------------------- */

wp_enqueue_style( 'timeline', get_template_directory_uri() . '/css/timeline.css',false,'1.1','all');
