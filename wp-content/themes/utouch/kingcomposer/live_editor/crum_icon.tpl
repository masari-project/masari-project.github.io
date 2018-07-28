<#
        var atts            = ( data.atts !== undefined ) ? data.atts : {},
        wrap_class        = [],
        icon_link_attr        = [],
        title_html = '',
        has_link = false,
        title    = ( atts['title'] !== undefined ) ? atts['title'] : '',
        icon    = ( atts['icon'] !== undefined ) ? atts['icon'] : '',
        use_link    = ( atts['use_link'] !== undefined ) ? atts['use_link'] : '',
        use_link    = ( atts['link'] !== undefined ) ? atts['link'] : '',
        custom_class    = ( atts['custom_class'] !== undefined ) ? atts['custom_class'] : '';
        wrap_class        = kc.front.el_class( atts );

        wrap_class.push('crumina-module');
        wrap_class.push('crum-icon-module');

        if ( custom_class !== '' ){
        wrap_class.push( custom_class );
        }
        if (title !== ''){
        title_html = '<span class="h4 module-title">' + title + '</span>';
}
if( use_link == 'yes' ){
link = link.split('|');

if( link[0] !== undefined ){
icon_link_attr.push( 'href="' + link[0] + '"' );
has_link = true;
}

if( link[1] !== undefined )
icon_link_attr.push( 'title="' + link[1] + '"' );

if( link[2] !== undefined )
icon_link_attr.push( 'target="' + link[2] + '"' );
}
#>

<div class="{{{wrap_class.join(' ')}}}">
    <# if( has_link === true ){ #>
        <a {{{icon_link_attr.join(' ')}}}>
            <# } #>
                <span class="utouch-icon"><i class="{{icon}}"></i></span>
                {{{title_html}}}
                <# if( has_link === true ){ #>
        </a>
        <# } #>
</div>

