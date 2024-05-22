    <?php
    session_start();
    include "connection.php"; // Ensure this path is correct
    $avatar = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : 'images/profuser.png';

    // Check if a tag parameter is provided in the URL
    if(isset($_GET['tag'])) {
        $selectedTag = $_GET['tag'];
        $sql = "SELECT title, content, likes, tags, acc_user, image FROM post WHERE tags LIKE '%$selectedTag%'";
    } else {
        // If no tag parameter is provided, fetch all posts
        $sql = "SELECT title, content, likes, tags, acc_user, image FROM post";
    }

    $result = mysqli_query($con, $sql);

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
</head>
<body>
    <header> 
        <h3 id="headtitle"> F A R E C O </h3>
        <div class="circle-button">
        <img src="images/1.png" alt="shirt" onclick="filterPosts('shirt')" title="shirt" id="shirt">
        <img src="images/0.png" alt="all" onclick="filterPosts('all')" title="all" id="all">
        <img src="images/2.png" alt="short" onclick="filterPosts('short')" title="short" id="short">
        <img src="images/3.png" alt="pants" onclick="filterPosts('pants')" title="pants" id="pants">
        <img src="images/4.png" alt="skirt" onclick="filterPosts('skirt')" title="skirt" id="skirt">
        <img src="images/5.png" alt="dress" onclick="filterPosts('dress')" title="dress" id="dress">
        <a href="userpage.php">
                <img src="<?php echo $avatar; ?>" alt="Profile Picture" id="profile-circle">
            </a>
            <span id="profile-label"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Username'; ?></span>
    </div>
    </header>

    

    <div class="menus">
        <img src="images/plus.png" alt="plus" title="add post" id="plus" onclick="togglePostingPanel()">
        <img src="images/match.png" alt="match" title="matchmake clothes" id="match" onclick="toggleMatchPanel()">
  
    </div>

    <!-- Pop-up panel for posting -->
    <div class="popup-post" id="postingPanel">
        <div class="popup-content">
            <header>
                <h1>Create a New Post</h1>
            </header>
            <main>
                <form id="postForm" action="upload.php" method="post" enctype="multipart/form-data">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required><br><br>

                    <label for="content">Content:</label><br>
                    <textarea id="content" name="content" rows="4" cols="50" required></textarea><br><br>

                    <div id="imageContainer" class="horizontal-scroll">
    <!-- Combined images will be dynamically inserted here -->
