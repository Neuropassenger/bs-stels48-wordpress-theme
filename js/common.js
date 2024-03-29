jQuery(document).ready(function( $ ) {

//карусель для главного слайдера
    $('#a_main_slider').owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        autoplay: true,
        autoHeight: true,
        startPosition: 3,
        lazyLoad: true,
        autoplayHoverPause: true,
        autoplaySpeed: 1500,
        navSpeed: 1500,
        dotsSpeed: 500,
        autoplayTimeout: 5000,
        navText: ["<img src='wp-content/themes/bs-stels48/img/arrow_left.png'>", "<img src='wp-content/themes/bs-stels48/img/arrow_right.png'>"]
    });
//карусель для отзывов
    $('#a_comments').owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayHoverPause: true,
        autoplaySpeed: 1500,
        navSpeed: 1500,
        autoplayTimeout: 8000,
        navText: ["<img src='wp-content/themes/bs-stels48/img/arrow_left.png'>", "<img src='wp-content/themes/bs-stels48/img/arrow_right.png'>"]
    });

//плавная прокрутка для верхнего и нижнего меню
    $('.smooth-scroll').on('click', 'a:not(:last)', smoothScroll);

//плавная прокрутка для "заказать", которые разбросаны по сайту
    $('.a_order_wrap').on('click', 'a', smoothScroll);

//автозаполнение формы и выбор элемента в карусели при щелчке на заказать
    $('.a_position').on('click', 'button', setFormAndOwl);

//автозаполнение формы и выбор элемента в карусели при щелчке на картинку
    $('.a_position').on('click', 'img', setFormAndOwl);

//отслеживание ручного изменения формы 
    $("#main_form select").change(function() {
        $(this).find('option').each(function() {
            if ($(this).prop('selected') == true) {
                let id = $(this).attr('model-id');
                setModelInOwl(id);
            }
        });
    });

//установка padding для многострочных заголовков
    $('.a_wrap').css('padding-top', function () {
        let h4 = $(this).children('.a_descrip').children('h4');
        if (h4.height() > 30) {
            return 18;
        }
        return 0;
    });

//бургер и моб меню
    $('.menu_btn').on('click', function (e) {
        e.preventDefault;
        if ($('.menu_phone').length) {
            genMobMenu();
        } else {
            closeMobMenu();
        }
    });
//ослеживание страницы, чтобы изменить положение бургера
    $(window).on("scroll", function () {
        if ($(window).scrollTop() > 50) $('.burger').css('right', '0');
        else $('.burger').css('right', '23px');
    });
//убираем пустые поля из таблицы атрибутов товара
    $('.a_position tr:has(td:empty)').detach();

//делаем квадратики для цветов товара
    $('.a_position td:contains(Цвет)').siblings('td').append(function(index, value) {
        let colours = value.split(', ');
        $(this).html(null);
        let squares = '';
        colours.forEach(function(colour) {
            if (colour.indexOf('/') != -1) {
                let twoColoursSqure = colour.split('/');
                squares += `<div style="border: 7px solid; border-top-color: ${twoColoursSqure[0]};
                                        border-left-color: ${twoColoursSqure[0]};
                                        border-right-color: ${twoColoursSqure[1]};
                                        border-bottom-color: ${twoColoursSqure[1]};">
                            </div>`;
            } else {
                squares += `<div style="border: 7px solid ${colour};"></div>`;
            }
        });
        return squares;
    });

//делаем рейтинг из звездочек
    $( '.owl-item:not( .cloned ) .rating' ).append( function () {
        let solidStars = '';
        let regularStars = '';
        let countSolidStars = +$(this).children('span').text();
        let countRegularStars = 5 - countSolidStars;
        for (let i = 0; i < countSolidStars; i++) {
            solidStars += '<i class="fas fa-star"></i>';
        }
        for (let i = 0; i < countRegularStars; i++) {
            regularStars += '<i class="far fa-star"></i>';
        }
        return solidStars + regularStars;
    });

//загрузка карты после достижения секции 'О велосипедах'
    let isMapInitialized = false;
    let aboutBikesTop = $("#aboutbikes").offset().top;

    $(window).scroll(function() {
        if ($(this).scrollTop() > aboutBikesTop && !isMapInitialized) {
            isMapInitialized = true;
            loadMap();
        }
    });

    function loadMap() {
        $.getScript('//api-maps.yandex.ru/2.1/?apikey=<2044817c-a630-48b1-acf8-5e08fd4884d3>&lang=ru_RU', function () {
            ymaps.ready(setMyMap)
        });
    }

    function setFormAndOwl() {
        let model;
        if (($(this).get(0).tagName) == 'BUTTON' ) {
            model = $(this).siblings('div').children('h4').text();

        } else if (($(this).get(0).tagName) == 'IMG') {
            model = $(this).parent().siblings('h4').text();
        }
        let top = $('.a_first_section').offset().top;

        $('body,html').animate({scrollTop: top}, 1000);
        let id = $(`#main_form select option:contains(${model})`).prop('selected', true).attr('model-id');
        console.log(id);
        setTimeout(function () {
            setModelInOwl(id);
        }, 1000);
    }

    function setModelInOwl(id) {
        let owl = $("#a_main_slider").owlCarousel();
        owl.data('owl.carousel').options.autoplay = false;
        owl.trigger('to.owl.carousel', [id - 1, 500]);
        owl.trigger('refresh.owl.carousel');
    }

    function smoothScroll() {
        if ($('.mob_main_menu').length) {
            closeMobMenu();
        }
        let id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1500);
    }

    function genMobMenu() {
        $('.menu_btn').addClass('menu_btn_active');
        $('header').removeClass().addClass('mob_main_menu flex_main flex_column flex_jcontent-between').append($('#main_form'));
        $('.menu_phone').removeClass().addClass('mob_menu flex_main flex_column flex_jcontent-between');
        $('header ul').removeClass();
        $('.logo, main, footer').css('display', 'none');
    }

    function closeMobMenu() {
        $('.menu_btn').removeClass('menu_btn_active');
        $("body").removeClass();
        $('header').removeClass().addClass('flex_main flex_jcontent-between');
        $('.a_first_section > div:first').append($('#main_form'));
        $('.mob_menu').removeClass().addClass('menu_phone flex_main flex_jcontent-between');
        $('header ul').addClass('flex_main flex_wrap flex_jcontent-between');
        $('.logo, main, footer').css('display', 'flex');
        $('main').css('display', 'block');
    }

    function setMyMap() {
        var myMap = new ymaps.Map("map", {
                center: [52.621670, 38.504245],
                zoom: 15,
                controls: []
            }, {
                searchControlProvider: 'yandex#search'
            }),

            myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                iconCaption: 'Наш магазин',
                hintContent: 'STELS48 - это качественные велосипеды<br>по самым низким ценам в СНГ',
                balloonContent: 'Россия, Липецкая обл.,<br>г. Елец, ул. Пушкина, д. 144'
            }, {
                preset: 'islands#icon',
                iconColor: '#97D700'
            });

        myMap.geoObjects
            .add(myPlacemark)
    };
});