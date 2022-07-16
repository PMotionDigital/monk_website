<?php

    // Свои стили для гутенберг блоков
    add_action( 'after_setup_theme', 'custom_admin_css' );
    function custom_admin_css(){
        add_theme_support( 'editor-styles' ); // if you don't add this line, your stylesheet won't be added
        add_editor_style( 'dist/css/bundle.css' ); // tries to include style-editor.css directly from your theme folder
    }

    // Add backend styles for Gutenberg.
    add_action('enqueue_block_editor_assets', 'gutenberg_editor_assets');
    function gutenberg_editor_assets() {
        // Load the theme styles within Gutenberg.
        wp_enqueue_style('my-gutenberg-editor-styles', get_theme_file_uri('src/css/admin.css'), FALSE);
    }

    add_action('admin_head', 'editor_full_width_gutenberg');
    function editor_full_width_gutenberg() {
    echo '<style>
        body.gutenberg-editor-page .editor-post-title__block, body.gutenberg-editor-page .editor-default-block-appender, body.gutenberg-editor-page .editor-block-list__block {
            max-width: 100% !important;
            padding: 0 1rem;
            margin-left: auto;
            margin-right: auto;
        }
        .block-editor__container .wp-block {
            max-width: 100% !important;
            margin-left: auto;
            margin-right: auto;
        }
        /*code editor*/
        .edit-post-text-editor__body {
            max-width: 100% !important;
            margin-left: 2%;
            margin-right: 2%;
        }
    </style>';
    }
?>