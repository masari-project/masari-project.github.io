/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
    var
        $content_wrapper = $('.content-wrapper'),
        $stunning = $('#stunning-section'),
        $header_style = {
            1: '',
            2: 'header--menu-rounded',
            3: 'header--small-lines'
        },
        selective_refresh_stunning_header = [
            'fw_options[stunning-show]',
            'fw_options[stunning_bg_options]',
            'fw_options[stunning_overlay_color]',
            'fw_options[stunning_title]',
            'fw_options[stunning_category]',
            'fw_options[stunning_breadcrumbs]',
            'fw_options[stunning_author]',
            'fw_options[stunning_additional]'
        ],
        selective_refresh_header = [
            'fw_options[sections-top-bar]',
            'fw_options[decorative-line]',
            'fw_options[sticky_header]',
            'fw_options[logo-image]',
            'fw_options[logo-retina]',
            'fw_options[search-icon]',
        ],
        selective_refresh_footer = [
            'fw_options[site-description]',
        ];

    // Header options.

    wp.customize('fw_options[header_bg_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('#site-header').css('background', newval[0].value);
        });
    });
    wp.customize('fw_options[header-text-color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('#site-header').css('color', newval[0].value);
            $('#site-header').css('fill', newval[0].value);
        });
    });
    wp.customize('fw_options[dropdown-style]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            console.log(newval);
            for (var type in $header_style) {
                $('#site-header').removeClass($header_style[type]);
            }

            $('#site-header').addClass($header_style[newval[0].value]);

            if (newval.length > 1)
                $('.utouch .header--menu-rounded .primary-menu-menu > li > a').hover(function () {
                    $(this).css('background-color', newval[1].value);
                }, function () {
                    $(this).css('background-color', '');
                });
        });
    });
    wp.customize('fw_options[logo-title]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('.logo-title').text(newval[0].value);
        });
    });
    wp.customize('fw_options[logo-subtitle]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('.logo-sub-title').text(newval[0].value);
        });
    });

    wp.customize('fw_options[stunning_text_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('#stunning-section').css('color', newval[0].value);
        });
    });
    wp.customize('fw_options[stunning_link_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('#stunning-section').find('.category-link').css('color', newval[0].value);
        });
    });


    wp.customize('fw_options[stunning_background_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('#stunning-section').css('background-color', newval[0].value);
        });
    });

    wp.customize('fw_options[footer_text_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('#site-footer').css('color', newval[0].value);
        });
    });

    wp.customize('fw_options[footer_title_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('#site-footer .widget .widget-title,#site-footer > .container a:not(.btn), #site-footer a.social__item svg, #site-footer .w-list ul.list, #site-footer .widget_nav_menu ul.list').css('color', newval[0].value).css('fill',newval[0].value);
        });
    });

    wp.customize('fw_options[footer_bg_image]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            if (newval[0].value == 'custom') {
                $('#site-footer').css({'backgroundImage': 'url(' + newval[3].value + ')'});
            } else {
                var templateUrl = theme_vars.templateUrl;
                $('#site-footer').css({'backgroundImage': 'url(' + templateUrl + '/images/thumb/' + newval[1].value + '.png)'});
            }
        });
    });
    wp.customize('fw_options[footer_bg_cover]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            if (newval[0].value == 'true') {
                $('#site-footer').css({'backgroundSize': 'cover'});
            } else {
                $('#site-footer').css({'backgroundSize': 'inherit'});
            }
        });
    });
    wp.customize('fw_options[footer_bg_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('#site-footer').css({'backgroundColor': newval[0].value});
        });
    });

    /*Copyright customize*/
    wp.customize('fw_options[footer_copyright]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('.site-copyright-text').html(newval[0].value);
        });
    });

    wp.customize('fw_options[copyright_bg_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('.sub-footer').css({'backgroundColor': newval[0].value});
        });
    });
    wp.customize('fw_options[copyright_text_color]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            $('.site-copyright-text').css('color', newval[0].value);
        });
    });
    wp.customize('fw_options[scroll_top_icon]', function (value) {
        value.bind(function (newval) {
            newval = JSON.parse(newval);
            var $button = $('.back-to-top');
            console.log(newval);
            if (newval[1].value == 'true') {
                $button.addClass('back-to-top-fixed');
            } else {
                $button.removeClass('back-to-top-fixed');
            }
        });
    });



    if (typeof wp.customize.selectiveRefresh !== 'undefined') {
        wp.customize.selectiveRefresh.bind('partial-content-rendered', function (placement) {
            if ('#stunning-section' === placement.partial.params.selector) {
                [].slice.call(document.querySelectorAll('img.utouch-tilt-effect')).forEach(function (img) {
                    new TiltFx(img, JSON.parse(img.getAttribute('data-tilt-options')));
                });
            }
            var $header = $('#site-header');
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
                        if ($('#primary-menu').find('.sub-menu, .megamenu').hasClass('drop-up')) {
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
        });

        wp.customize.selectiveRefresh.bind('render-partials-response', function (placement) {
            // remove breadcrmbs for header style 0
            var flag = false;
            for (var i in selective_refresh_stunning_header) {
                if (typeof placement['contents'][selective_refresh_stunning_header[i]] != 'undefined') {
                    flag = true;
                    break;
                }
            }
            if (flag) {
                $breadcrumbs = $content_wrapper.children('#breadcrumbs-section');
                $breadcrumbs.remove();
            }

            //header
            flag = false;
            for (var i in selective_refresh_header) {
                if (typeof placement['contents'][selective_refresh_header[i]] != 'undefined') {
                    flag = true;
                    break;
                }
            }
            if (flag) {
                $('#header-spacer').remove();
                $('.search-popup').remove();
                $('#header-customize-css').remove();
            }

            //header
            flag = false;
            for (var i in selective_refresh_footer) {
                if (typeof placement['contents'][selective_refresh_footer[i]] != 'undefined') {
                    flag = true;
                    break;
                }
            }
            if (flag) {
                $('.window-popup.message-popup').remove();
                $('#footer-customize-css').remove();
            }
        });
    }

    ////

})(jQuery);


//console.log(newval);