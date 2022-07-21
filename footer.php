    </main>

    <footer id="footer" class="main-footer">
        <?php 
            $footer_group_phone = get_field('footer_group', 'option');
            $footer_group_mail = get_field('footer_group_mail', 'option');
            $footer_form = get_field('footer_form', 'option')
        ?>
        <div class="main-footer_form">
            <div class="main-footer_form-text start-anim">
                <h2><?php the_field('footer_title', 'option'); ?></h2>
                <p><?php the_field('footer_text', 'option'); ?></p>
            </div>
            <div class="main-footer_form-content start-anim">
                <?php echo do_shortcode($footer_form); ?>
            </div>
        </div>
        <div class="main-footer_wrap">
            <a href="tel:<?= $footer_group_phone['footer_phone'] ?>" class="main-footer_phone start-anim">
                <?php echo wp_get_attachment_image($footer_group_phone['footer_image'], 'large_image', false); ?>
            </a>
            <a href="mailto:<?= $footer_group_mail['footer_group_mail_text'] ?>" class="start-anim">
                <?php echo wp_get_attachment_image($footer_group_mail['footer_group_mail_image'], 'large_image', false); ?>
            </a>
        </div>
        <p class="main-footer_capture">© 2021-2022 Monk</p>
    </footer>
<?php wp_footer(); ?>

</body>
</html>