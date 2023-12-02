<?php

require_once __DIR__ . '../../vendor/autoload.php';


// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "guvi";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $database);

//mongodb connection
$client = new MongoDB\Client();

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$database = $client->selectDatabase('guvi');
$collection = $database->selectCollection('profile');



// Check if the form is submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get user input from the form
    $newName = $_POST["fullName"];
    $newEmail = $_POST["email"];
    $newNumber = $_POST["mobile"];
    $newPassword = $_POST["password"]; 

    $existingUser = $collection->findOne(['email' => $newEmail]);

    if ($existingUser) {
        // Email already exists in MongoDB
        echo "Email already exists. Choose a different email.";
    } else {
        // Step 2: Insert into MongoDB
        $result = $collection->insertOne([
            'name' => $newName,
            'email' => $newEmail,
            'mobile' => $newNumber
        ]);

        // Check if MongoDB insertion was successful
        if ($result->getInsertedCount() > 0) {
            $sql_query = "INSERT INTO guvi2 (email, password) VALUES ('$newEmail', '$newPassword')";

            if ($conn->query($sql_query) === TRUE) {
                echo "Registration successful!";
            } else {
                echo "Error during SQL registration: " . $conn_sql->error;
            }
        } else {
            echo "Error during MongoDB registration";
        }
    }

    $conn->close();

}

?>