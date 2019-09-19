<footer class="flex_main flex_wrap flex_jcontent-around">
    <form action="" class="flex_main flex_column" id="form">
        <input type="text" name="name" placeholder="Имя">
        <input type="text" name="phone" placeholder="Телефон" required>
        <select>
            <option value="" disabled selected style="display:none;">Модель</option>
            <option>Navigator 630 MD</option>
            <option>Navigator 300 Gent</option>
            <option>Miss 5000 MD</option>
            <option>Focus MD</option>
            <option>Pilot 950 MD</option>
            <option>Navigator 500 V</option>
        </select>
        <button type="submit">заказать</button>
    </form>
    <div class="a_footer_menu flex_main flex_column smooth-scroll">
        <ul>
            <?php wp_nav_menu([
                'theme_location' => 'footer-menu',
                'container' => null,
                'item-wrap' => '<ul>%3$s</ul>'
            ]); ?>
        </ul>
    </div>
    <?php get_sidebar('footer'); ?>
</footer>
<div style="display: none;" id="hidden_call_back">
    <h2>Здесь!</h2>
    <p>Будет форма для обратного звонка</p>
</div>
<?php wp_footer(); ?>
</body>
</html>