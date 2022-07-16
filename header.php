<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
    <header class="main-header">
        <a href="/" class="main-header_logo">
            <?php
                $header_logo = get_field('header_logo', 'option');
                echo wp_get_attachment_image($header_logo, 'large_image', false); 
            ?>
        </a>
        <div class="main-header_imge">
            <?php 
                $header_logo_graph = get_field('header_logo_graph', 'option');
                echo wp_get_attachment_image($header_logo_graph, 'large_image', false); 
            ?>
        </div>
    </header>
 
    <main id="main">
        
