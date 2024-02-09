# WP-mini

## Notes

### Useful functions

#### Styles:
- adding css files: `wp_enqueue_style()`
- associating css files with specific blocks, will be loaded as inline css: `wp_enqueue_block_style()`

About style priorities (without any `!important`):
block editor option > enqueued stylesheets > theme.json > default styles from WordPress

#### Scripts:
- adding js files: `wp_enqueue_script()`
- making some server side's datas accessible to the client: `wp_add_inline_script()`

#### Menu (classical) 
- to add a menu: `register_nav_menus()`
- to edit a menu: `add_filter( 'wp_nav_menu_objects', 'fn' )`
- to load a menu: `wp_nav_menu()`

#### Block
- register a block: `register_block_type()`
- add style variations to a block: `register_block_style()`
- rendering a block: `render_block()`
- get block attributes (classes, styles): `get_block_wrapper_attributes()`

#### Custom post type / custom tax
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

### Minimal required files for a new block theme

- theme.json
- templates/index.html
- style.css

#### optional folders
 - styles: can contain variations that will override the main theme.json.
 - parts: contains headers and footers

## References

- WP coding standards https://developer.wordpress.org/coding-standards/wordpress-coding-standards/
- WP handbooks / docs https://developer.wordpress.org/block-editor/getting-started/
- FSE introduction https://fullsiteediting.com/lessons/preparations-quick-start-guide/

## Design systems

- IBM carbon font https://carbondesignsystem.com/guidelines/typography/type-sets
- DSFR https://www.systeme-de-design.gouv.fr/