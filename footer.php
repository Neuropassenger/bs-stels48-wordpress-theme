<footer class="flex_main flex_wrap flex_jcontent-around">
    <?php echo do_shortcode( '[contact-form-7 id="189" html_class="flex_main flex_column" html_id="form"]') ; ?>
    <?php wp_nav_menu([
        'theme_location' => 'footer-menu',
        'container' => 'nav',
        'container_class' => 'a_footer_menu flex_main flex_column smooth-scroll',
        'item-wrap' => '<ul>%3$s</ul>'
    ]); ?>
    <?php get_sidebar('footer'); ?>
</footer>
<div style="display: none;" id="hidden_call_back">
    <h2>Здесь!</h2>
    <p>Будет форма для обратного звонка</p>
</div>
<?php wp_footer(); ?>
</body>
</html>