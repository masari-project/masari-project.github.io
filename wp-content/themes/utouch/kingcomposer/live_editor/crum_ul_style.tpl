<#
        var atts        = ( data.atts !== undefined ) ? data.atts : {},
        wrap_class      = [],
        desc            = ( atts['desc'] !== undefined ) ? kc.tools.base64.decode( atts['desc'] ) : '',
        list_icon       = ( atts['list_icon'] !== undefined ) ? atts['list_icon'] : '',
        icon            = ( atts['icon'] !== undefined ) ? atts['icon'] : '',
        custom_class    = ( atts['custom_class'] !== undefined ) ? atts['custom_class'] : '';

        wrap_class        = kc.front.el_class( atts );

        wrap_class.push('crumina-module');
        wrap_class.push('crumina-module-list');
        wrap_class.push( custom_class );

        var prepend = '';
        if( 'check' === list_icon){
            prepend = '<svg class="utouch-icon utouch-icon-correct-symbol-1"><use xlink:href="#utouch-icon-correct-symbol-1"></use></svg>';
        } else if('check_circle' === list_icon){
            prepend = '<svg class="utouch-icon utouch-icon-checked"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#utouch-icon-checked"></use></svg>';
        }else if('custom' === list_icon) {
            prepend = '<i class="utouch-icon '+icon+'"></i>';
        }
        data.callback = function( wrp, $ ){
            var prepend_html = wrp.children('.prepend').html();
            wrp.find('li').wrapInner('<div class="ovh"></div>').prepend(prepend_html);
            wrp.children('.prepend').remove();
        }
#>
<div class="{{{wrap_class.join(' ')}}}" data-icon="{{icon}}">
    <div class="prepend">{{{prepend}}}</div>
    {{{desc}}}
</div>

