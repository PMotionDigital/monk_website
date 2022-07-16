<?php
add_action('acf/init', 'my_acf_block_learning');
function my_acf_block_learning()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'Learning block',
            'title'             => __('Обучение'),
            'description'       => __('Обучение'),
            'render_callback'   => 'render_learning_block',
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

function render_learning_block($block)
{
    // Create id attribute allowing for custom "anchor" value.
    $id = $block['id'];
    

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'guten-customblock-' . $block['id'];
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }

?>
    <div id="<?php echo esc_html($id); ?>" class="block-learning <?php echo esc_html($className); ?>">
        <div class="block-learning_wrapper">
            <div class="block-learning_wrapper-text">
                <h2><?php the_field('block_learning_title'); ?></h2>
                <div class="block-learning_wrapper_image">
                    <img src="<?php the_field('block_learning_image') ?>">
                </div>
                
            </div>
            <?php if( have_rows('block_learning_grid') ): ?>
            <ul class="block-learning_wrapper-grid">
                <?php while( have_rows('block_learning_grid') ) : the_row(); ?>
                    <li class="block-learning_wrapper-grid-item <?= get_sub_field('block_learning_socials') ? 'block-learning_wrapper-grid-item--notarrow' : 'block-learning_wrapper-grid-item--witharrow' ?>">
                        <div>
                            <p><?php the_sub_field('block_learning_grid_text_bold'); ?></p>
                            <p><?php the_sub_field('block_learning_grid_text'); ?></p>
                        </div>
                        <?php if (get_sub_field('block_learning_socials')) : ?>
                            <?php if( have_rows('block_learning_socials_list') ): ?>
                            <div class="block-learning_socials">
                                <?php while( have_rows('block_learning_socials_list') ) : the_row(); ?>
                                <a href="<?php the_sub_field('link'); ?>" class="block-learning_socials-item"><img src="<?php the_sub_field('image'); ?>"></a>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; endif;?>
                    </li>
                <?php endwhile; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>

<?php
}
?>