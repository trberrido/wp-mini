<?php


// NB: in block.json:
// { acf.jsx: true } enable the use of <InnerBlocks />

// NB; a block has some interesting variables:
// $block, $content, $is_preview, $post_id
// https://www.advancedcustomfields.com/resources/acf_register_block_type/

if ( function_exists( 'get_field' ) ) :

	$acf_field_content = get_field( 'wpmini__demo__block_wrapper' );

	$default_template = array(
		array( 'core/paragraph', array( 'content' => 'WordPress block paragraph with some default content' ) ),
	);

	if ( $is_preview || $acf_field_content ) : ?>

		<div <?php echo get_block_wrapper_attributes(); ?>>

			<p class="wp-block-wpmini-demo-wrapper__acf-content">
				POST ID : (<?php echo $post_id; ?>)<br>
				<?php echo $acf_field_content; ?>
			</p>

			<InnerBlocks template="<?php echo esc_attr( wp_json_encode( $default_template ) ); ?>" />

		</div>

	<?php endif; ?>

<?php endif; ?>
