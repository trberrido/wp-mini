<?php

/*
 * print an undefined list of arguments
 *
 * @param mixed $fn_argv
 * @return void
 *
 */
function console() {

	$fn_argv = func_get_args();

	echo '<pre style="position: static; max-width: 50rem; z-index: 999; background-color:#ececec; color: black; padding: 1rem; border: 1px solid #666666; font-size: .8rem; border-radius: .5rem;">';
	foreach ( $fn_argv as $fn_arg ) {
		var_dump( $fn_arg );
		echo '-----------<br>';
	}
	echo '</pre>';

}

/*
 * this filter is usefull to know what data are required by a block
 */

//add_filter( 'render_block', 'block__dissect', 10, 2 );
function block__dissect( $block_content, $block ) {

	if ( 'core/cover' === $block['blockName'] ) {
		console( $block );
	}

	return $block_content;

}