</div><br>


                    <!-- Image container -->
                    <div id="imageContainer" class="horizontal-scroll">
                    <!-- Image will be dynamically inserted here -->
                    <?php
                    $userFolder = 'accounts/' . $_SESSION['username'] . '/';
                    $imageFiles = glob($userFolder . 'CombinedOutfit*.jpg');  // Get all combined image files
                    
                    if (!empty($imageFiles)) {
                        foreach ($imageFiles as $imagePath) {
                            echo '<img src="' . $imagePath . '" alt="Combined Image" onclick="selectImage(this)">';
                        }
                    } else {
                        echo '<p>No combined images found.</p>';
                    }
                    ?>
                </div>

                    <!-- Tags -->
                    <label>Tags:</label><br>
                    <input type="checkbox" id="tag-shirt" name="tags[]" value="shirt" onclick="uncheckOtherTags('tag-shirt')">
                    <label for="tag-shirt">Shirt</label><br>
                    <input type="checkbox" id="tag-skirt" name="tags[]" value="skirt" onclick="uncheckOtherTags('tag-skirt')">
                    <label for="tag-skirt">Skirt</label><br>
                    <input type="checkbox" id="tag-pants" name="tags[]" value="pants" onclick="uncheckOtherTags('tag-pants')">
                    <label for="tag-pants">Pants</label><br>
                    <input type="checkbox" id="tag-short" name="tags[]" value="short" onclick="uncheckOtherTags('tag-short')">
                    <label for="tag-short">Short</label><br>
                    <input type="checkbox" id="tag-dress" name="tags[]" value="dress" onclick="uncheckOtherTags('tag-dress')">
                    <label for="tag-dress">Dress</label><br><br>

                    <button type="submit" name="submit">Post</button>
                </form>
            </main>
        </div>
    </div>


   

    <div class="popup-match <?php echo isset($_GET['matchPanel']) && $_GET['matchPanel'] === 'true' ? 'active' : ''; ?>" id="matchPanel">
    <div class="popup-content">
        <header><h1>Match Clothes</h1></header>
        <br><br>
        <div id="container" style="position: absolute; display: flex; justify-content: space-between; width: 90%; height: 60%; object-fit: cover;">
            <img src="images/fillershirt.png" alt="fillershirt" id="fillershirt">
            <img src="images/fillerbottom.png" alt="fillerbottom" id="fillerbottom">
        </div>
        <h2 style="position: absolute; top: 95%; left: 23%;">Shirt</h2>

        <div class="items-container" style="position: absolute; display: absolute; flex-wrap: wrap; gap: 10px; margin-top: 280px; margin-left: 60%;">
            <div class="item">
                <h2><input type="checkbox" name="pant" id="pant">&nbsp;&nbsp;Pants</h2>
            </div>
            <div class="item">
                <h2><input type="checkbox" name="shorts" id="shorts">&nbsp;&nbsp;Shorts</h2>
            </div>
            <div class="item">
                <h2><input type="checkbox" name="skirts" id="skirts">&nbsp;&nbsp;Skirts</h2>
            </div>
        </div>

        <br><br><br><br>

        <div class="btnss">
            <!-- Save To Account Button (Separate Form) -->
            <form id="saveToAccountForm"  method="post">
                <input type="hidden" name="saveToAccount" value="true">
                <button type="submit" id="savetoacc" onclick="saveImageToDevice()">Save To Account</button>
            </form>
            
            <!-- Other Buttons -->
            <button id="matchmake">Matchmake</button>
            <button id="find-dress">Find Dress</button>

        </div>
        <h1 style="top: 160%; position: absolute; visibility: hidden;">hello</h1>

    </div>
</div>

    
    <div class="popup-find-dress <?php echo isset($_GET['findDressPanel']) && $_GET['findDressPanel'] === 'true' ? 'active' : ''; ?>" id="findDressPanel">

    <div class="popup-content">
    <header>
        <h1>Find Dresses</h1>
    </header>

    <div class="btnss" style="display: block; position: relative;">
    <a href="index.php?findDressPanel=true"><button id="shuffleButton" style="position: absolute; padding: 10px 20px; border: 2px solid #BF8952; border-radius: 50px; background-color: #A66744; color: white; font-family: 'Crimson Text', serif; font-size: 14px; cursor: pointer; transition: background-color 0.3s ease; z-index: 2; left: 70%; top: 100px;">Shuffle</button></a>
    <a href="index.php?matchPanel=true"><button id="backButton"  style="position: absolute; padding: 10px 20px; border: 2px solid #BF8952; border-radius: 50px; background-color: #A66744; color: white; font-family: 'Crimson Text', serif; font-size: 14px; cursor: pointer; transition: background-color 0.3s ease; z-index: 1; left: 90%; top: 100px;">Back</button></a>
</div>



<div id="dressImageContainer">
    
      <?php
    // Directory where dress images are stored
    $directory = 'defaultimg/dress/';
    
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
</div>
<div class="btnss" style="display: block; position: relative; margin-top: 20px;">
<a href="index.php?sharePanel=true"><button id="shareAsPostButton" style="padding: 10px 20px; border: 2px solid #BF8952; border-radius: 50px; background-color: #A66744; color: white; font-family: 'Crimson Text', serif; font-size: 14px; cursor: pointer; transition: background-color 0.3s ease;">Share as Post</button></a>
            <button id="saveToDeviceButton" onclick="saveImageToDevice()" style="padding: 10px 20px; border: 2px solid #BF8952; border-radius: 50px; background-color: #A66744; color: white; font-family: 'Crimson Text', serif; font-size: 14px; cursor: pointer; transition: background-color 0.3s ease; margin-left: 20px;">Save to Device</button>


        </div>

        
        
    </div>
    </div>


    <section id="newsfeed" class="scrollable">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='post'>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<p>" . htmlspecialchars($row['content']) . "</p>";
            if (!empty($row['image'])) {
                echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['title']) . "' style='max-width: 100%; height: auto;'>";
            }
            echo "<p><strong>Likes:</strong> " . htmlspecialchars($row['likes']) . "</p>";
            echo "<p><strong>Tags:</strong> " . htmlspecialchars($row['tags']) . "</p>";
            echo "<p><strong>Posted by:</strong> " . htmlspecialchars($row['acc_user']) . "</p>";
             echo "<button class='save-button'>Save</button>";
            echo "</div>";
        }
    } else {
        echo "<p>No posts yet.</p>";
    }

    mysqli_close($con);
    ?>
