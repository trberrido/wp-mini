<?php

// load global styles
add_action( 'enqueue_block_assets', 'wpmini__enqueue_styles' );

function wpmini__enqueue_styles() {

	$handle = 'wmini-style';
	$src = get_stylesheet_directory_uri() . '/assets/css/styles.css';
	$deps = array();
	$version = filemtime( get_stylesheet_directory() . '/assets/css/styles.css' );
	$media = 'all';

	wp_enqueue_style( $handle, $src, $deps, $version, $media );

}

// add block style variations
add_action( 'init', 'wpmini__register_block_styles' );

function wpmini__register_block_styles() {

	// block name: namespace / block name
	$block_name = 'core/paragraph';
	$style_properties = array(
		'name'	=> 'highlighted',
		'label' => 'Highlighted'
	);

	register_block_style( $block_name, $style_properties );

}

// load inline style for specific blocks
// beware: it won't be loaded if the block is not present in the page
add_action( 'init', 'wpmini__blocks__enqueue_styles' );

function wpmini__blocks__enqueue_styles() {

	// block name: namespace / block name
	$block_name = 'core/paragraph';
	$args = array(
		'handle'	=> 'wpmini-block-override--core--paragraph',
		'src'		=> get_stylesheet_directory_uri() . '/assets/css/core--paragraph.css',
		'path'		=> get_stylesheet_directory() . '/assets/css/core--paragraph.css',
		'ver'		=> filemtime( get_stylesheet_directory() . '/assets/css/core--paragraph.css' )
	);

	wp_enqueue_block_style( $block_name, $args );

}