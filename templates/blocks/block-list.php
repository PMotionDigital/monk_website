<?php
add_action('acf/init', 'my_acf_block_list');
function my_acf_block_list()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'list_block',
            'title'             => __('Услуга'),
            'description'       => __('Услуга'),
            'render_callback'   => 'render_list_block',
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

function render_list_block($block)
{
    // Create id attribute allowing for custom "anchor" value.
    $id = $block['id'];
    

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'guten-customblock-' . $block['id'];
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }

?>
<div id="<?php echo esc_html($id); ?>" class="block-list <?= get_field('block_list_grid_white_bg') ? 'block-list--white' : 'block-list--black' ?> <?php echo esc_html($className); ?>">
    <div class="block-list_wrapper-grid <?= get_field('block_list_grid_white_bg') ? 'block-list_wrapper-grid--white' : 'block-list_wrapper-grid--black' ?>">
        <a href="<?php the_field('block_list_socials_link'); ?>" class="block-list_grid-item <?= get_field('block_list_socials') ? 'block-list_grid-item--notarrow' : 'block-list_grid-item--witharrow' ?>">
            <div>
                <p><?php the_field('block_list_grid_text_bold'); ?></p>
                <p><?php the_field('block_list_grid_text'); ?></p>
            </div>
            <?php 
                $socials = get_field('block_list_socials');
                if ($socials == 1) : ?>
                    <?php if( have_rows('block_list_socials_list') ): ?>
                        <div class="block-list_socials">
                            <?php while( have_rows('block_list_socials_list') ) : the_row(); ?>
                            <object class="block-list_socials-item">
                                <a href="<?php the_sub_field('link'); ?>"><img src="<?php the_sub_field('image'); ?>"/></a>
                            </object>
                            <?php endwhile; ?>
                        </div>
                    <?php endif;
                else : ?>
                <span class="block-list_arrow"></span>
            <?php endif; ?>
        </a>
    </div>
</div>

<?php //if (get_field('block_list_socials')) : ?>
                <!-- <?php //if( have_rows('block_list_socials_list') ): ?>
                <div class="block-list_socials">
                    <?php //while( have_rows('block_list_socials_list') ) : the_row(); ?>
                    <a href="<?php //the_sub_field('link'); ?>" class="block-list_socials-item"><img src="<?php //the_sub_field('image'); ?>"/></a>
                    <?php //endwhile; ?>
                </div> -->
                <?php 
                //endif; 
            //else : ?>

<?php

}
?>