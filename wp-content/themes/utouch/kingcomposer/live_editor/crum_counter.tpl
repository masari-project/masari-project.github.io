<#

        if( data === undefined )
        data = {};

        var atts = ( data.atts !== undefined ) ? data.atts : {},
        delim_html = '',
        icon_html = '',
        label_html = '',
        units_html = '',
        label    = kc.std(atts,'label','Counter title'),
        number    = kc.std(atts,'number',100),
        units    = kc.std(atts,'units',''),
        custom_class = kc.std(atts,'wrap_class',''),
        wrap_class = {},
        wrap_class  = kc.front.el_class( atts );

        wrap_class.push( 'crumina-module' );
        wrap_class.push( 'crumina-counter-item' );
        wrap_class.push( custom_class );


        if( label.length ){
            label_html = '<h5 class="counter-title">' + label + '</h5>';
        }
        if( units.length ){
            units_html = '<div class="units">' + units + '</div>';
        }
        data.callback = function(wrp, $){
            wrp.find('span').countTo();
        }
#>

<div class="{{wrap_class.join(' ')}}">
    <div class="counter-numbers counter">
        <span data-speed="2000" data-refresh-interval="3" data-to="{{number}}" data-from="0"></span>
        {{{units_html}}}
    </div>
    {{{label_html}}}
</div>