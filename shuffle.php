<?php
// Directory where dress images are stored
$directory = 'defaultimg/shirt/';

// Get a list of all files in the directory
$files = glob($directory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

// Check if there are any files in the directory
if (count($files) > 0) {
    // Select a random file from the list
    $randomFile = $files[array_rand($files)];

    // Get the file name
    $randomFileName = basename($randomFile);

    // Set the desired width and height for the image
    $width = 300; // Set the width here
    $height = 400; // Set the height here

    // Display the random dress image with the specified size
    echo "<img src='$directory$randomFileName' alt='Random Dress Image' style='max-width: 50%; height: auto; width: {$width}px; height: {$height}px;'>";
} else {
    echo "<p>No dress images available.</p>";
}
?>

