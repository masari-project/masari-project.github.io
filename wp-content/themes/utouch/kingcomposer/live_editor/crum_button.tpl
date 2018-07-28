<#
		var  is_empty_attr = function(array_or_object,key){
		return array_or_object[key] === undefined || array_or_object[key] == '';
		};

		if( data === undefined )
		data = {};

		var atts                = ( data.atts !== undefined ) ? data.atts : {},
		type                = kc.std( atts, 'type', 'regular'),
		textbutton            = kc.std( atts, 'label', 'Button Text'),
		link                = kc.std( atts, 'link', '#'),
		onclick            = kc.std( atts, 'onclick', ''),
		wrap_class            = kc.std( atts, 'wrap_class', ''),
		size                = kc.std( atts, 'size', 'medium'),
		align                = kc.std( atts, 'align', 'none'),
		color                = kc.std( atts, 'color', 'primary'),
		shadow                = kc.std( atts, 'shadow', 'no'),
		outlined            = kc.std( atts, 'outlined', 'no'),
		show_icon            = kc.std( atts, 'show_icon', 'no'),
		icon                = kc.std( atts, 'icon', 'fa-leaf'),
		icon_position        = kc.std( atts, 'icon_position', 'left'),
		el_class        = kc.std( atts, 'el_class', ''),
		button_attributes    = [],
		button_class = [],
		wrapper_class        = [];

		link = link.split('|');

		wrapper_class = kc.front.el_class( atts );
		wrapper_class.push( 'crumina-module' );
		wrapper_class.push( 'crum-button' );
		wrapper_class.push( 'el_class' );

		if('none' === align){
			wrapper_class.push('inline-block');
		}else{
			wrapper_class.push(align);
		}

		if( 'regular' === type ) {
			button_class.push('btn');
			button_class.push('btn-' + size);
			button_class.push('btn--' + color);
			if( 'yes' === shadow ) {
				button_class.push('btn--with-shadow');
			}
			if( 'yes' === outlined ){
				button_class.push('btn-border');
			}
			if( 'yes' === show_icon ) {
				button_class.push('btn--with-icon');
				if( 'right' === icon_position ) {
					button_class.push('btn--icon-right');
				}
			}
			if( link[2] !== undefined && '_blank' === link[2] ) {
				button_class.push('btn--with-icon');
				button_class.push('btn--icon-right');
			}
		} else {
			button_class.push('btn');
			button_class.push('btn-market');
			if( 'yes' === shadow ) {
				button_class.push('btn--with-shadow');
			}
		}

		button_attributes.push( 'class="' + button_class.join(' ') + '"' );
		if( link[0] !== undefined )
		button_attributes.push( 'href="' + link[0] + '"' );

		if( link[1] !== undefined )
		button_attributes.push( 'title="' + link[1] + '"' );

		if( link[2] !== undefined )
		button_attributes.push( 'target="' + link[2] + '"' );

		if( onclick !== undefined && onclick !== '')
		button_attributes.push( 'onclick="' + onclick + '"' );


#>
<div class="{{{wrapper_class.join(' ')}}}">
	<#
		if('app-store' === type) {
			#>
		<a {{{button_attributes.join(' ')}}}>
			<img class="utouch-icon" src="{{{kc_site_url + '/wp-content/themes/utouch/'}}}/svg/apple-logotype.svg"
				 alt="apple">
			<div class="text">
				<span class="sup-title">Download on the</span>
				<span class="title">App Store</span>
			</div>
		</a>
		<#
		}else if('google-play' === type) {
		#>
			<a {{{button_attributes.join(' ')}}}>
				<img class="utouch-icon" src="{{{kc_site_url + '/wp-content/themes/utouch/'}}}/svg/google-play.svg"
					 alt="google">
				<div class="text">
					<span class="sup-title">Download on the</span>
					<span class="title">Google Play</span>
				</div>
			</a>
		<#
		}else{
			var html = '';
			if('yes' === show_icon){
				html = html +  '<i class="utouch-icon ' + icon + '"></i>';
			}
			if ( link[2] !== undefined && '_blank' === link[2] ) {
				html = html + '<svg class="utouch-icon utouch-icon-arrow-right1"><use xlink:href="#utouch-icon-arrow-right1"></use></svg>';
			}
			html = html + '<span class="text">' + textbutton + '</span>';
	#>
		<a {{{button_attributes.join(' ')}}}>
			{{{html}}}
		</a>
	<#
		}
	#>
</div>
