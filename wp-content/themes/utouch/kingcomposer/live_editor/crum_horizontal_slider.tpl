<#

        if( data === undefined )
        data = {};

        var atts            = ( data.atts !== undefined ) ? data.atts : {},
        el_classess        = kc.front.el_class( atts );

        #>
    <div class="{{{el_classess.join(' ')}}}">
        <div style="width: 100%;">
            <h1 class=" heading-title">Not available to edit on frontend</h1>
            <div class="heading-decoration"><span class="first"></span><span class="second"></span></div>
            <h5>For best performance, the Module has been disabled in frontend editing mode. Please
                use Backend editor</h5>
        </div>
    </div>
