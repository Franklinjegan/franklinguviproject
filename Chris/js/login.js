$(document).ready(function() {
	$('#login-form').submit(function(event) {
		event.preventDefault(); // Prevent default form submission

		// Get form data and send it via AJAX to the server
		var email = $('input[name="email"]').val();
		var password = $('input[name="password"]').val();

		$.ajax({
			url: 'login.php',
			type: 'POST',
			dataType: 'json',
			data: {email: email, password: password},
			success: function(data) {
				if (data.success) {
					// Redirect to the profile page if login is successful
					window.location.href = 'profile.php';
				} else {
					// Display error message if login is unsuccessful
					alert(data.message);
				}
			},
			error: function(xhr, status, error) {
				console.log(error);
			}
		});
	});
});
