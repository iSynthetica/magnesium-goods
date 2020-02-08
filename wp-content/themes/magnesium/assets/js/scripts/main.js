(function ($) {

    // Scripts which runs after DOM load
    $(document).ready(function () {
        $('.scroll-to-top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });

        $('.toOverlay').each(function () {
            $(this).click(function () {
                $btn = $(this);
                $overlayContainer = $('#mobile-overlay');
                $overlayHeaderContainer = $('#mobile-overlay .mobile-overlay-inner__container .mobile-overlay-header__holder');
                $overlayContentContainer = $('#mobile-overlay .mobile-overlay-inner__container .mobile-overlay-content__container');
                $idToOverlay = $btn.data('overlayId');
                $titleToOverlay = $btn.data('overlayTitle');
                htmlToOverlay = $( '#' + $idToOverlay ).html();
                $overlayContentContainer.html(htmlToOverlay).foundation();
                $overlayHeaderContainer.html('<h3>'+$titleToOverlay+'</h3>').foundation();
                $overlayContainer.addClass('active');
            });
        });

        $('.closeOverlay').click(function () {
            $overlayContainer = $('#mobile-overlay');
            $overlayHeaderContainer = $('#mobile-overlay .mobile-overlay-inner__container .mobile-overlay-header__holder');
            $overlayContentContainer = $('#mobile-overlay .mobile-overlay-inner__container .mobile-overlay-content__container');
            $overlayHeaderContainer.html('').foundation();
            $overlayContentContainer.html('').foundation();
            $overlayContainer.removeClass('active');
        });

        /**
         * Woocommerce
         */
        $('.single_buy_one_click_button').click(function() {
            var btn = this;
            var type = $(this).data('productType');
            var form = $(this).closest('form');
            var prodId, variationId, quantity;

            if ( 'variable' == type ) {
                prodId = $("input[name='product_id']" , form).val();
                variationId = $("input[name='variation_id']" , form).val();
                quantity = $("input[name='quantity']" , form).val();
            } else {
                prodId = $(this).val();
                variationId = '';
                quantity = $("input[name='quantity']" , form).val();
            }

            console.log(type);
            console.log(prodId);
            console.log(variationId);
            console.log(quantity);

            $('#buy_one_click_form').foundation('open');
        });

        /**
         * Run Plugins
         */
        $('input[type="number"]').niceNumber();

        $('.slider-pics').slick({
            arrows: true, dots: false,
            responsive: [
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false, dots: true
                    }
                }
            ]
        });
        $('.slider-videos').slick({
            arrows: true, dots: false,
            fade: true,
            cssEase: 'linear',
            responsive: [
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false, dots: true
                    }
                }
            ]
        });
        $('.commentlist').slick({
            arrows: true, dots: false,
            fade: true,
            cssEase: 'linear',
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false, dots: true
                    }
                }
            ]
        });

        $('.woo-slider__container .products.products-loop').slick({
            arrows: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1040,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 840,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
        $('.woo-interesting-products-slider__container .products.products-loop').slick({
            arrows: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            adaptiveHeight: 1,
            responsive: [
                {
                    breakpoint: 1040,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 840,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $(".lightgallery").lightGallery({getCaptionFromTitleOrAlt: false});

        var isSlickEnabled = $('.product-template-default .images').hasClass('slick-enabled');

        if(isSlickEnabled) {
            var productImageSlider = $("#product-images-slider");
            var productImageSlides = productImageSlider.children("div");

            var productThumbnailsSlider = $("#product-thumbnails-slider");
            var productThumbnailsSlides = productThumbnailsSlider.children("div");
            var productThumbnailsFirstSlide = productThumbnailsSlides.first();

            var isZoomEnabled = productImageSlider.hasClass('zoom-enabled');
            var l = !1;

            productImageSlider.slick({
                infinite: !1,
                adaptiveHeight: !0,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: 1,
                dots: 0,
                fade: !0
            });

            //zoomEnable(".woocommerce-start-image.zoom img", isZoomEnabled);

            productImageSlider.on('beforeChange', function(b, g, e, k) {
                l || productThumbnailsSlider.find(".slick-slide").eq(k).trigger("click");
                l =!1;
                productImageSlider.addClass("animating");
            });

            productImageSlider.on('afterChange', function() {
                productImageSlider.removeClass("animating");
                //zoomEnable(".slick-current .woocommerce-main-image.zoom img", isZoomEnabled);
            });

            productThumbnailsSlides.bind('click', function() {
                var c = $(this);
                if (!c.hasClass("current-slide")) {
                    l = !0;
                    productThumbnailsFirstSlide.removeClass("current-slide");

                    c.addClass("current-slide");

                    productThumbnailsFirstSlide = c;

                    if (c.next().hasClass("slick-active")) {
                        if(!c.prev().hasClass("slick-active")) {
                            productThumbnailsSlider.slick("slickPrev");
                        }
                    } else {
                        productThumbnailsSlider.slick("slickNext");
                    }
                    productImageSlider.slick("slickGoTo", c.index(), !1);
                }
            });

            productThumbnailsSlider.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: !1,
                infinite: !1,
                focusOnSelect: !1,
                draggable: !1,
                speed: 300,
                swipe: !1,
                touchMove: !1
            });
        }
    });

    // Scripts which runs after all elements load
    $(window).load(function () {

        //jQuery code goes here

    });

    // Scripts which runs at window resize
    $(window).resize(function () {

        //jQuery code goes here


    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 170) {
            $('.sticky-navigation-header').css({top: "0"});

        } else {
            $('.sticky-navigation-header').css({top: "-50px"});

        }
    });

    $( document.body ).on( 'updated_cart_totals', function(){
        $('input[type="number"]').niceNumber();
    });

    // Preloader
    if(jQuery('#preloader-background').length > 0) {
        setTimeout(function(){jQuery('#preloader-background').hide();}, 600);
    }

}(jQuery));