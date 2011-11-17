// this identifies your website in the createToken call below
Stripe.setPublishableKey('pk_wO16qljiQ6HSPh7UJGFHIdB78FB2t');

function stripeResponseHandler(status, response) {
    if (response.error) {
        /* Re-enable the submit button and other fields. */
        $('#submit-button').removeAttr("disabled");
        $('#credit-card #number').removeAttr("disabled");
        $('#credit-card #cvv').removeAttr("disabled");
        $('#credit-card #expiry-month').removeAttr("disabled");
        $('#credit-card #expiry-year').removeAttr("disabled");

        /* Show the errors on the form */
        $("#error").html(response.error.message + ".");
        $("#error").show();
    } else {
        var payment_form = $("#payment-form");

        /* Token contains id, last4, and card type. */
        var token = response['id'];

        /**
         * Insert the token into the form so it gets submitted to the
         * server.
         */
        payment_form.append("<input type='hidden' name='stripeToken' value='" + token + "' />");

        /* Submit the form. */
        payment_form.get(0).submit();
    }
}

$(document).ready(function() {
    $("#payment-form").submit(function(event) {

        /* Make sure there's no input missing. */
        if ($('#user_name').val() == '' ||
            $('#user-email').val() == '' ||
            $('#user-password').val() == '' ||
            $('#user-password-confirmation').val() == '' ||
            $('#credit-card #number').val() == '' ||
            $('#credit-card #cvv').val() == '') {
          $('#error').html('Please enter all required fields.');
          $('#error').show();
          return false;
        }

        /* Do passwords match? */
        if ($('#user-password').val() != $('#user-password-confirmation').val()) {
          $('#error').html('Passwords do not match.');
          $('#error').show();
          return false;
        }
        /* Disable the submit button to prevent repeated clicks. */
        $('#submit-button').attr("disabled", "disabled");
        $('#credit-card #number').attr("disabled", "disabled");
        $('#credit-card #cvv').attr("disabled", "disabled");
        $('#credit-card #expiry-month').attr("disabled", "disabled");
        $('#credit-card #expiry-year').attr("disabled", "disabled");

        /* Amount we're going to charge in cents. */
        var chargeAmount = 1000;

        /**
         * createToken returns immediately - the supplied callback submits the
         * form if there are no errors.
         */
        Stripe.createToken({
            number: $('#credit-card #number').val(),
            cvc: $('#credit-card #cvv').val(),
            exp_month: $('#credit-card #expiry-month').val(),
            exp_year: $('#credit-card #expiry-year').val()
        }, chargeAmount, stripeResponseHandler);
        return false; // submit from callback
    });
});