// DOMContentLoaded event, so you don't have to worry about scripts loading strategies
// plus it limits the scope of this script
document.addEventListener( 'DOMContentLoaded', () => {

	// see	- wp_add_inline_script() in inc/scripts.php
	// 		- wpmini__ajax() in inc/ajax.php

	fetch( wpmini.adminURL + 'admin-ajax.php?action=serversaid' )
		.then( response => response.json() )
		.then( data => console.log( 'Server said: ', data ) );

} );