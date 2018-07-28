<#
        var output                = '',
        element_attributes    = [], el_classes = [ ],
        atts                = ( data.atts !== undefined ) ? data.atts : {},

        speed                = 2000,
        margin                = 20,
        progress_bar_color_default = '#999999',
        value_color_style    = '',
        css    = '',
        wrap_class = ( atts['wrap_class'] !== undefined ) ? atts['wrap_class'] : '',

        el_classes = kc.front.el_class( atts );
        el_classes.push( 'crumina-module' );
        el_classes.push( 'skills' );

        try{
        var options = JSON.parse( kc.tools.base64.decode( atts['options'] ).toString().replace( /\%SITE\_URL\%/g, kc_site_url ) );
        }catch(ex){
        var options = atts['options'];
        }

        output = output + '<div class="' + el_classes.join(' ') + '">';
output = output + '<div class="' + wrap_class + '">';

    if( options !== null ){
    for( var n in options ){

    var value = ( options[n]['value'] !== undefined && options[n]['value'] !== '' ) ? options[n]['value'] : 50,
    label = ( options[n]['label'] !== undefined && options[n]['label'] !== '' ) ? options[n]['label'] : 'Label default',
    prob_color = ( options[n]['prob_color'] !== undefined && options[n]['prob_color'] !== '' ) ?
    options[n]['prob_color'] : '',
    prob_style = '',
    value_color_style = '';


    if( prob_color != ''){
    prob_style += 'background-color: '+prob_color+';';
    prob_style += 'border-color: '+prob_color+';';
    }

    prob_style += 'width: '+value+'%';

    if( options[n]['value_color'] !== undefined && options[n]['value_color'] !== '' ){
    value_color_style = ' style="color: '+options[n]['value_color']+'"';
    }

    prob_track_attributes = [];
    prob_attributes = [];

    //Progress bars track attributes
    prob_track_css_classes = [
    'skills-item-meter-active',
    'bg-primary-color border-primary-color',

    ];
    //Progress bars attributes

    prob_attributes.push( 'class="'+prob_track_css_classes.join(' ')+'"' );
    prob_attributes.push( 'style="'+prob_style+'"' );

    output +='<div class="skills-item">';
        output += '<div class="skills-item-info">';
            output += '<span class="skills-item-title">'+label+'</span>';
            output += '<span class="skills-item-count">';
					output += '<span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="'+value+'" data-from="0">'+value+'</span><span class="units" '+value_color_style+'>%</span></span>';
            output += '</div>';
        output += '<div class="skills-item-meter">';
            output += '<span '+prob_attributes.join(' ')+'></span>';
            output += '</div>';
        output += '</div>';
    }
    }

    output += '</div>';
output += '</div>';

data.callback = function( wrp, $ ){
    wrp.find('skills-item').each(function(){
$(this).find('.count-animate').countTo();
$(this).find('.skills-item-meter-active').fadeTo(300, 1).addClass('skills-animate');
});
} #>

{{{output}}}