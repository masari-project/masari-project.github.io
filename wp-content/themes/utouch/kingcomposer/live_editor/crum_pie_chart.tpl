<#

        if( data === undefined )
        data = {};

        var atts                = ( data.atts !== undefined ) ? data.atts : {},

        startcolor            = '#3b8d8c',
        endcolor            = '#4cc3c1',
        percent            = 50,
        icon_option = '',
        title                = '',
        description        = '',
        link ='',
        data_button= '',
        content_html = '',
        wrap_class            = '',
        tmp_class            = '',
        element_attributes    = [],
        css_classes        = [ 'crumina-module', 'crumina-pie-chart-item' ],
        icon                = 'et-layers';

        wrap_class  = kc.front.el_class( atts );
        wrap_class.push( 'pie-chart-item' );

        if( atts['title'] !== undefined && atts['title'] !== '' )
        title = '<h4 class="pie-chart-content-title">' + atts['title'] + '</h4>';

if( atts['icon'] !== undefined && atts['icon'] !== '' )
icon = atts['icon'];

if( atts['icon_option'] !== undefined && atts['icon_option'] !== '' )
icon_option = atts['icon_option'];

if( atts['description'] !== undefined && atts['description'] !== '' )
description = '<div class="pie-chart-content-text">' + kc.tools.base64.decode( atts['description'] ) + '</div>';

if( atts['percent'] !== undefined && atts['percent'] !== '' ){
percent = atts['percent'].replace(/\D/g,'');
percent = percent / 100;
}

link = ( atts['link'] !== undefined )? atts['link'] : '||';

if( atts['startcolor'] !== undefined && atts['startcolor'] !== '' )
startcolor = atts['startcolor'];

if( atts['endcolor'] !== undefined && atts['endcolor'] !== '' )
endcolor = atts['endcolor'];

if ( link !== '' ) {
link_arr = link.split('|');
}
if ( link_arr[0] !== undefined ){
link_url = link_arr[0];
button_text = link_arr[1];

data_button += '<a class="more" href="' + link_url + '">' + button_text + '<i class="seoicon-right-arrow"></i></a>';
}
if( icon_option == 'yes' ){
content_html = '<div class="utouch-icon"><i class="' + icon + ' pie_chart_icon"></i></div>';
} else {
content_html = '<div class="content"><span>%</span></div>';
}

element_attributes.push( 'data-value="' + percent + '"' );
element_attributes.push( 'data-startcolor="' + startcolor + '"' );
element_attributes.push( 'data-endcolor="' + endcolor + '"' );
element_attributes.push( 'class="' + css_classes.join(' ') + '"' );
#>

<div class="{{wrap_class.join(' ')}}">
    <div class="pie-chart" {{{element_attributes.join(' ')}}} >
        {{{content_html}}}
    </div>
    <div class="pie-chart-content">
        {{{title}}}
        {{{description}}}
        {{{data_button}}}
    </div>
</div>
<# data.callback = function( wrp, $ ){
        CRUMINA.pieCharts();
} #>
