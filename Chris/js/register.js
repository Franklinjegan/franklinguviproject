$(document).ready(function() {
    $('#register-form').submit(function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Get the form data
        var formData = {
            'name'     : $('input[name=name]').val(),
            'email'    : $('input[name=email]').val(),
            'password' : $('input[name=password]').val()
        };

        // Send the form data using AJAX
        $.ajax({
            type        : 'POST',
            url         : 'register.php',
            data        : formData,
            dataType    : 'json',
            encode      : true
        })
        .done(function(data) {
            // Display a success message
            alert(data.message);
        })
        .fail(function(data) {
            // Display an error message
            alert(data.responseJSON.message);
        });
    });
});
