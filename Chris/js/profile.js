$(document).ready(function() {
  // Load user's information on page load
  $.ajax({
    url: "..php/get_profile.php",
    type: "GET",
    success: function(response) {
      var user = JSON.parse(response);
      $("#username").text(user.username);
      $("#age").val(user.age);
      $("#dob").val(user.dob);
      $("#contact").val(user.contact);
    },
    error: function(xhr, status, error) {
      console.log("Error loading profile:", error);
    }
  });

  // Handle profile update form submission
  $("#profile-form").submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      url: "../php/update_profile.php",
      type: "POST",
      data: formData,
      success: function(response) {
        alert(response);
      },
      error: function(xhr, status, error) {
        console.log("Error updating profile:", error);
      }
    });
  });

  // Handle logout button click
  $("#logout-btn").click(function() {
    $.ajax({
      url: "../php/logout.php",
      type: "POST",
      success: function(response) {
        window.location.href = "..html/login.html";
      },
      error: function(xhr, status, error) {
        console.log("Error logging out:", error);
      }
    });
  });
});
