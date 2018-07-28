    jQuery(document).ready(function ($) {
        var is_sending = false,
            failure_message = 'Whoops, looks like there was a problem. Please try again later.';

        $('.contact-form').on('submit',function (e) {
            var $form = $(this),
                $form_data = $form.serializeArray(),
                $thanks_message = '<h4>' + $form.data('thanks') + '</h4>';
            $form_data.push({name: 'action', value: 'widget_contact_form'});

            if (is_sending || !validateInputs($form)) {
                return false; // Don't let someone submit the form while it is in-progress...
            }
            e.preventDefault(); // Prevent the default form submit

            $.ajax({
                url: fwAjaxUrl, // Let WordPress figure this url out...
                type: 'post',
                data : $form_data,
                dataType: 'JSON', // Set this so we don't need to decode the response...
               // data: $form.serialize(), // One-liner form data prep...
                beforeSend: function () {
                    is_sending = true;
                    // You could do an animation here...
                },
                error: handleFormError,
                success: function (data) {
                    if (data.status === 'success') {
                        $form.html( $thanks_message ).fadeTo(300, 1);
                    } else {
                        handleFormError(); // If we don't get the expected response, it's an error...
                    }
                }
            });
        });

        function handleFormError () {
            is_sending = false; // Reset the is_sending var so they can try again...
            console.log(failure_message);
        }

        function validateInputs ($form) {
            var name = $.trim($form.find('input[name="name"]').val()),
                email = $.trim($form.find('input[name="email"]').val()),
                message = $.trim($form.find('textarea[name="message"]').val());

            if (!name || !email || !message) {
                alert('Before sending, please make sure to provide your name, email, and message.');
                return false;
            }
            return true;
        }
    });