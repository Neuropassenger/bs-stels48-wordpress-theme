$(document).ready(function(){
//карусель для главного слайдера
    $('#a_main_slider').owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        autoplay: true,
        autoplayHoverPause: true,
        autoplaySpeed: 1500,
        navSpeed: 1500,
        dotsSpeed: 1500,
        autoplayTimeout: 5000,
        navText: ["<img src='img/arrow_left.png'>", "<img src='img/arrow_right.png'>"]
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
        dotsSpeed: 1500,
        autoplayTimeout: 8000,
        navText: ["<img src='img/arrow_left.png'>", "<img src='img/arrow_right.png'>"]
    });
    
//плавная прокрутка для верхнего и нижнего меню
    $('.smooth-scroll').on('click', 'a:not(:last)', smoothScroll);

//плавная прокрутка для "заказать", которые разбросаны по сайту
    $('.a_order_wrap').on('click', 'a', smoothScroll);

//автозаполнение формы и выбор элемента в карусели
    $('.a_position').on('click', 'button', function() {
        let id = $(this).parent().attr('data-model-id'),
            top = $('.a_first_section').offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
        $(`#main_form select option[value="${id}"]`).prop('selected', true);
        setTimeout(function() {
            setModelInOwl(id)
        }, 1000);
    });

//отслеживание ручного изменения формы 
    $("#main_form select").change(function() {
        let id = $(this).val();
        setModelInOwl(id);
    });

//установка padding для многострочных заголовков
    $('.a_wrap').css('padding-top', function() {
        let h4 = $(this).children('.a_descrip').children('h4');
        if (h4.height() > 30) {
            return 18;
        }
        return 0;
    });

//бургер и моб меню
    $('.menu_btn').on('click', function(e) {
        e.preventDefault;
        if ($('.menu_phone').length) {
            genMobMenu();
        } else {
            closeMobMenu();
        }
    });
//ослеживание страницы, чтобы изменить положение бургера
    $(window).on("scroll", function() {
        if ($(window).scrollTop() > 50) $('.burger').css('right', '0');
        else $('.burger').css('right', '23px');
    });

    function setModelInOwl(id) {
        let owl = $("#a_main_slider").owlCarousel();
        owl.data('owl.carousel').options.autoplay = false;
        owl.trigger('to.owl.carousel', [id - 1, 1500]);
        owl.trigger('refresh.owl.carousel');
    };

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
});

ymaps.ready(init);

function init() {  
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