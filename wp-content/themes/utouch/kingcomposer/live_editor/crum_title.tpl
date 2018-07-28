<#
		var  is_empty_attr = function(array_or_object,key){
		return array_or_object[key] === undefined || array_or_object[key] == '';
		},
		atts = ( data.atts !== undefined ) ? data.atts : {},
		type = is_empty_attr(atts,'type') ? 'h1' : atts['type'],
		align = is_empty_attr(atts,'align') ? 'align-center' : atts['align'],
		classes = is_empty_attr(atts,'class') ? '' : atts['class'],
		title = 'yes' === atts['post_title'] ? kc_post_title : (is_empty_attr(atts,'the_title') ? 'The Title' : atts['the_title']),
		title_class = ' heading-title ',
		title_attr = [],
		link = is_empty_attr(atts,'link') ? '' : atts['link'],
		wrap_class = [],
		top_label_html = '',
		subtitle_html = '';

		if('yes' === atts['show_link']){
			title_class = title_class + type;
			type = 'a';

			if ( link.length ) {
				link_arr = link.split('|');

				if( link_arr[0].length ){
					title_attr.push( 'href="' + link_arr[0] + '"' );
				}

				if( link_arr[2].length ){
					title_attr.push( 'target="' + link_arr[2] + '"' );
				}
			}

		}

		title_attr.push('class="'+title_class+'"');
		console.log(title_attr.join(' '));
		wrap_class  = kc.front.el_class( atts );
		wrap_class.push( 'crumina-module' );
		wrap_class.push( 'crumina-heading' );
		wrap_class.push( align );
		wrap_class.push( classes );

		if(!is_empty_attr(atts,'top_label')){
			top_label_html = '<h6 class="heading-sup-title">'+atts['top_label']+'</h6>';
		}
		if(!is_empty_attr(atts,'subtitle')){
			subtitle_html = '<div class="heading-text">'+kc.tools.base64.decode(atts['subtitle'])+'</div>';
		}

#>
<div class="{{wrap_class.join(' ')}}">
	{{{top_label_html}}}
	<{{type}} {{{title_attr.join(' ')}}}>{{title}}</{{type}}>
	{{{subtitle_html}}}
</div>
