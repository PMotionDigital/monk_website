<?php
add_action('acf/init', 'my_acf_block_gallery');
function my_acf_block_gallery()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'Gallery block',
            'title'             => __('Галерея'),
            'description'       => __('Галерея'),
            'render_callback'   => 'render_gallery_block',
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

function render_gallery_block($block)
{
    // Create id attribute allowing for custom "anchor" value.
    $id = $block['id'];
    

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'guten-customblock-' . $block['id'];
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }

?>
    <div id="<?php echo esc_html($id); ?>" class="block-gallery <?php echo esc_html($className); ?>">
        <?php if( have_rows('block_gallery') ): ?>
            <ul class="block-gallery_list <?= wp_is_mobile() ? 'grid' : '' ?>">
                <?php while( have_rows('block_gallery') ) : the_row();
                    $image_id = get_sub_field('block_gallery_img');
                ?>
                    <li class="block-gallery_list-item <?= wp_is_mobile() ? 'grid-item' : '' ?>">
                        <?php echo wp_get_attachment_image($image_id, 'large_image', false); ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        <div class="block-gallery_content">
            <div class="block-gallery_content-img start-anim">
                <?php $graph_image = get_field('block_gallery_graphity_image');
                echo wp_get_attachment_image($graph_image, 'large_image', false);
                ?>
            </div>
            <?php if( have_rows('block_gallery_desc') ): ?>
            <div class="block-gallery_content-text start-anim">
                <?php while( have_rows('block_gallery_desc') ) : the_row(); ?>
                <p><?php the_sub_field('block_gallery_desc_text'); ?></p>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php
}
?>