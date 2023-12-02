<?php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "guvi";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get user input from the form
    $newName = $_POST["fullName"];
    $newEmail = $_POST["email"];
    $newNumber = $_POST["mobile"];
    $newPassword = $_POST["password"]; // Store password as plain text

    // Use a prepared statement to insert data into the 'users' table
    $stmt = $conn->prepare("INSERT INTO guvi (name, email, mobile, password) VALUES (?, ?, ?, ?)");

    // Bind parameters to the statement
    $stmt->bind_param("ssss", $newName, $newEmail, $newNumber, $newPassword);

    // Execute 
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error during registration: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>