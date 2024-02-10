# WP-mini

## Key concepts

### The query loop
One of the main way to display a list of posts if the `get_posts()` functions.

- It returns an array of posts.
- It takes an array as parameter. This array is the same used for WP_Query, see all available options: https://developer.wordpress.org/reference/classes/wp_query/#parameters

One interesting option is filtering on ACF's field, see:
- https://developer.wordpress.org/reference/classes/wp_query/#custom-field-post-meta-parameters
- https://www.advancedcustomfields.com/resources/query-posts-custom-fields/


A basic example to retrieve a list of post of a specific custom post type:

```

$args = array(
	'post_type'		=> 'a_custom_post_type'
);

$posts = get_posts( $args );

foreach ( $posts as $post ){
	echo get_the_title( $post->ID );
}
```

More about *the loop*: https://developer.wordpress.org/themes/basics/the-loop/

### Hooks
The construction process of a response by WordPress is a pipeline of steps.
The developper can insert code at any of these step, by adding a callback function to a `hook`. Calling hooks is the way to add features to WordPress.

#### Actions
Action hooks enable to edit the way WordPress works.

Typically, one will call the `enqueue_block_assets` hook to add its own stylesheets.
```
add_action( 'enqueue_block_assets', function() { wp_enqueue_style( ... ); });
```

#### filters
Filters hooks enable to edit *the data* WordPress is working on.

For eg, one can add specific data on each items of a menu list through the `wp_nav_menu_objects` 
```
// notes:
// - the 3rd parameter indicates the priority of the callback
//	for when there's several callbacks attached to a same hook
// - the 4th parameter is the number of arguments the callback can expect to receive

add_filter( 'wp_nav_menu_objects', 'wpmini__menu__add_smileys', 10, 2 );

function wpmini__menu__add_smiley( $items, $args ) {
	foreach( $items as $item ){
		$item->title = ':D ' . $item->title;
	}
	return $items;
}
```

See: https://developer.wordpress.org/plugins/hooks/

## Useful functions

### Styles:
- adding css files: `wp_enqueue_style()`
- associating css files with specific blocks, will be loaded as inline css: `wp_enqueue_block_style()`

About style priorities (without any `!important`):
block editor option > enqueued stylesheets > theme.json > default styles from WordPress

### Scripts:
- adding js files: `wp_enqueue_script()`
- making some server side's datas accessible to the client: `wp_add_inline_script()`

### Menu (classical) 
- to add a menu: `register_nav_menus()`
- to edit a menu: `add_filter( 'wp_nav_menu_objects', 'fn' )`
- to load a menu: `wp_nav_menu()`

### Block
- register a block: `register_block_type()`
- add style variations to a block: `register_block_style()`
- rendering a block: `render_block()`
- get block attributes (classes, styles): `get_block_wrapper_attributes()`

### Custom post type / custom tax
- `register_taxonomy()`
- `register_post_type()`

To clearly separate types of content
https://developer.wordpress.org/reference/functions/register_post_type/

### Patterns
It is possible to export / import your own pattern https://learn.wordpress.org/tutorial/creating-your-own-custom-synced-or-non-synced-patterns/

### Ajax

Server side:

```
add_action( 'wp_ajax_{action_name}', 'fn' );
// if the ajax call has to be accessible to loggued-out users:
add_action( 'wp_ajax_nopriv_{action_name}', 'fn' );
```

Client side:

```
fetch(
	wpmini.adminURL + '/admin-ajax.php?action={action_name}'
).then( blablabla )
```

### Environment types

In /wp-config.php :
```
define( 'WP_DEVELOPMENT_MODE', 'production' );
```

Enable different behaviors with :
```
wp_get_environment_type():string
```
see more: https://developer.wordpress.org/reference/functions/wp_get_environment_type/

## Minimal required files for a new block theme
- theme.json
- templates/index.html
- style.css

### optional folders
 - styles: can contain variations that will override the main theme.json.
 - parts: contains headers and footers

## References

### Wordpress
- WP coding standards: https://developer.wordpress.org/coding-standards/wordpress-coding-standards/
- WP handbooks / docs: https://developer.wordpress.org/block-editor/getting-started/
- FSE introduction: https://fullsiteediting.com/lessons/preparations-quick-start-guide/

### Misc
- BEM: css classes naming methodology: https://getbem.com/
- IBM carbon font https://carbondesignsystem.com/guidelines/typography/type-sets
- DSFR https://www.systeme-de-design.gouv.fr/