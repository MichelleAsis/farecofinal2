<?php 
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['signuser'];
    $password = $_POST['signpass'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Save to database
        $user_ID = random_num(5);
        $query = "INSERT INTO accounts (user_ID, Fname, Lname, acc_user, acc_pass) VALUES ('$user_ID', '$fname', '$lname', '$user_name', '$password')";

        if (mysqli_query($con, $query)) {
            // User added successfully
            echo "<script>alert('User added successfully!');</script>";

            // Create a folder for the user
            $user_folder = "accounts/" . $user_name; // Assuming $user_name is the username
            if (!file_exists($user_folder)) {
                mkdir($user_folder, 0777, true); // Creates directory recursively if not exists
            }

            header("Location: login.php");
            die;
        } else {
            echo "<script>alert('Failed to add user!');</script>";
        }
    } else {
        echo "<script>alert('Please enter valid information!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fareco: Fashion Recommendation</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Crimson+Text&display=swap">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.11.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.11.1/firebase-auth.js"></script>
</head>
<body>

<div class="landing-page">
    <h1 id="farecologin"> F A R E C O </h1>

    <img src="images/des1.png" alt="design sign up" id="sign-design">
    <h1 id="farecologin"> F A R E C O </h1>
    <form method="post" onsubmit="return validateForm()">
        <div class="sign-page" id="signup-form">
            <div class="name-inputs">
                <input type="text" name="firstname" id="firstname" placeholder="First name" style="width: 20%;" required>
                <input type="text" name="lastname" id="lastname" placeholder="Last name" style="width: 20%;" required>
            </div>
            <input type="text" name="signuser" id="signuser" placeholder="Username" style="width: 20%;" required>
            <input type="password" name="signpass" id="signpass" placeholder="Password" style="width: 20%;"  required>
            <span class="toggle-password" onclick="togglePasswordVisibility()">
                <i class="far fa-eye" id="eye-icon"></i>
            </span>
            <input type="password" name="signrepass" id="signrepass" placeholder="Re-enter Password" style="width: 20%;" required>
            <span id="password-error" style="color: red;"></span>
            <button id="btn-sign" style="left:67%;">Sign Up</button>
        </div>
    </form>

    <a href="login.php" id="backtolog" style="font-family: Crimson; color: #944e2c; margin-top: 20px; margin-left: 62%;">Already have an Account? Login Instead</a>

</div>


<script>
    function togglePasswordVisibility() {
        const passwordField = document.getElementById('signpass');
        const eyeIcon = document.getElementById('eye-icon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.add('fa-eye-slash');
            eyeIcon.classList.remove('fa-eye');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.add('fa-eye');
            eyeIcon.classList.remove('fa-eye-slash');
        }
    }

    function validateForm() {
        var password = document.getElementById("signpass").value;
        var confirmPassword = document.getElementById("signrepass").value;
        var errorElement = document.getElementById("password-error");

        if (password !== confirmPassword) {
            errorElement.textContent = "Passwords do not match!";
            return false;
        } else {
            errorElement.textContent = "";
            return true;
        }
    }
</script>

</body>
</html>
