<?php
add_action('acf/init', 'my_acf_block_portfolio');
function my_acf_block_portfolio()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'Portfolio block',
            'title'             => __('Портфолио'),
            'description'       => __('Портфолио'),
            'render_callback'   => 'render_portfolio_block',
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

function render_portfolio_block($block)
{
    // Create id attribute allowing for custom "anchor" value.
    $id = $block['id'];
    

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'guten-customblock-' . $block['id'];
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    $args = array(  
        'post_type' => 'portfolio',
        'post_status' => 'publish',
        'posts_per_page' => 3,
    );
    // $link = get_post_type_archive_link('portfolio' );
    $loop = new WP_Query( $args );
?>
    <div id="<?php echo esc_html($id); ?>" class="block-portfolio <?php echo esc_html($className); ?>">
        <div class="block-portfolio_wrap">
            <div class="block-portfolio_wrap-guter-content">
                <InnerBlocks />
            </div>
            <ul class="block-portfolio_wrap-list">
                <?php while ( $loop->have_posts() ) : $loop->the_post(); 
                    $post_id = get_the_ID();
                    $block_portfolio_bg = get_field('block_portfolio_bg', $post_id);
                ?>
                    <li class="block-portfolio_list-item">
                        <div class="block-portfolio_list-item_bg" style="background-color: <?= $block_portfolio_bg ?>">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="block-portfolio_list-item_content">
                            <h3><?php the_title(); ?></h3>
                            <?php the_excerpt() ?>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
        
    </div>

<?php
}
?>