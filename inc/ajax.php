<?php

// anwer to fetch() called in assets/js/script.js

add_action( 'wp_ajax_serversaid', 'wpmini__ajax' );
add_action( 'wp_ajax_nopriv_serversaid', 'wpmini__ajax' );

function wpmini__ajax() {

	$response = 'Bravo tu possèdes une compétence que les ordinateurs ont rendu obsolète.';
	wp_send_json( $response );

	// note: always exit() after sending the response
	exit();

}