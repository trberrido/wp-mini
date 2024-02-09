<?php defined('ABSPATH') or die();

// Load all the required php files
add_action( 'after_setup_theme', 'dw__get_inc_files' );
function dw__get_inc_files() {
	foreach ( glob( get_stylesheet_directory() . '/inc/*.php' ) as $file ) {
		include_once $file;
	}
}