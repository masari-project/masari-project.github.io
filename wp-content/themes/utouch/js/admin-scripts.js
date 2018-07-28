if (window.Backbone && typeof(window.Backbone.sync) === 'function') {
    var myWidgets = {};

    /******************************
     * Contacts add to widget
     ******************************/
// Model for a single contact
    myWidgets.Contact = Backbone.Model.extend({
        defaults: {'icon': '', 'value': '', 'desc': ''}
    });

// Single view, responsible for rendering and manipulation of each single contact
    myWidgets.ContactView = Backbone.View.extend({
        className: 'contacts-widget-child',
        events: {
            'click .js-remove-contact': 'destroy'
        },

        initialize: function (params) {
            this.template = params.template;
            this.model.on('change', this.render, this);
            return this;
        },

        render: function () {
            this.$el.html(this.template(this.model.attributes));
            return this;
        },

        destroy: function (ev) {
            ev.preventDefault();
            this.remove();
            this.model.trigger('destroy');

        }
    });

// The list view, responsible for manipulating the array of contacts
    myWidgets.ContactsView = Backbone.View.extend({

        events: {
            'click #js-contact-add': 'addNew'
        },

        initialize: function (params) {
            this.widgetId = params.id;
            // cached reference to the element in the DOM
            this.$contacts = this.$('#js-contacts-list');
            // collection of contacts, local to each instance of myWidgets.contactsView
            this.contacts = new Backbone.Collection([], {
                model: myWidgets.Contact
            });
            // listen to adding of the new contacts
            this.listenTo(this.contacts, 'add', this.appendOne);
            return this;
        },

        addNew: function (ev) {
            ev.preventDefault();
            // default, if there is no contacts added yet
            var contactId = 0;
            if (!this.contacts.isEmpty()) {
                var contactsWithMaxId = this.contacts.max(function (contact) {
                    return contact.id;
                });
                contactId = parseInt(contactsWithMaxId.id, 10) + 1;
            }
            var model = myWidgets.Contact;
            this.contacts.add(new model({id: contactId}));
            return this;
        },

        appendOne: function (contact) {
            var renderedContact = new myWidgets.ContactView({
                model: contact,
                template: _.template(jQuery('#js-contact-' + this.widgetId).html())
            }).render();
            this.$contacts.append(renderedContact.el);
            return this;
        }
    });


    myWidgets.repopulateContacts = function (id, JSON) {
        var contactsView = new myWidgets.ContactsView({
            id: id,
            el: '#js-contacts-' + id
        });
        contactsView.contacts.add(JSON);
    };

    /******************************
    * Social networks add to widget
    ******************************/

// Model for a single social
    myWidgets.Social = Backbone.Model.extend({
        defaults: {'network': '', 'name': '', 'link': '','txt': ''}
    });

// Single view, responsible for rendering and manipulation of each single social
    myWidgets.SocialView = Backbone.View.extend({
        className: 'social-widget-child',
        events: {
            'click .js-remove-social': 'destroy'
        },
        initialize: function (params) {
            this.template = params.template;
            this.model.on('change', this.render, this);
            return this;
        },

        render: function () {
            this.$el.html(this.template(this.model.attributes));
            return this;
        },

        destroy: function (ev) {
            ev.preventDefault();
            this.remove();
            this.model.trigger('destroy');
        }
    });

// The list view, responsible for manipulating the array of socials
    myWidgets.SocialsView = Backbone.View.extend({

        events: {
            'click #js-socials-add': 'addNew'
        },

        initialize: function (params) {
            this.widgetId = params.id;
            // cached reference to the element in the DOM
            this.$socials = this.$('#js-socials-list');
            // collection of socials, local to each instance of myWidgets.socialsView
            this.socials = new Backbone.Collection([], {
                model: myWidgets.Social
            });
            // listen to adding of the new socials
            this.listenTo(this.socials, 'add', this.appendOne);
            return this;
        },

        addNew: function (ev) {

            ev.preventDefault();

            // default, if there is no socials added yet
            var socialId = 0;

            if (!this.socials.isEmpty()) {
                var socialsWithMaxId = this.socials.max(function (social) {
                    return social.id;
                });

                socialId = parseInt(socialsWithMaxId.id, 10) + 1;
            }
            var model = myWidgets.Social;
            this.socials.add(new model({id: socialId}));
            return this;
        },

        appendOne: function (social) {
            var renderedSocial = new myWidgets.SocialView({
                model: social,
                template: _.template(jQuery('#js-social-' + this.widgetId).html())
            }).render();
            this.$socials.append(renderedSocial.el);
            return this;
        }
    });
    myWidgets.repopulateSocials = function (id, JSON) {

        var socialsView = new myWidgets.SocialsView({
            id: id,
            el: '#js-socials-' + id
        });
        socialsView.socials.add(JSON);
    };
}

