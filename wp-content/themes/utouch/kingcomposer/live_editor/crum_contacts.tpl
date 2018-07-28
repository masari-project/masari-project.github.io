<#
        var  is_empty_attr = function(array_or_object,key){
        return array_or_object[key] === undefined || array_or_object[key] == '';
        };

        var atts            = ( data.atts !== undefined ) ? data.atts : {},
        wrap_class        = [],
        icon_link_attr        = [],
        title_html = '',
        subtitle_html = '',
        image_html = '',
        img_size = 'thumbnail',
        title    = ( atts['title'] !== undefined ) ? atts['title'] : '',
        subtitle    = ( atts['subtitle'] !== undefined ) ? atts['subtitle'] : '',
        image    = ( atts['image'] !== undefined ) ? atts['image'] : '',
        link    = ( atts['link'] !== undefined ) ? atts['link'] : '',
        custom_class    = ( atts['custom_class'] !== undefined ) ? atts['custom_class'] : '';
        wrap_class        = kc.front.el_class( atts );

        wrap_class.push('crumina-module');
        wrap_class.push('contacts-item');

        if ( custom_class !== '' ){
        wrap_class.push( custom_class );
        }

        if( link != '' ){
            link = link.split('|');
            icon_link_attr.push( 'class="h5 title"' );
             if( link[0] !== undefined ){
                 icon_link_attr.push( 'href="' + link[0] + '"' );
                 has_link = true;
             }

             if( link[1] !== undefined )
                icon_link_attr.push( 'title="' + link[1] + '"' );

             if( link[2] !== undefined )
                 icon_link_attr.push( 'target="' + link[2] + '"' );
        }
        if ( title !== '' ){
             if (has_link === true){
                title_html = '<a ' + icon_link_attr.join(' ') + '>' + title + '</a>';
            } else{
                  title_html = '<span class="h5 title">' + title + '</span>';
            }
        }
        if (subtitle !== ''){
            subtitle_html =  '<div class="sub-title">' + subtitle + '</div>';
        }
if ( image > 0 ) {
image = image.replace( /[^\d]/, '' );
img_link = ajaxurl + '?action=kc_get_thumbn&size=' + img_size + '&id=' + image;
image_html = '<div class="utouch-icon"><img src="' + img_link + '" alt=""/></div>';
}
#>
<div class="{{wrap_class.join(' ')}}">
    {{{image_html}}}
    <div class="content">
        {{{title_html}}}
        {{{subtitle_html}}}
    </div>
</div>
