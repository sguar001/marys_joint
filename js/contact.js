// First, we will run the validator script on our contact form.

// Then, we will add some JavaScript that will help us with the submitting of the form via AJAX request

// When the form with the #contact-form id is submitted, we make the POST request to the contact.php script.

// On request's success, we work with the JSON object that is returned by the PHP script. The object has only two properties - type and message

// We use type and message to construct the message visible for the user - in case of error we display alert-danger, in case of success we display alert-success

// We display the message, reset form inputs and return false; to prevent the usual form submitting

$(function () {

    // init the validator
    // validator files are included in the download package
    // otherwise download from http://1000hz.github.io/bootstrap-validator

    $('#contact-form').validator();


    // when the form is submitted
    $('#contact-form').on('submit', function(e) 
    {

        // if the validator does not prevent form submit
        if (!e.isDefaultPrevented()) 
        {
            var url = "php/contact_email.php";

            // POST values in the background the the script URL
            $.ajax
            ({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data)
                {
                    // data = JSON object that contact_email.php returns

                    // we recieve the type of the message: success x danger and apply it to the 
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    // let's compose Bootstrap alert box HTML
                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    
                    // If we have messageAlert and messageText
                    if (messageAlert && messageText) 
                    {
                        // inject the alert to .messages div in our form
                        $('#contact-form').find('.messages').html(alertBox);
                        
                        // empty the form
                        $('#contact-form')[0].reset();
                    }
                    
                }
                
            });
            
            return false;
        }
    })
});