<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "guvi";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get user input
    $enteredEmail = $_POST["email"];
    $enteredPassword = $_POST["password"];

    // prepared statement to check login credentials
    $stmt = $conn->prepare("SELECT * FROM guvi WHERE email = ?");
    $stmt->bind_param("s", $enteredEmail);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        if ($enteredPassword === $storedPassword) {
            echo "Login successful!";
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
}

$conn->close();
?>