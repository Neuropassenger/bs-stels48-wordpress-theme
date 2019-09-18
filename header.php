<!DOCTYPE html>
<html <?php language_attributes();?>
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php get_bloginfo('name')?></title>
    <meta name="description" content="<?php bloginfo('description') ?>">
    <meta name="author" content="Breakout Studio">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="style.css?v=1.0.0">
    <link rel="stylesheet" href="css/media.css?v=1.0.0">
    <link rel="stylesheet" href="libs/flex_css/flex.css">
    <link rel="stylesheet" href="libs/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="libs/owlcarousel/owl.carousel.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap" rel="stylesheet">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="libs/fancybox/jquery.fancybox.min.js"></script>
    <script src="libs/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=<2044817c-a630-48b1-acf8-5e08fd4884d3>&lang=ru_RU" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/d65132e2be.js"></script>
    <?php wp_head(); ?>
</head>
<body>
<script src="js/common.js"></script>
<header class="flex_main flex_jcontent-between">
    <div class="logo flex_main flex_column flex_jcontent-center">
        <p>stels48</p>
    </div>
    <div class="menu_phone flex_main flex_jcontent-between">
        <nav class="smooth-scroll">
            <?php wp_nav_menu([
                'theme-location' => 'top-menu',
                'container' => null,
                'item-wrap' => '<ul>%3$s</ul>'
            ]); ?>
        </nav>
        <span class="phone"><i class="fas fa-phone"></i><?php get_sidebar('phone'); ?></span>
    </div>
    <div class="burger">
        <a class="menu_btn" href="#">
            <span></span>
        </a>
    </div>
</header>