function utouch_button_title(button){

    return 'regular' ==  button.style ? button.regular.label : button.style;
}
jQuery(document).ready(function ($) {
    console.log(typeof(fwEvents));
    if(typeof(fwEvents) !== 'undefined'){
        fwEvents.on('fw:options:datetime-range:before-init',function(data){data.el.find('input[readonly="readonly"]').removeAttr('readonly')});
    }
    //Add and remove image buttons
    var widget_image = $("input.widget_image_add");
    if (0 == widget_image.siblings("a").length) {
        widget_image.after('<a href="#" class="remove-item-image button">Remove image</a>');
        widget_image.after('<a href="#" class="add-item-image button">Add image</a>');
    }

    var tgm_media_frame;
    var image_field;

    jQuery(document.body).on("click", '.add-item-image', function (e) {
        image_field = $(this).siblings("input.widget_image_add");
        e.preventDefault();
        if (tgm_media_frame) {
            tgm_media_frame.open();
            return false;
        }

        tgm_media_frame = wp.media.frames.tgm_media_frame = wp.media({
            frame: 'select',
            multiple: false,
            library: {type: 'image'}
        });

        tgm_media_frame.on("select", function () {
            var media_attachment = tgm_media_frame.state().get('selection').first().toJSON();
            var image_link = media_attachment.url;
            jQuery(image_field).val(image_link);
        });
        // Now that everything has been set, let's open up the frame.
        tgm_media_frame.open();
    });

    //Remove image button
    jQuery(document.body).on("click", ".remove-item-image", function (e) {
        e.preventDefault();
        jQuery(this).siblings('input.widget_image_add').val("");
    });


    /**Post featured metaboxes for different post formats**/
    if (jQuery('body').hasClass('post-type-post')) {
        var $selector_panel = jQuery("#post-formats-select");
        var $post_format_metaboxes = jQuery('#fw-options-box-post-quote, #fw-options-box-post-image, #fw-options-box-post-video, #fw-options-box-post-audio, #fw-options-box-post-gallery');
        var utouch_pf_selected = $selector_panel.find('input:radio[name=post_format]:checked').val();
        $post_format_metaboxes.hide(); // Default Hide
        jQuery('#fw-options-box-post-' + utouch_pf_selected).show();
        $selector_panel.find('input:radio[name=post_format]').change(function () {
            $post_format_metaboxes.hide(); // Hide during changing
            utouch_pf_selected = $selector_panel.find('input:radio[name=post_format]:checked').val();
            if (this.value == utouch_pf_selected) {
                jQuery('#fw-options-box-post-' + utouch_pf_selected).show();
            }
        });
    }

    /* Colored dropdown options for color selection in shortcodes */
    var CruminaColoredSelect = function () {
        $('.colored-options').each(function () {
            var $color_select = $(this);
            $color_select.children('option').addClass(function () {
                return 'colored-option btn--' + $(this).val();
            });
        });
    };



    if (typeof fwEvents !== "undefined") {
        fwEvents.on('fw:options:init', function (data) {
            /* Colored dropdown for unyson options*/
            CruminaColoredSelect();

            /*advanced button styling*/
            data.$elements.find('.fw-option-type-popup[data-advanced-for]:not(.advanced-initialized)').each(function () {
                var $optionWithAdvanced = data.$elements.find('.' + $(this).attr('data-advanced-for'));
                var $buttonLabel = $(this).find('.button').html();

                if (!$optionWithAdvanced.length) {
                    console.warn('Option with advanced not found', $(this).attr('data-advanced-for'));
                    return;
                }

                var $advancedButton = $('<button type="button" class="button fw-advanced-button">' + $buttonLabel + '</button>'),
                    $popupButton = $(this).find('.button:first');

                $advancedButton.on('click', function () {
                    $popupButton.trigger('click');
                });

                $advancedButton.insertAfter(
                    $optionWithAdvanced.closest('.fw-backend-option-input').find('> .fw-inner')
                );

                $popupButton.closest('.fw-backend-option').addClass('fw-hidden');
            }).addClass('advanced-initialized');

        });

    }

    /* Colored dropdown for Widgets save*/
    if ($('body').hasClass('widgets-php')) {
        jQuery(document).ajaxSuccess(function (e, xhr, settings) {
            var widget_id_base = 'banner';
            if (settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {
                CruminaColoredSelect();
            }
        });
    }
});
/*********************************************************************
 *   JS Helpers for frontend editor (for PHP in inc/helpers.php)
 * *******************************************************************/

// Collection of row animation images

(function ($) {

    if (typeof( kc ) == 'undefined')
        window.kc = {};

    $().extend(kc.tools, {
        utouch_animated_images_collection: function ($row_animation) {

        }
    });
})(jQuery);
