<?php
session_start();

// Ensure proper directory structure exists
$userFolder = 'accounts/' . $_SESSION['username'] . '/';
if (!file_exists($userFolder)) {
    mkdir($userFolder, 0777, true); // Create directory recursively
}

// Receive JSON data from POST request
$data = json_decode(file_get_contents("php://input"), true);

// Decode base64 image data
$imageData = $data['image'];
$encodedData = str_replace('data:image/jpeg;base64,', '', $imageData);
$decodedData = base64_decode($encodedData);

// Construct file path
$filePath = $userFolder . 'CombinedOutfit.jpg';

// Save image to the user's folder
file_put_contents($filePath, $decodedData);

// Optionally, you can store $filePath in your database for future reference

// Respond to client
echo 'Image saved successfully.';
?>
