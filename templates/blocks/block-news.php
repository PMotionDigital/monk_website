<?php
add_action('acf/init', 'my_acf_block_news');
function my_acf_block_news()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'News block',
            'title'             => __('Новости'),
            'description'       => __('Новости'),
            'render_callback'   => 'render_news_block',
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

function render_news_block($block)
{
    // Create id attribute allowing for custom "anchor" value.
    $id = $block['id'];
    

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'guten-customblock-' . $block['id'];
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    // $category_id = get_field('category');

    $args = array(  
        // 'cat' => $category_id,
        'post_status' => 'publish',
        'posts_per_page' => 6,
    );
    // $link = get_post_type_archive_link('portfolio' );
    $loop = new WP_Query( $args );
?>
    <div id="<?php echo esc_html($id); ?>" class="block-news <?php echo esc_html($className); ?>">
        <div class="block-news_wrap">
            <div class="block-news_wrap-guter-content">
                <InnerBlocks />
            </div>
            <ul class="block-news_wrap-nav">
                <li class="block-news_wrap-nav_name">Статья</li>
                <li class="block-news_wrap-nav_cat">Рубрика</li>
                <li class="block-news_wrap-nav_date">Дата</li>
                <li class="block-news_wrap-nav_author">Автор</li>
            </ul>
            <ul class="block-news_wrap-list">
                <?php while ( $loop->have_posts() ) : $loop->the_post(); 
                    $post_id = get_the_ID();
                ?>
                    <li class="block-news_list-item">
                        <div class="block-news_list-item_title">
                            <h3><?php the_title(); ?></h3>
                        </div>
                        <div class="block-news_list-item_category">
                            <p>
                                <?php $cats = get_the_category($post_id);
                                    foreach ($cats as $cat) :
                                        if (count($cats) > 1) :
                                        echo $cat->name . ',';
                                        else :
                                        echo $cat->name;
                                        endif;
                                    endforeach;
                                ?>
                            </p>
                        </div>
                        <div class="block-news_list-item_date">
                            <p><?= get_the_date() ?></p>
                        </div>
                        <div class="block-news_list-item_author">
                            <p><?= the_field('block_news_author', $post_id); ?></p>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
        
    </div>

<?php
}
?>