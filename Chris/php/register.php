<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Perform server-side validation of the form data
    // ...

    // Store the form data in the MongoDB collection
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->your_database->users;

    $insertOneResult = $collection->insertOne([
        'name' => $name,
        'email' => $email,
        'password' => $password
    ]);

    if ($insertOneResult->getInsertedCount() === 1) {
        echo "Registration successful!";
    } else {
        echo "Error inserting user data into MongoDB";
    }
}
?>
