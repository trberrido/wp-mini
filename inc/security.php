<?php

// prevent /users enumeration from REST API
add_filter( 'rest_endpoints', 'wpmini__remove_users_endpoints' );
function wpmini__remove_users_endpoints( $endpoints ) {

	if ( isset( $endpoints['/wp/v2/users'] ) ) {
		unset( $endpoints['/wp/v2/users'] );
	}

	if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
		unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
	}

	return $endpoints;

}