</section>


<script>

function transferImageToSharePanel() {
    // Get the image element from the dress panel
    var dressImage = document.querySelector('#dressImageContainer img');
    
    // Get the image source
    var imageSource = dressImage.getAttribute('src');
    
    // Clone the image element
    var clonedImage = dressImage.cloneNode(true);
    
    // Remove the onclick event listener from the cloned image
    clonedImage.removeAttribute('onclick');
    
    // Get the share panel
    var sharePanel = document.getElementById('sharePanel');
    
    // Get the container in the share panel where you want to transfer the image
    var imageContainerInSharePanel = sharePanel.querySelector('.image-container');
    
    // Clear any existing content in the container
    imageContainerInSharePanel.innerHTML = '';
    
    // Append the cloned image to the container in the share panel
    imageContainerInSharePanel.appendChild(clonedImage);
    
    // Set the image source in the hidden input field of the share panel
    var sharedImageInput = document.getElementById('sharedImage');
    sharedImageInput.value = imageSource;
} 

    function openSharePanel(imageSrc) {
    var panel = document.getElementById("sharePanel");
    panel.classList.add("active");
    
    // Set the image source in the hidden input field
    var sharedImageInput = document.getElementById("sharedImage");
    sharedImageInput.value = imageSrc;
}

    function toggleFindDressPanel() {
        var panel = document.getElementById("findDressPanel");
        panel.classList.toggle("active");
        var newsfeed = document.getElementById("newsfeed");
        newsfeed.classList.toggle("active");
    }
        
    function togglePostingPanel() {
        var panel = document.getElementById("postingPanel");
        panel.classList.toggle("active");
    }

    function captureImage() {
        var dressImage = document.getElementById("dressImageContainer").querySelector("img");
        var sharedImageInput = document.getElementById("sharedImage");
        if (dressImage && sharedImageInput) {
            sharedImageInput.value = dressImage.src;
        }
    }

    document.getElementById("shareAsPostButton").addEventListener("click", function() {
    sharePanel(); // Toggle the visibility of the share panel
});

function sharePanel() {
    var panel = document.getElementById("sharePanel");
    panel.classList.toggle("active"); // Toggle the "active" class to show/hide the panel
}

    function toggleMatchPanel() {
        var panel = document.getElementById("matchPanel");
        panel.classList.toggle("active");
        
    }

    function saveImageToDevice() {
    // Get the image source
    var imageSource = document.querySelector('#dressImageContainer img').getAttribute('src');
    
    // Create a temporary anchor element
    var anchor = document.createElement('a');
    anchor.href = imageSource;
    
    // Suggest a default filename (you can modify this)
    anchor.download = 'DressFromFARECO  .jpg'; 
    
    // Trigger the download
    anchor.click();
}



    function filterPosts(tag) {
        // If tag is "all", redirect to the same page without any tag parameter
        if (tag === 'all') {
            window.location.href = 'index.php';
        } else {
            // Redirect to the same page with the selected tag as a query parameter
            window.location.href = 'index.php?tag=' + tag;
        }

        // Remove the clicked class from all buttons
        var buttons = document.querySelectorAll('.circle-button img');
        buttons.forEach(function(button) {
            button.classList.remove('clicked');
        });

        // Add the clicked class to the clicked button
        var clickedButton = document.getElementById(tag);
        clickedButton.classList.add('clicked');
    }

    function uncheckOtherTags(clickedTagId) {
        // Get all checkboxes with the name "tags[]"
        var checkboxes = document.getElementsByName('tags[]');

        // Loop through all checkboxes
        checkboxes.forEach(function(checkbox) {
            // Uncheck the checkbox if it is not the one that was clicked
            if (checkbox.id !== clickedTagId) {
                checkbox.checked = false;
            }
        });
    }

    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Uncheck all checkboxes except the one that triggered the event
            checkboxes.forEach(cb => {
                if (cb !== this) {
                    cb.checked = false;
                }
            });
        });
    });

    // Event listener for the "Find Dress" button
    document.getElementById("find-dress").addEventListener("click", function() {
        toggleFindDressPanel();
    });

    // Event listener for the "Back" button
    document.getElementById("backButton").addEventListener("click", function() {
        toggleFindDressPanel();
    });
