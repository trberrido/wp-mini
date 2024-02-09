<?php

// loading blocks
add_action( 'init', 'wpmini__register_blocks', 5 );

function wpmini__register_blocks() {

	register_block_type( get_stylesheet_directory() . '/blocks/demo-wrapper' );

	// To associate a script with,
	// we use the $handle set in the block.json { script } attribute
	$handle = 'wp-mini--demo-wrapper';
	wp_register_script( $handle, get_stylesheet_directory_uri() . '/blocks/demo-wrapper/script.js' );

}