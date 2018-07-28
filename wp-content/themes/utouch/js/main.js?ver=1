//Global var
var CRUMINA = {};

(function ($) {

    // USE STRICT
    "use strict";

    //----------------------------------------------------/
    // Predefined Variables
    //----------------------------------------------------/
    var $window = $(window),
        $document = $(document),
        $body = $('body'),

        swipers = {},
        //Elements
        $header = $('#site-header'),
        $header_space = $header.next('.header-spacer'),
        $footer = $('#site-footer'),
        $nav = $('#primary-menu'),
        $counter = $('.counter'),
        $progress_bar = $('.skills-item'),
        $primary_menu = $('#primary-menu'),
        $preloader = $('#hellopreloader'),
        $countdown = $('.utouch-clock.clock');



        /* -----------------------
         * Fixed Header
         * --------------------- */

    CRUMINA.fixedHeader = function () {
        $header.headroom(
            {
                "offset": 50,
                "tolerance": 5,
                "classes": {
                    "initial": "animated",
                    "pinned": $header.data('pinned'),
                    "unpinned": $header.data('unpinned'),
                },
                onUnpin: function () {
                    if ($nav.find('.sub-menu, .megamenu').hasClass('drop-up')) {
                        this.elem.classList.remove(this.classes.unpinned);
                        this.elem.classList.add(this.classes.pinned);
                    }
                    else {
                        this.elem.classList.add(this.classes.unpinned);
                        this.elem.classList.remove(this.classes.pinned);
                    }
                }
            }
        );
    };


    /* -----------------------
     * Parallax footer
     * --------------------- */

    CRUMINA.parallaxFooter = function () {
        if ($footer.length && $footer.hasClass('js-fixed-footer')) {
            $footer.before('<div class="block-footer-height"></div>');
            $('.block-footer-height').matchHeight({
                target: $footer
            });
        }
    };


    /* -----------------------
     * Preloader
     * --------------------- */

    CRUMINA.preloader = function () {
        setTimeout(function () {
            $preloader.toggleClass('fade');
        }, 800);
        return false;
    };


    /* -----------------------
     * COUNTER NUMBERS
     * --------------------- */

    CRUMINA.counters = function () {
        if ($counter.length) {
            $counter.each(function () {
                jQuery(this).waypoint(function () {

                    if (typeof this === 'object' && this.hasOwnProperty('element')) {
                        $(this.element).find('span').countTo();
                        this.destroy();
                    } else {
                        $(this).find('span').countTo();
                    }


                }, {offset: '95%'});
            });
        }
    };

    /* -----------------------
     * Progress bars Animation
     * --------------------- */
    CRUMINA.progresBars = function () {
        if ($progress_bar.length) {
            $progress_bar.each(function () {
                jQuery(this).waypoint(function () {
                    if (typeof this === 'object' && this.hasOwnProperty('element')) {
                        $(this.element).find('.count-animate').countTo();
                        $(this.element).find('.skills-item-meter-active').fadeTo(300, 1).addClass('skills-animate');
                        this.destroy();
                    } else {
                        $(this).find('.count-animate').countTo();
                        $(this).find('.skills-item-meter-active').fadeTo(300, 1).addClass('skills-animate');
                    }

                }, {offset: '90%'});
            });
        }
    };


    /* -----------------------------
     * Embedded Video in pop up
     * ---------------------------*/
    CRUMINA.mediaPopups = function () {
        $('.js-popup-iframe').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,

            fixedContentPos: false
        });
        $('.js-zoom-image, .link-image').magnificPopup({
            type: 'image',
            removalDelay: 500, //delay removal by X to allow out-animation
            callbacks: {
                beforeOpen: function () {
                    // just a hack that adds mfp-anim class to markup
                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                    this.st.mainClass = 'mfp-zoom-in';
                }
            },
            closeOnContentClick: true,
            midClick: true
        });

        $('.gallery-popup').each(function () { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    };
    /* -----------------------------
     * Equal height
     * ---------------------------*/
    CRUMINA.equalHeight = function () {
        $('.js-equal-child').find('.theme-module').matchHeight({
            property: 'min-height'
        });
    };

    CRUMINA.is_empty_attr = function (array_or_object, key) {
        return array_or_object[key] === undefined || array_or_object[key] == '';
    };

    /* -----------------------------
     * Isotope sorting
     * ---------------------------*/

    CRUMINA.IsotopeSort = function () {
        var $container = $('.sorting-container');
        $container.each(function () {
            var $current = $(this);
            var layout = ($current.data('layout').length) ? $current.data('layout') : 'masonry';
            $current.isotope({
                itemSelector: '.sorting-item',
                layoutMode: layout,
                percentPosition: true
            });

            $current.imagesLoaded().progress(function () {
                $current.isotope('layout');
            });

            var $sorting_buttons = $current.siblings('.sorting-menu').find('li');

            $sorting_buttons.on('click', function () {
                if ($(this).hasClass('active')) return false;
                $(this).parent().find('.active').removeClass('active');
                $(this).addClass('active');
                var filterValue = $(this).data('filter');
                if (typeof filterValue != "undefined") {
                    $current.isotope({filter: filterValue});
                    return false;
                }
            });
        });
    };



    /* -----------------------------
     * Sliders and Carousels
     * ---------------------------*/

    CRUMINA.initSwiper = function () {
        var initIterator = 0;

        $('.swiper-container').each(function () {

            var $t = $(this);
            var index = 'swiper-unique-id-' + initIterator;
            var $breakPoints = false;
            $t.addClass('swiper-' + index + ' initialized').attr('id', index);
            $t.closest('.crumina-module').find('.swiper-pagination').addClass('pagination-' + index);

            var $effect = ($t.data('effect')) ? $t.data('effect') : 'slide',
                $crossfade = ($t.data('crossfade')) ? $t.data('crossfade') : true,
                $loop = ($t.data('loop') == false) ? $t.data('loop') : true,
                $showItems = ($t.data('show-items')) ? $t.data('show-items') : 1,
                $scrollItems = ($t.data('scroll-items')) ? $t.data('scroll-items') : 1,
                $scrollDirection = ($t.data('direction')) ? $t.data('direction') : 'horizontal',
                $mouseScroll = ($t.data('mouse-scroll')) ? $t.data('mouse-scroll') : false,
                $autoplay = ($t.data('autoplay')) ? parseInt($t.data('autoplay'), 10) : 0,
                $autoheight = ($t.hasClass('auto-height')) ? true : false,
                $nospace = ($t.data('nospace')) ? $t.data('nospace') : false,
                $centeredSlider = ($t.data('centered-slider')) ? $t.data('centered-slider') : false,
                $stretch = ($t.data('stretch')) ? $t.data('stretch') : 0,
                $depth = ($t.data('depth')) ? $t.data('depth') : 0,
                $speed = ($t.data('speed')) ? $t.data('speed') : 300,
                $slidesSpace = ($showItems > 1 && true != $nospace ) ? 20 : 0;

            var $slides_per_screen = {};

            if ($t.data('md-slides')) {
                $slides_per_screen['1024'] = {
                    slidesPerView: $t.data('md-slides'),
                    slidesPerGroup: $t.data('md-slides')
                };
            }

            if ($t.data('sm-slides')) {
                $slides_per_screen['768'] = {
                    slidesPerView: $t.data('sm-slides'),
                    slidesPerGroup: $t.data('sm-slides')
                };
            }


            if ($showItems > 1) {
                $breakPoints = {
                    480: {
                        slidesPerView: 1,
                        slidesPerGroup: 1
                    },
                    768: {
                        slidesPerView: 2,
                        slidesPerGroup: 2
                    }
                };

                if (Object.keys($slides_per_screen).length) {
                    $breakPoints = $slides_per_screen;
                }

            }

            swipers['swiper-' + index] = new Swiper('.swiper-' + index, {
                pagination: '.pagination-' + index,
                paginationClickable: true,
                direction: $scrollDirection,
                mousewheelControl: $mouseScroll,
                mousewheelReleaseOnEdges: $mouseScroll,
                slidesPerView: $showItems,
                slidesPerGroup: $scrollItems,
                spaceBetween: $slidesSpace,
                keyboardControl: true,
                setWrapperSize: true,
                preloadImages: true,
                updateOnImagesReady: true,
                centeredSlides: $centeredSlider,
                autoplay: $autoplay,
                autoplayDisableOnInteraction: false,
                autoHeight: $autoheight,
                loop: $loop,
                breakpoints: $breakPoints,
                effect: $effect,
                fade: {
                    crossFade: $crossfade
                },
                speed: $speed,
                parallax: true,
                onImagesReady: function (swiper) {
                    CRUMINA.resizeSwiper(swiper);
                },
                onTransitionStart: function (swiper) {
                    CRUMINA.resizeSwiper(swiper);
                },
                coverflow: {
                    stretch: $stretch,
                    rotate: 0,
                    depth: $depth,
                    modifier: 2,
                    slideShadows: false
                },
                onSlideChangeStart: function (swiper) {

                    var $slider_slides = $t.closest('.crumina-module-slider').find('.slider-slides');
                    if ($slider_slides.length) {
                        $slider_slides.find('.slide-active').removeClass('slide-active');
                        var activeIndex = 1;
                        if (1 === swiper.loopedSlides) {
                            activeIndex = swiper.activeIndex - 1;
                        } else {
                            activeIndex = swiper.activeIndex;
                        }
                        var $slides_item = $slider_slides.find('.slides-item');
                        activeIndex = activeIndex % $slides_item.size();
                        $slides_item.eq(activeIndex).addClass('slide-active');

                    }
                }
            });
            initIterator++;
        });

        //swiper arrows
        $('.btn-prev').on('click', function () {
            let current_id = $(this).closest('.crumina-module-slider').find('.swiper-container').attr('id');
            swipers['swiper-' + current_id].slidePrev();
        });

        $('.btn-next').on('click', function () {
            let current_id = $(this).closest('.crumina-module-slider').find('.swiper-container').attr('id');
            swipers['swiper-' + current_id].slideNext();
        });

        //swiper tabs

        $('.slider-slides .slides-item').on('click', function (e) {
            e.preventDefault();
            var current_id = $(this).closest('.crumina-module-slider').find('.swiper-container').attr('id');
            var mySwiper = swipers['swiper-' + current_id];
            if ($(this).hasClass('slide-active')) return false;
            var activeIndex = $(this).parent().find('.slides-item').index(this);
            var $loop = (mySwiper.container.data('loop') === false) ? mySwiper.container.data('loop') : true;
            if (true === $loop) {
                activeIndex = activeIndex + 1;
            }
            mySwiper.slideTo(activeIndex);
            $(this).parent().find('.slide-active').removeClass('slide-active');
            $(this).addClass('slide-active');
            mySwiper.update();
            return false;
        });
    };
    CRUMINA.resizeSwiper = function (swiper) {
        swiper = (swiper) ? swiper : $(this)[0].swiper;

        var activeSlideHeight = swiper.slides.eq(swiper.activeIndex).find('> *').outerHeight();

        if ($(swiper.container).hasClass('pagination-vertical')){
            var headlineHeights = swiper.slides.map(function() {
                return $(this).find('> *').height();
            }).get();

            var maxHeadLineHeight = Math.max.apply(Math, headlineHeights);
            swiper.container.css({height: maxHeadLineHeight + 'px'});
            swiper.update(true)
        }

        if ($(swiper.container).hasClass('auto-height')){
            swiper = (swiper) ? swiper : $(this)[0].swiper;
            swiper.container.css({height: activeSlideHeight + 'px'});
            swiper.onResize();
        }

        $('.swiper-container.js-full-window').each(function () {
            var $slider = $(this);
            var winHei = $(window).height();
            $slider.css('min-height', winHei + 'px');
            if ($header_space.length) {
                var $heder_height = $header_space.height();
            } else {
                $heder_height = 0;
            }
            $slider.css('min-height', winHei - $heder_height + 'px');
            $slider.find('> .swiper-wrapper').css('min-height', winHei - $heder_height + 'px');
        });
    };
    /* -----------------------
     * Pie chart Animation
     * --------------------- */
    CRUMINA.pieCharts = function () {
        if ($('.pie-chart').length) {
            $('.pie-chart').each(function () {
                // $(this).waypoint(function () {
                var current_cart = $(this);
                var startColor = current_cart.data('startcolor');
                var endColor = current_cart.data('endcolor');
                var counter = current_cart.data('value') * 100;

                current_cart.circleProgress({
                    thickness: 16,
                    size: 320,
                    startAngle: -Math.PI / 4 * 2,
                    emptyFill: '#fff',
                    lineCap: 'round',
                    fill: {
                        gradient: [endColor, startColor],
                        gradientAngle: Math.PI / 4
                    }
                }).on('circle-animation-progress', function (event, progress) {
                    current_cart.find('.content').html(parseInt(counter * progress, 10) + '<span>%</span>'
                    )
                });
                // this.destroy();

                //}, {offset: '90%'});
            });
        }
    };
    /* -----------------------
     * Animate SVG Icons
     * --------------------- */
    CRUMINA.animateSvg = function () {
        if ($animatedIcons.length) {
            $animatedIcons.each(function () {
                $(this).waypoint(function () {
                    var mySVG = $(this.element).find('> svg').drawsvg();
                    mySVG.drawsvg('animate');
                    // this.destroy();
                }, {offset: '95%'});
            });
        }
    };
    CRUMINA.chartJs = function () {

        $('.chart-js-run').each(function () {
            jQuery(this).waypoint(function () {
                var $wrapper = null;

                if (typeof this === 'object' && this.hasOwnProperty('element')) {
                    $wrapper = $(this.element);
                } else {
                    $wrapper = $(this);
                }

                var el_id = $wrapper.data('id');
                var dataholder = $wrapper.find('.chart-data');
                var ctx = document.getElementById(el_id);
                var myChart = new Chart(ctx, {
                    type: $wrapper.data('type'),
                    data: {
                        labels: dataholder.data('labels'),
                        datasets: [
                            {
                                data: dataholder.data('numbers'),
                                backgroundColor: dataholder.data('colors')
                            }]
                    },
                    options: {
                        legend: {
                            display: false
                        }
                    },
                    animation: {
                        animateScale: true
                    }
                });
                if (typeof this === 'object' && this.hasOwnProperty('element')) {
                    this.destroy();
                }
            }, {offset: '75%'});
        });
    };

    CRUMINA.runchartJS = function ($wrapper) {
        var el_id = $wrapper.data('id');
        var dataholder = $wrapper.find('.chart-data');
        var ctx = document.getElementById(el_id);
        var myChart = new Chart(ctx, {
            type: $wrapper.data('type'),
            data: {
                labels: dataholder.data('labels'),
                datasets: [
                    {
                        data: dataholder.data('numbers'),
                        backgroundColor: dataholder.data('colors')
                    }]
            },
            options: {
                legend: {
                    display: false
                }
            },
            animation: {
                animateScale: true
            }
        });
    };

    CRUMINA.countdown = function () {
        if ($countdown.length) {
            $countdown.each(function () {
                var $countcontainer = $(this);
                var $countdate = $countcontainer.data('countdown');

                $countcontainer.countdown($countdate).on('update.countdown', function(event) {
                    $countcontainer.html(event.strftime(''
                        + '<div class="column"><div class="text">DAY%!d</div><div class="timer">%D</div></div><div class="timer">:</div>'
                        + '<div class="column"><div class="text">HRS</div><div class="timer">%H</div></div><div class="timer">:</div>'
                        + '<div class="column"><div class="text">MIN</div><div class="timer">%M</div></div><div class="timer">:</div>'
                        + '<div class="column"><div class="text">SEC</div><div class="timer">%S</div></div>'));
                });

            });
        }
    };

	CRUMINA.initSmoothScroll = function () {

		// Cut the mustard
		var supports = 'querySelector' in document && 'addEventListener' in window;
		if (!supports) return;

		// Get all Toggle selectors
		var anchors = $('#primary-menu a[href*=\\#], .btn[href*=\\#]').filter(function () {
			return $(this).is(":not([href=\\#])");
		});

		// Add smooth scroll to all anchors
		for (var i = 0, len = anchors.length; i < len; i++) {
			var url = new RegExp(window.location.hostname + window.location.pathname);
			if (!url.test(anchors[i].href)) continue;
			anchors[i].setAttribute('data-scroll', true);
		}

		if ( window.location.hash ) {
			var anchor = document.querySelector( window.location.hash ); // Get the anchor
			var toggle = document.querySelector( 'a[href*="' + window.location.hash + '"]' ); // Get the toggle (if one exists)
			var options = {}; // Any custom options you want to use would go here
			smoothScroll.animateScroll( anchor, toggle, options );
		}

		smoothScroll.init({
			selector: '[data-scroll]',
			speed: 500, // Integer. How fast to complete the scroll in milliseconds
			easing: 'easeOutQuad', // Easing pattern to use
			offset: $header.height(),
			updateURL: true, // Boolean. If true, update the URL hash on scroll
			callback: function (anchor, toggle) {
			} // Function to run after scrolling
		});

		$('#primary-menu').find('[href=\\#]').on('click',function () {
			return false
		})

	};



    CRUMINA.burgerAnimation = function () {
        /* In animations (to close icon) */

        var beginAC = 80,
            endAC = 320,
            beginB = 80,
            endB = 320;

        function inAC(s) {
            s.draw('80% - 240', '80%', 0.3, {
                delay: 0.1,
                callback: function () {
                    inAC2(s)
                }
            });
        }

        function inAC2(s) {
            s.draw('100% - 545', '100% - 305', 0.6, {
                easing: ease.ease('elastic-out', 1, 0.3)
            });
        }

        function inB(s) {
            s.draw(beginB - 60, endB + 60, 0.1, {
                callback: function () {
                    inB2(s)
                }
            });
        }

        function inB2(s) {
            s.draw(beginB + 120, endB - 120, 0.3, {
                easing: ease.ease('bounce-out', 1, 0.3)
            });
        }

        /* Out animations (to burger icon) */

        function outAC(s) {
            s.draw('90% - 240', '90%', 0.1, {
                easing: ease.ease('elastic-in', 1, 0.3),
                callback: function () {
                    outAC2(s)
                }
            });
        }

        function outAC2(s) {
            s.draw('20% - 240', '20%', 0.3, {
                callback: function () {
                    outAC3(s)
                }
            });
        }

        function outAC3(s) {
            s.draw(beginAC, endAC, 0.7, {
                easing: ease.ease('elastic-out', 1, 0.3)
            });
        }

        function outB(s) {
            s.draw(beginB, endB, 0.7, {
                delay: 0.1,
                easing: ease.ease('elastic-out', 2, 0.4)
            });
        }

        /* Scale functions */

        function addScale(m) {
            m.className = 'menu-icon-wrapper scaled';
        }

        function removeScale(m) {
            m.className = 'menu-icon-wrapper';
        }

        /* Awesome burger scaled */

        var pathD = document.getElementById('pathD'),
            pathE = document.getElementById('pathE'),
            pathF = document.getElementById('pathF'),
            segmentD = new Segment(pathD, beginAC, endAC),
            segmentE = new Segment(pathE, beginB, endB),
            segmentF = new Segment(pathF, beginAC, endAC),
            wrapper2 = document.getElementById('menu-icon-wrapper'),
            trigger2 = document.getElementById('menu-icon-trigger'),
            toCloseIcon2 = true;

        wrapper2.style.visibility = 'visible';

        trigger2.onclick = function () {
            addScale(wrapper2);
            if (toCloseIcon2) {
                inAC(segmentD);
                inB(segmentE);
                inAC(segmentF);
            } else {
                outAC(segmentD);
                outB(segmentE);
                outAC(segmentF);

            }
            toCloseIcon2 = !toCloseIcon2;
            setTimeout(function () {
                removeScale(wrapper2)
            }, 450);
        };
    };


    CRUMINA.quantity_selector_button_mod = function(){
        $(".quantity input[type=number]").each(function() {
            var number = jQuery(this),
                max = parseFloat( number.attr( 'max' ) ),
                min = parseFloat( number.attr( 'min' ) ),
                step = parseInt( number.attr( 'step' ), 10 ),
                newNum = $($('<div />').append(number.clone(true)).html().replace('number','text')).insertAfter(number);
            number.remove();

            setTimeout(function(){
                if(newNum.next('.quantity-plus').length == 0) {
                    var minus = jQuery('<input type="button" value="-" class="quantity-minus">').insertBefore(newNum),
                        plus    = jQuery('<input type="button" value="+" class="quantity-plus">').insertAfter(newNum);

                    minus.on('click', function(){
                        var the_val = parseInt( newNum.val(), 10 ) - step;
                        the_val = the_val < 0 ? 0 : the_val;
                        the_val = the_val < min ? min : the_val;
                        newNum.val(the_val);
                        enable_update_cart_button();
                    });
                    plus.on('click', function(){
                        var the_val = parseInt( newNum.val(), 10 ) + step;
                        the_val = the_val > max ? max : the_val;
                        newNum.val(the_val);
                        enable_update_cart_button();
                    });

                }
            },10);

        });
    };
    // since woocommerce 2.6 the update_cart button is disabeld by default and needs to be enabled if quantities change
    function enable_update_cart_button(){
        var $update_cart_button = jQuery( 'table.shop_table.cart' ).closest( 'form' ).find( 'input[name="update_cart"]' );
        if ( $update_cart_button.length ) {
            $update_cart_button.prop( 'disabled', false );
        }
    }
    // listen to updated_wc_div event since woocommerce 2.6 to redraw quantity selector and update the cart icon value
    $( document ).bind( "updated_wc_div", function() {
        //setTimeout( update_cart_sub-menu, 1000 ); // high timeout needed because the minicard is drawn after the updated_wc_div event
        CRUMINA.quantity_selector_button_mod();
    });

    /* -----------------------------
     * On Click Functions
     * ---------------------------*/


    $window.keydown(function (eventObject) {
        if (eventObject.which == 27) {
            $body.removeClass('overlay-enable');
            $('.search-standard').removeClass('open');
            $('#primary-menu').css({'visibility': 'visible'});
            $('#menu-icon-trigger').css({'opacity': '1'});
            $('.top-bar').removeClass('open');
        }
    });

    $(".overlay_search-close").on('click', function (e) {
        e.preventDefault();
        $body.removeClass('open');
        return false;
    });

    $('#top-bar-js').on('click', function (e) {
        e.preventDefault();
        $('.top-bar').addClass('open');
        return false;
    });

    $(".js-open-search-standard > *").on('click', function (e) {
        e.preventDefault();
        $('#primary-menu').find('.search-standard').addClass('open');
        $('#primary-menu').css({'visibility': 'hidden'});
        $('#menu-icon-trigger').css({'opacity': '0'});
        setTimeout(function () {
            $('#primary-menu').find('.search-input').focus()
        }, 100);
        return false;
    });

    $(".js-search-close > *").on('click', function (e) {
        e.preventDefault();
        $('#primary-menu').find('.search-standard').removeClass('open');
        $('#primary-menu').css({'visibility': 'visible'});
        $('#menu-icon-trigger').css({'opacity': '1'});
        return false;
    });

    $("#top-bar-close-js").on('click', function (e) {
        e.preventDefault();
        $('.top-bar').removeClass('open');
        return false;
    });

    $(".js-message-popup").on('click', function (e) {
        e.preventDefault();
        $('.message-popup').toggleClass('open');
        return false;
    });

	/* -----------------------------
	 * Toggle search overlay
	 * ---------------------------*/

	CRUMINA.toggleSearch = function () {
        $('.search-popup').toggleClass('open');
		$('.search-full-screen input').focus();
	};

	$(".js-open-search-popup > *").on('click', function (e) {
        e.preventDefault();
		CRUMINA.toggleSearch();
		return false;
	});

    $(".js-popup-close").on('click', function (e) {
        e.preventDefault();
            $('.search-popup').removeClass('open');
            $('.message-popup').removeClass('open');
            $('.popup-gallery').removeClass('open');
        return false;
    });

    $(".js-popup-clear-input").on('click', function () {
        $(".js-popup-clear-input").siblings("input").val("").focus();
    });


    /*---------------------------------
     ACCORDION
     -----------------------------------*/
    $('.accordion-heading').on('click', function () {
        var $wrapper = $(this).closest('.accordion-group');
        if ($wrapper.hasClass('panel-group')){
            $wrapper.find('.panel-heading').removeClass('active');
            $wrapper.find('.accordion-panel').removeClass('active');
            $(this).closest('.panel-heading').addClass('active');
            $(this).closest('.accordion-panel').addClass('active');
        } else {
            $(this).parents('.panel-heading').toggleClass('active');
            $(this).parents('.accordion-panel').toggleClass('active');
        }
    });

    //Scroll to top.
    $('.back-to-top').on('click', function () {
        $('html,body').animate({
            scrollTop: 0
        }, 1200);
        return false;
    });


    /* -----------------------------
     * On DOM ready functions
     * ---------------------------*/

    $document.ready(function () {

        jQuery(function () {

			var $hoverClass = $('.social__item.main');

			$hoverClass.hover(function () {
				$hoverClass.siblings('.share-product').addClass('open')
            });
            jQuery('.share-product').mouseleave(function () {

                jQuery('.share-product').removeClass('open')

            });
        });

        $('.post.post_format-post-format-video').fitVids();


		$('.js-pricing-switcher').on('click', function () {

			var $is_year = $(this).prev().is(':checked');
			var $section = $(this).closest('.crumina-pricings');
			var $price = $section.find('.price');

			$price.each(function () {

				if ($is_year) {
					var valueAnnually = $(this).data('monthly');
					$(this).text(valueAnnually);
					$(this).parent().siblings('.period-annually').show();
                    $(this).parent().siblings('.period-monthly').hide();
				}
				else {
					var valueMonthly = $(this).data('annually');
					$(this).text(valueMonthly);
                    $(this).parent().siblings('.period-annually').hide();
                    $(this).parent().siblings('.period-monthly').show();
				}
			});
		});

        $("#top-bar-language").on('change', function () {
            var lang_href = jQuery(jQuery(this).children('[value=' + $(this).val() + ']')).data('url');
            if (lang_href) {
                document.location.href = lang_href;
            }
        });

        if ($('#menu-icon-wrapper').length) {
            CRUMINA.burgerAnimation();
        }
        // 3-d party libs run
        $primary_menu.crumegamenu({
            showSpeed: 0,
            hideSpeed: 0,
            trigger: "hover",
            animation: $primary_menu.data('dropdown-animation'),
            indicatorFirstLevel: "&#xf0d7",
            indicatorSecondLevel: "&#xf105"
        });

        if ($('.fw_form_fw_form').length) {
            fwForm.initAjaxSubmit({
                selector: 'form[data-fw-ext-forms-type="contact-forms"]'
            });
        }


        CRUMINA.fixedHeader();
        CRUMINA.initSwiper();
        CRUMINA.equalHeight();
        CRUMINA.mediaPopups();
        CRUMINA.IsotopeSort();
        CRUMINA.parallaxFooter();
        CRUMINA.quantity_selector_button_mod();
		CRUMINA.initSmoothScroll();


        // Dom mofifications
        $('.nice-select').niceSelect();
        $('select.orderby, .variations select, .card-expiration select').niceSelect();

        CRUMINA.preloader();

        CRUMINA.countdown();

        // On Scroll animations.

        CRUMINA.counters();
        CRUMINA.progresBars();
        CRUMINA.pieCharts();
        CRUMINA.chartJs();
    });
})(jQuery);
