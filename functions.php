<?php

// Load all the required php files
function wpmini__get_inc_files(){
	foreach ( glob( get_template_directory() . '/inc/*.php' ) as $file )
		include $file;
}

add_action( 'after_setup_theme', 'wpmini__get_inc_files' );