</script>

<script>
document.getElementById('matchmake').addEventListener('click', function() {
    let selectedType;
    if (document.getElementById('pant').checked) {
        selectedType = 'pant';
    } else if (document.getElementById('shorts').checked) {
        selectedType = 'shorts';
    } else if (document.getElementById('skirts').checked) {
        selectedType = 'skirts';
    }

    if (selectedType) {
        // Fetch and update bottom image
        fetch('get_random_image.php?type=' + selectedType)
            .then(response => response.json())
            .then(data => {
                if (data.image) {
                    document.getElementById('fillerbottom').src = data.image;
                } else {
                    alert('No images found for the selected type');
                }
            })
            .catch(error => console.error('Error:', error));
        
        // Fetch and update shirt image
        fetch('get_random_image.php?type=shirt')
            .then(response => response.json())
            .then(data => {
                if (data.image) {
                    document.getElementById('fillershirt').src = data.image;
                } else {
                    alert('No images found for shirts');
                }
            })
            .catch(error => console.error('Error:', error));
    } else {
        alert('Please select a type');
    }
});
</script>

<script>
function saveImageToDevice() {
    // Get the image sources
    var shirtImageSource = document.querySelector('#fillershirt').getAttribute('src');
    var bottomImageSource = document.querySelector('#fillerbottom').getAttribute('src');

    // Create canvas element for combining images
    var canvas = document.createElement('canvas');
    var ctx = canvas.getContext('2d');

    // Set canvas dimensions to match the desired output size
    var canvasWidth = 600; // Set canvas width
    var canvasHeight = 800; // Set canvas height
    canvas.width = canvasWidth;
    canvas.height = canvasHeight;

    // Create shirt image element
    var shirtImage = new Image();
    shirtImage.src = shirtImageSource;

    // Create bottom image element
    var bottomImage = new Image();
    bottomImage.src = bottomImageSource;

    // When both images are loaded, draw them on the canvas
    shirtImage.onload = function() {
        // Calculate dimensions to fit within canvas while maintaining aspect ratio
        var shirtAspectRatio = shirtImage.width / shirtImage.height;
        var shirtWidth = canvasWidth * 0.5; // Adjust width ratio here (e.g., 50% for half canvas)
        var shirtHeight = shirtWidth / shirtAspectRatio;

        // Draw shirt image on canvas
        ctx.drawImage(shirtImage, 0, 0, shirtWidth, shirtHeight);

        bottomImage.onload = function() {
            // Calculate dimensions to fit within canvas while maintaining aspect ratio
            var bottomAspectRatio = bottomImage.width / bottomImage.height;
            var bottomWidth = canvasWidth * 0.5; // Adjust width ratio here (e.g., 50% for half canvas)
            var bottomHeight = bottomWidth / bottomAspectRatio;

            // Draw bottom image on canvas
            ctx.drawImage(bottomImage, canvasWidth * 0.5, 0, bottomWidth, bottomHeight);

            // Convert canvas content to a data URL
            var combinedImage = canvas.toDataURL('image/jpeg');

            // Get the logged-in user's username (you may need to include this information from your PHP session)
            var username = '<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'defaultuser'; ?>';

            // Construct the file path where the image will be saved
            var filePath = 'accounts/' + username + '/CombinedOutfit.jpg';

            // AJAX request to save the image to the server
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'savet_to_account.php'); // Replace 'save_image.php' with your server-side script to handle image saving
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Image saved to your account!');
                } else {
                    alert('Failed to save image.');
                }
            };
            xhr.send(JSON.stringify({ image: combinedImage, path: filePath }));
        };
    };
}





</script>

</body>
</html>
