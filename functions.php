<?php
add_theme_support('post-thumbnails');
register_nav_menus(array(
    'main_menu'   => 'Main menu',
    'footer_menu' => 'Footer menu',
    'mobile_menu' => 'Mobile menu'
));



//includes

include 'func/register-blocks-category.php';
include 'func/gutenberg/settings.php';
include 'func/register-image-size.php';

// guten blocks
foreach(glob(get_template_directory() . '/templates/blocks/*.php') as $file){
    require $file;
}
foreach(glob(get_template_directory() . '/func/ajax/*.php') as $file){
    require $file;
}

// option page
if (function_exists('acf_add_options_page')) {
    $company_options = acf_add_options_page(
        array(
            'page_title' => 'Опции сайта',
            'menu_title' => 'Опции сайта',
            'menu_slug'  => 'company_options',
            'capability' => 'edit_posts',
            'redirect'   => false
        )
    );

}


// автообновление версии файлов
function my_theme_load_resources() {

    $theme_uri = get_template_directory_uri();
    $theme_styles = $theme_uri.'/dist/css/bundle.css';
    $theme_scripts = $theme_uri.'/dist/js/bundle.js';

    // global style connected

    wp_register_style('my-theme-style', $theme_styles , false, filemtime(get_stylesheet_directory() .'/dist/css/bundle.css'));
    wp_enqueue_style('my-theme-style');
        
    // scripts connected
        
    wp_register_script('my_theme_functions', $theme_scripts , array('jquery'), filemtime(get_stylesheet_directory() .'/dist/js/bundle.js'), true);
    wp_enqueue_script('my_theme_functions'); 
}
add_action('wp_enqueue_scripts', 'my_theme_load_resources');





 


