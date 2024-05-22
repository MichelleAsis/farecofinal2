<?php 
session_start();

if (isset($_POST['avatar'])) {
    // Store the selected avatar in the session
    $_SESSION['avatar'] = $_POST['avatar'];
    
    // Store the selected avatar in the database
    include("connection.php");
    include("functions.php");
    $user_data = check_login($con);
    $username = $_SESSION['username'];
    $avatar = $_POST['avatar'];
    $query = "UPDATE userprof SET avatar='$avatar' WHERE acc_user='$username'";
    mysqli_query($con, $query);

    // Redirect to the user page to apply changes
    header("Location: userpage.php");
    exit();
}




	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

    $avatar = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : 'images/profuser.png';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fareco: Fashion Recommendation</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Crimson+Text&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://www.gstatic.com/firebasejs/10.11.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.11.1/firebase-database.js"></script>
</head>

<body>
    <header> 
        <h3 id="headtitle"> 
            <!-- Back Icon --> 
            <a href="index.php" class="back-icon">
                
                <i class="fas fa-arrow-left"></i>
            </a>
            F A R E C O 
            <i class="fas fa-bars hamburger-icon" onclick="togglePanel()"></i> 
        </h3>
    </header>

    <div class="menus">
        <img src="images/plus.png" alt="plus" title="add post" id="plus">
        <img src="images/match.png" alt="match" title="matchmake clothes" id="match">
        
    </div>

    <!-- Pop-up panel for main actions -->
    <div class="popup-panel" id="popupPanel">
        <div class="popup-content">
            <!-- Content of the pop-up panel -->
            <i class="fas fa-arrow-left back" onclick="togglePanel()"></i>

            <p style="text-align: center;">ABOUT</p>
            <p>You can add any content here.</p>
            
             <button onclick="logout()"> LOGOUT </button>
             
            </a>
        </div>
    </div>

    <!-- Profile elements -->
    <img src="images/profuser.png" alt="profile picture" title="profile picture" id="profsize" >
    
    <span id="profileuserlbl"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Username'; ?></span>

    <img src="images/profplus.png" alt="profile picture" title="profile picture" id="profpic" onclick="toggleAvatarPanel()">
    
    <div class="userinfo">
        <div class="socials">
            
            <div class="social">
                <span id="numsaved">0</span>
                <span>Shared Posts</span> 
            </div>
            
        </div>
    </div>

    

    <!-- Pop-up panel for picking avatar -->
    <div class="popup-avatar" id="avatarPanel">
        <div class="popup-content3">
            <i class="fas fa-arrow-left back" onclick="toggleAvatarPanel()"></i>

            <p style="text-align: center;">PICK AVATAR</p>
            <div class="placeholder-images">
    <img src="images/avatar1.png" alt="Placeholder" class="profile-image" id="image1" onclick="selectAvatar('image1')">
    <img src="images/avatar2.png" alt="Placeholder" class="profile-image" id="image2" onclick="selectAvatar('image2')">
    <img src="images/avatar3.png" alt="Placeholder" class="profile-image" id="image3" onclick="selectAvatar('image3')">
    <img src="images/avatar4.png" alt="Placeholder" class="profile-image" id="image4" onclick="selectAvatar('image4')">
</div>
            
        </div>
    </div>

    <script>
    function togglePanel() {
        var panel = document.getElementById("popupPanel");
        panel.classList.toggle("active");
    }

    function showAvatarPanel() {
        var panel = document.getElementById("avatarPanel");
        panel.classList.add("active");

        // Add event listener to the "Done" button
        var doneButton = document.getElementById('userbtn');
        doneButton.addEventListener('click', applyAvatar);
    }
    function selectAvatar(imageId) {
    // Remove selected-avatar class from all images
    var profileImages = document.querySelectorAll('.profile-image');
    profileImages.forEach(image => {
        image.classList.remove('selected-avatar');
    });

    // Add selected-avatar class to the clicked image
    var selectedImage = document.getElementById(imageId);
    selectedImage.classList.add('selected-avatar');

    // Apply the selected avatar immediately
    applyAvatar();
}


    function applyAvatar() {
        var selectedAvatar = document.querySelector('.profile-image.selected-avatar');
        if (selectedAvatar) {
            var profileuser = document.getElementById('profsize');
            profileuser.src = selectedAvatar.src;
        }

        // Close the avatar panel
        var panel = document.getElementById("avatarPanel");
        panel.classList.remove("active");
    }

    // Add event listener to the "Change Avatar" button
    var changeAvatarButton = document.getElementById('profpic');
    changeAvatarButton.addEventListener('click', showAvatarPanel);

    function logout() {
        // Redirect to logout.php when the button is clicked
        window.location.href = 'logout.php';
    }
</script>

</body>
</html>
