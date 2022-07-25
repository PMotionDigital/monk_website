<?php
add_action('acf/init', 'my_acf_block_white');
function my_acf_block_white()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'white_block',
            'title'             => __('Белый фон'),
            'description'       => __('Белый фон'),
            'render_callback'   => 'render_white_block',
            'category'          => 'custom-blocks',
            'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                'mode' => true,
                'jsx' => true
            ),
            'example'          => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'is_preview'    => true
                    )
                )
            )
        ));
    }
}

function render_white_block($block)
{
    // Create id attribute allowing for custom "anchor" value.
    $id = $block['id'];
    

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'guten-customblock-' . $block['id'];
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }

?>
    <div id="<?php echo esc_html($id); ?>" class="block-white-layout <?php echo esc_html($className); ?>">
        <InnerBlocks/>
    </div>

<?php
}
?>