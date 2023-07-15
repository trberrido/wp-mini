<?php

function wpmini__concatene_files( $sources, $destination ) {

	$content = '/*
 * !!! It is useless to edit this file,
 * as it\'s the result of a concatenation process.
 * You need to be in developpement mode in order to edit any the source files.
 */';
	$destination_filename = substr( strrchr( $destination, '/' ), 1 );

	foreach ( glob( $sources ) as $source ){

		$filename = substr( strrchr( $source, '/' ), 1 );

		if ( strcmp( $filename, $destination_filename ) != 0 ){
			$content .= "\r\n\r\n/* $filename */\r\n\r\n";
			$content .= file_get_contents( $source );
		}

	}

	return file_put_contents( $destination, $content );

}

// Enqueuing scripts
add_action('wp_enqueue_scripts', 'wpmini__enqueue_scripts');

function wpmini__enqueue_scripts() {

	$data = array(
		'siteURL' => site_url()
	);
	$data_inline = 'const wpminiData = ' . json_encode( $data );
	$production_script_filename = 'production-script.js';

	if ( strcmp( wp_get_environment_type(), 'staging' ) == 0 || strcmp( wp_get_environment_type(), 'production' ) == 0 ){

		$handle = 'wpmini-' . $production_script_filename;
		wp_enqueue_script(
			$handle,
			get_template_directory_uri() . '/assets/' . $production_script_filename,
			array(),
			filemtime( get_template_directory() . '/assets/' . $production_script_filename ),
			true
		);
		wp_add_inline_script( $handle, $data_inline );

	} else {

		wpmini__concatene_files( get_template_directory() . '/assets/js/*.js', get_template_directory() . '/assets/' . $production_script_filename );

		$handle = false;
		foreach ( glob( get_template_directory() . '/assets/js/*.js' ) as $file){

			$filename = substr( strrchr( $file, '/' ), 1 );
			$handle = 'wpmini-' . $filename;

			wp_enqueue_script( $handle, get_template_directory_uri() . '/assets/js/' . $filename, array(), false, true );

		}

		if ( $handle ){
			wp_add_inline_script( $handle, $data_inline );
		}

	}

}

// Enqueuing styles
// Front && editor sides
add_action( 'enqueue_block_assets', 'wpmini__enqueue_styles' );

// Editor only
// add_action( 'enqueue_block_editor_assets', 'wpmini__fn' );

function wpmini__enqueue_styles() {

	$production_style_filename = 'production-style.css';

	if ( strcmp( wp_get_environment_type(), 'staging' ) == 0 || strcmp( wp_get_environment_type(), 'production' ) == 0 ){

		wp_enqueue_style(
			'wpmini-' . $production_style_filename,
			get_template_directory_uri() . '/assets/' . $production_style_filename,
			array(),
			filemtime( get_template_directory() . '/assets/' . $production_style_filename )
		);

	} else {

		wpmini__concatene_files( get_template_directory() . '/assets/css/*.css', get_template_directory() . '/assets/' . $production_style_filename );

		foreach ( glob( get_template_directory() . '/assets/css/*.css' ) as $file){

			$filename = substr( strrchr( $file, '/' ), 1 );
			wp_enqueue_style( 'wpmini-' . $filename, get_template_directory_uri() . '/assets/css/' . $filename, array(), false );

		}

	}

}