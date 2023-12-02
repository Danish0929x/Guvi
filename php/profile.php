<?php


require_once __DIR__ . '../../vendor/autoload.php';


$client = new MongoDB\Client();


$database = $client->selectDatabase('guvi');
$collection = $database->selectCollection('profile');

$userEmail = $_POST['email'];


// Find user in MongoDB
$user = $collection->findOne(['email' => $userEmail]);

// Fetch the result
if ($user) {
    // User found, return details
    $userData = [
        "name" => $user['name'],
        "email" => $user['email'],
        "mobile" => $user['mobile']
    ];

    // Output the user details as JSON
    echo json_encode($userData);
} else {
    // User not found
    echo "User not found";
}

?>
