<?php
// Start session
session_start();

// Check if the login form has been submitted
if (isset($_POST['email']) && isset($_POST['password'])) {
	// Get form data
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Connect to MongoDB
	$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	// Define the query to find a user with the specified email and password
	$filter = [
		'email' => $email,
		'password' => $password
	];

	// Define the options to limit the fields returned
	$options = [
		'projection' => [
			'_id' => 1,
			'firstName' => 1,
			'lastName' => 1,
			'age' => 1
		]
	];

	// Execute the query to find a user with the specified email and password
	$query = new MongoDB\Driver\Query($filter, $options);
	$result = $mongo->executeQuery('test.users', $query);

	// Check if a user with the specified email and password was found
	if (count($result->toArray()) > 0) {
		// Set session variables to indicate that the user is logged in
		$_SESSION['logged_in'] = true;
		$_SESSION['email'] = $email;

		// Send success response to client
		$response = array('success' => true);
		echo json_encode($response);
	} else {
		// Send error response to client
		$response = array(
			'success' => false,
			'message' => 'Invalid email or password'
		);
		echo json_encode($response);
	}
}
?>
