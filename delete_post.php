<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = mysqli_real_escape_string($con, $_POST['PID']);

    // Fetch the image path before deleting the post
    $query = "SELECT image FROM post WHERE PID = '$post_id'";
    $result = mysqli_query($con, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $image_path = 'uploads/' . $row['image'];

        // Delete the post from the database
        $query = "DELETE FROM post WHERE PID = '$post_id'";
        if (mysqli_query($con, $query)) {
            // Delete the image file if it exists
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            echo "<script>alert('Post deleted successfully.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error deleting post: " . mysqli_error($con) . "'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Post not found.'); window.location.href='index.php';</script>";
    }

    mysqli_close($con);
} else {
    echo "<script>alert('Invalid request.'); window.location.href='index.php';</script>";
}
?>
