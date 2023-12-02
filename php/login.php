<!-- 
    In this file
step 1) We check the data requested was already cached in redis or not, If yes it will use redis for log In.
step 2) If not in redis we will use sql prepared statement to log in. and redirect to profile page. 
-->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "guvi";

// Create a Redis connection
$redis = new Redis();
$redis->connect('127.0.0.1', 6379); 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get user input
    $enteredEmail = $_POST["email"];
    $enteredPassword = $_POST["password"];

    $cachedLoginInfo = $redis->get($enteredEmail);

    if ($cachedLoginInfo) {
        $loginInfo = json_decode($cachedLoginInfo, true);

        $storedPassword = $loginInfo["password"];

        if ($enteredPassword === $storedPassword) {
            echo "Login successful! (From Redis)";
            exit; 
        }
    }

    // Prepared statement to check login credentials in the database
    $stmt = $conn->prepare("SELECT * FROM guvi2 WHERE email = ?");
    $stmt->bind_param("s", $enteredEmail);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        if ($enteredPassword === $storedPassword) {
            echo "Login successful!";

            // Store login information in Redis for future use
            $loginInfo = ["email" => $enteredEmail, "password" => $storedPassword];
            $redis->set($enteredEmail, json_encode($loginInfo));

        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
}

$conn->close();
$redis->close();
?>
