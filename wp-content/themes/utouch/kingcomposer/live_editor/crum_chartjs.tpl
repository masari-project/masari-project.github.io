<#
        if (data === undefined)
        data = {};

        var output = '';
        var atts = ( data.atts !== undefined ) ? data.atts : {},
        chart_type = '',
        _id = '',
        hide_labels = '';
        var options = [],
        js_data_number = [],
        js_data_label = [],
        js_data_color = [];

        var element_attributes = [];
        var wrapper_class = kc.front.el_class(atts);
        wrapper_class.push('crumina-module');
        wrapper_class.push('chart-js');

        if (atts['chart_type'] !== '')
        chart_type = atts['chart_type']

        if (atts['_id'] !== '')
        random_id = 'js_chart_module_' + atts['_id']

        if (atts['hide_labels'] !== '')
        hide_labels = atts['hide_labels']

        try{
        var options = JSON.parse( kc.tools.base64.decode( atts['options'] ).toString().replace( /\%SITE\_URL\%/g, kc_site_url ) );
        } catch(ex){
        var options = atts['options'];
        }
        #>

    <div class="{{wrapper_class.join(' ')}}" data-id="{{random_id}}" data-type="{{chart_type}}">
        <canvas id="{{random_id}}" width="1000" height="1000"></canvas>
        <div class="points">
            <# if( options !== null ){
                    for( var n in options ){
                    var value = ( options[n]['value'] !== undefined && options[n]['value'] !== '' ) ? options[n]['value'] : 50,
                    label = ( options[n]['label'] !== undefined && options[n]['label'] !== '' ) ? options[n]['label'] : 'Label default',
                    prob_color = ( options[n]['prob_color'] !== undefined && options[n]['prob_color'] !== '' ) ? options[n]['prob_color'] : '',
                    prob_style = '',
                    value_color_style = '';

                    if( prob_color != '') {
                        prob_style += 'background-color: '+prob_color+';';
                    }

                    js_data_number.push( '"' + value + '"' );
                    js_data_label.push( '"' + label + '"' );
                    js_data_color.push( '"' + prob_color + '"' );

                    prob_attributes = [];

                    //Progress bars track attributes
                    prob_css_classes = ['point-sircle','bg-primary-color'];

                    var prob_css_class = prob_css_classes.join(' ');
                    prob_attributes.push( 'class="'+prob_css_class+'"' );
                    prob_attributes.push( 'style="'+prob_style+'"' );

                    if( hide_labels != 'yes' ){
                    #>
                <div class="points-item">
                    <div class="points-item-count">
                        <span {{{prob_attributes.join(' ')}}} ></span>{{value}}
                        <span class="c-gray"> - {{label}}</span>
                    </div>
                </div>
                <# } } }#>
        </div>
        <div class="chart-data" data-labels='[{{js_data_label.join(',')}}]'
             data-numbers='[{{js_data_number.join(',')}}]'
             data-colors='[{{js_data_color.join(',')}}]'></div>
    </div>
    <# data.callback = function( wrp, $){
            var el_id = wrp.data('id');
            var dataholder = wrp.find('.chart-data');
            var ctx = document.getElementById(el_id);
            var myChart = new Chart(ctx, {
            type: wrp.data('type'),
            data: {
            labels: dataholder.data('labels'),
            datasets: [{ data: dataholder.data('numbers'), backgroundColor: dataholder.data('colors') }]
            },
            options: { legend: {display: false } },
            animation: { animateScale: false }
            });
            } #>