<?php

if (isset($_POST['submit']) && isset($_FILES['image'])) {
    include "connection.php"; // Make sure this path is correct

    // Additional data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $tags = implode(',', $_POST['tags']); // Assuming checkbox values are stored as a comma-separated string

    // Check if a user is authenticated, you need to implement user authentication here
    if (isset($_SESSION['username'])) {
        $acc_user = $_SESSION['username']; // Get the username of the current user
    } else {
        // Redirect to login page or handle unauthorized access
        header("Location: login.php");
        exit(); // Stop further execution
    }

    $img_src = $_POST['image']; // Get the image source from the hidden input

    // Process the image source to extract image data
    $img_data = file_get_contents($img_src); // Get the image data
    $img_name = uniqid("IMG-", true) . '.png'; // Generate a unique image name
    $img_upload_path = 'uploads/' . $img_name; // Set the image upload path

    // Save the image data to the server
    file_put_contents($img_upload_path, $img_data);

    // Insert into Database
    $sql = "INSERT INTO post (title, content, tags, image, acc_user) 
            VALUES ('$title', '$content', '$tags', '$img_name', '$acc_user')";
    if (mysqli_query($con, $sql)) {
        header("Location: index.php");
        exit(); // Stop further execution
    } else {
        $em = "Error: " . mysqli_error($con);
        header("Location: index.php?error=$em");
        exit(); // Stop further execution
    }
} else {
    header("Location: index.php");
    exit(); // Stop further execution
}
?>
