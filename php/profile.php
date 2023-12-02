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

// Get the email from the POST data
$userEmail = $_POST['email'];

// prepared statement to retrieve user details from the 'users' table
$stmt = $conn->prepare("SELECT name, email, mobile FROM guvi WHERE email = ?");
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$stmt->bind_result($userName, $userEmail, $userMobile);

// Fetch the result
if ($stmt->fetch()) {
    // User found, return details
    $userData = array(
        "name" => $userName,
        "email" => $userEmail,
        "mobile" => $userMobile
    );

    // Output the user details as JSON
    echo json_encode($userData);
} else {
    // User not found
    echo "User not found";
}

$stmt->close();

$conn->close();
?>
