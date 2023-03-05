<?php

// Start the session
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Include the MongoDB PHP library
require_once __DIR__ . '/vendor/autoload.php';

// Set up MongoDB client and select database
$mongoClient = new MongoDB\Client('mongodb://localhost:27017');
$database = $mongoClient->selectDatabase('mydatabase');

// Get the users collection
$usersCollection = $database->selectCollection('users');

// Get the logged-in user's document
$loggedInUser = $usersCollection->findOne(['username' => $_SESSION['username']]);

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Get the submitted form data
  $age = $_POST['age'];
  $dob = $_POST['dob'];
  $contact = $_POST['contact'];

  // Update the user's document with the new data
  $result = $usersCollection->updateOne(
    ['_id' => $loggedInUser['_id']],
    ['$set' => [
      'age' => $age,
      'dob' => $dob,
      'contact' => $contact
    ]]
  );

  // Redirect back to the profile page
  header("Location: ../php/get_profile.php");
  exit();
}

?>
