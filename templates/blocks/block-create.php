<?php
add_action('acf/init', 'my_acf_block_create');
function my_acf_block_create()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'Create block',
            'title'             => __('Создаем и продвигаем'),
            'description'       => __('Создаем и продвигаем'),
            'render_callback'   => 'render_create_block',
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

function render_create_block($block)
{
    // Create id attribute allowing for custom "anchor" value.
    $id = $block['id'];
    

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'guten-customblock-' . $block['id'];
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }

?>
    <div id="<?php echo esc_html($id); ?>" class="block-create <?php echo esc_html($className); ?>">
        <div class="block-create_wrapper">
            <div class="block-create_wrapper-text">
                <h1><?php the_field('block_create_title'); ?></h1>
                <p><?php the_field('block_create_text'); ?></p>
            </div>
            <?php if( have_rows('block_create_list') ): ?>
            <ul class="block-create_wrapper-grid">
                <?php while( have_rows('block_create_list') ) : the_row(); ?>
                    <li class="block-create_wrapper-grid-item">
                        <p><?php the_sub_field('block_create_bold_text'); ?></p>
                        <p><?php the_sub_field('block_create_text'); ?></p>
                    </li>
                <?php endwhile; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>

<?php
}
?>