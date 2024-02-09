<?php

add_action('wp_enqueue_scripts', 'wpmini__enqueue_scripts');

function wpmini__enqueue_scripts() {

	$handle = 'wpmini-script';
	$src = get_stylesheet_directory_uri() . '/assets/js/script.js';
	$deps = array();
	$version = filemtime( get_stylesheet_directory() . '/assets/js/script.js' );
	$args = true;

	$data = array(
		'emvType'	=> wp_get_environment_type(),
		'adminURL'	=> esc_url( admin_url( '/' ) )
	);
	$data_inline = 'const wpmini = ' . wp_json_encode( $data );

	wp_enqueue_script( $handle, $src, $deps, $version, $args );

	wp_add_inline_script( $handle, $data_inline );

};