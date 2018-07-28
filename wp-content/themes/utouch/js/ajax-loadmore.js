jQuery(function($){
    $('.custom_loadmore').on('click',function(){
        var button = $(this),
            data = {
                'action': 'loadmore',
                'query': utouch_loadmore_params.posts, // that's how we get params from wp_localize_script() function
                'page' : utouch_loadmore_params.current_page
            };
        var more_text = button.find('.load-more-text').text(),
            loading_text = button.data('loading-text'),
            posts_container_id = utouch_loadmore_params.container_id,
            $container = $(posts_container_id),
            container_has_isotope = $container.hasClass('sorting-container');

        if (($container.length === 0)) {
            $container = button.prev();
        }

        $.ajax({
            url : utouch_loadmore_params.ajaxurl, // AJAX handler
            data : data,
            type : 'POST',
            beforeSend : function ( xhr ) {
                button.find('.load-more-text').text(loading_text); // change the button text, you can also add a preloader image
            },
            success : function( data ){
                if( data ) {
                   if (container_has_isotope){
                        $container.append( data ).isotope( 'appended', data );
                        $container.imagesLoaded(function () {
                            $container.isotope('layout');
                        });
                    } else {
                        $container.append( data );
                    }

                    button.find('.load-more-text').text( more_text ); // insert new posts
                    utouch_loadmore_params.current_page++;

                    if ( utouch_loadmore_params.current_page == utouch_loadmore_params.max_page ){
                        button.remove(); // if last page, remove the button
                    }
                } else {
                    button.remove(); // if no data, remove the button as well
                }
                return false;
            }
        });
        return false;
    });
});