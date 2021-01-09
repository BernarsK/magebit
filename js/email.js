var $emailForm = $('#email-form');

jQuery.validator.addMethod("customEmail", function(value, element) { 
return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value ); 
}, "Please provide a valid e-mail address");

var bannedDomains = ["co"];

jQuery.validator.addMethod('domainNotBanned', function(value, element) {
    var domain = value.split('@')[1];
    var topDomain = domain.split('.')[1];
    return bannedDomains.indexOf(topDomain) < 0;
  }, 'We are not accepting subscriptions from Colombia emails');

$(document).ready(function(){
    if($emailForm.length){
    $emailForm.validate({
        rules:{
            email: {
                required: true,
                customEmail: true,
                domainNotBanned: true
            },
            tosbox: {
                required: true
            }
        },
        messages:{
            email: {
                required: 'Email address is required',
                //error message for the email field
                email: 'Please provide a valid e-mail address'
            },
            tosbox: {
                required: 'You must accept the terms and conditions'
            }
        },
        errorPlacement: function(error, element) {
            //error.appendTo(element.parents('.error-field'));
            error.insertAfter(element);
        }
    });
    }

    $("#email").on("blur", function(){
        if($("#email-form").valid())
       {
           $("#submit-button").removeAttr("disabled");
       }
     });


});  // end doc ready



