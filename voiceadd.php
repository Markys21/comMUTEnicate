<?php
// Ensure the database connection is established
include '../db_conn.php';

// Start the session
session_start();

// Check if the 'gate' session variable exists and is not empty
if (!isset($_SESSION['gate']) || empty($_SESSION['gate'])) {
    // Redirect to the index page
    header("location: index.php");
    exit;
}

// Continue with the rest of your code for authorized users
// You can access the 'gate' session variable using $_SESSION['gate']
$id = $_SESSION['gate'];

// Function to get the buttons from the database
function getButtons() {
    global $conn; // Add this line to access the $conn variable

    $query = "SELECT * FROM button ORDER BY id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $buttons = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $buttons;
    } else {
        return array();
    }
}

// Get the buttons from the database
$buttons = getButtons();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel = "icon" href = "../images/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <style>
    
  .container-fluid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 50px;
  }

 
  
  @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");:root{--header-height: 3rem;--nav-width: 68px;--first-color: #4723D9;--first-color-light: #AFA5D9;--white-color: #F7F6FB;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*,::before,::after{box-sizing: border-box}body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);font-size: var(--normal-font-size);transition: .5s}a{text-decoration: none}.header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem;background-color: var(--white-color);z-index: var(--z-fixed);transition: .5s}.header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}.header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}.header_img img{width: 40px}.l-navbar{position: fixed;top: 0;left: -30%;width: var(--nav-width);height: 100vh;background-color: var(--first-color);padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}.nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}.nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.5rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: var(--white-color)}.nav_logo-name{color: var(--white-color);font-weight: 700}.nav_link{position: relative;color: var(--first-color-light);margin-bottom: 1.5rem;transition: .3s}.nav_link:hover{color: var(--white-color)}.nav_icon{font-size: 1.25rem}.show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active{color: var(--white-color)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: var(--white-color)}.height-100{height:100vh}@media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}.body-pd{padding-left: calc(var(--nav-width) + 188px)}}
  *, *:before, *:after {
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.cover-all {

  font-size: 12px;
}

.cover-all, button, input {
  font-family: 'Montserrat', sans-serif;
  font-weight: 700;
  letter-spacing: 1.4px;
}

.background {
  display: flex;
  min-height: 50vh;
}

.container {
  flex: 0 1 700px;
  margin: auto;
  padding: 10px;
}

.screen {
  position: relative;
  background: #3e3e3e;
  border-radius: 15px;
}

.screen:after {
  content: '';
  display: block;
  position: absolute;
  top: 0;
  left: 20px;
  right: 20px;
  bottom: 0;
  border-radius: 15px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, .4);
  z-index: -1;
}

.screen-header {
  display: flex;
  align-items: center;
  padding: 10px 20px;
  background: #4d4d4f;
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
}

.screen-header-left {
  margin-right: auto;
}

.screen-header-button {
  display: inline-block;
  width: 8px;
  height: 8px;
  margin-right: 3px;
  border-radius: 8px;
  background: white;
}

.screen-header-button.close {
  background: #ed1c6f;
}

.screen-header-button.maximize {
  background: #e8e925;
}

.screen-header-button.minimize {
  background: #74c54f;
}

.screen-header-right {
  display: flex;
}

.screen-header-ellipsis {
  width: 3px;
  height: 3px;
  margin-left: 2px;
  border-radius: 8px;
  background: #999;
}

.screen-body {
  display: flex;
}

.screen-body-item {
  flex: 1;
  padding: 50px;
}

.screen-body-item.left {
  display: flex;
  flex-direction: column;
}

.app-title {
  display: flex;
  flex-direction: column;
  position: relative;
  color: #ea1d6f;
  font-size: 26px;
}

.app-title:after {
  content: '';
  display: block;
  position: absolute;
  left: 0;
  bottom: -10px;
  width: 25px;
  height: 4px;
  background: #ea1d6f;
}

.app-contact {
  margin-top: auto;
  font-size: 8px;
  color: #888;
}

.app-form-group {
  margin-bottom: 15px;
}

.app-form-group.message {
  margin-top: 40px;
}

.app-form-group.buttons {
  margin-bottom: 0;
  text-align: right;
}

.app-form-control {
  width: 100%;
  padding: 10px 0;
  background: none;
  border: none;
  border-bottom: 1px solid #666;
  color: #ddd;
  font-size: 14px;
  text-transform: uppercase;
  outline: none;
  transition: border-color .2s;
}

.app-form-control::placeholder {
  color: #666;
}

.app-form-control:focus {
  border-bottom-color: #ddd;
}

.app-form-button {
  background: none;
  border: none;
  color: #ea1d6f;
  font-size: 14px;
  cursor: pointer;
  outline: none;
}

.app-form-button:hover {
  color: #b9134f;
}

.credits {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
  color: #ffa4bd;
  font-family: 'Roboto Condensed', sans-serif;
  font-size: 16px;
  font-weight: normal;
}

.credits-link {
  display: flex;
  align-items: center;
  color: #fff;
  font-weight: bold;
  text-decoration: none;
}

.dribbble {
  width: 20px;
  height: 20px;
  margin: 0 5px;
}

@media screen and (max-width: 520px) {
  .screen-body {
    flex-direction: column;
  }

  .screen-body-item.left {
    margin-bottom: 30px;
  }

  .app-title {
    flex-direction: row;
  }

  .app-title span {
    margin-right: 12px;
  }

  .app-title:after {
    display: none;
  }
}

@media screen and (max-width: 600px) {
  .screen-body {
    padding: 40px;
  }

  .screen-body-item {
    padding: 0;
  }
}

</style>
</head>


<body>
<div id="body-pd">
  
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <h4>Add Voice Audio</h4>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
        <?php
            $select = mysqli_query($conn, "select * from users where id = '$id'") or die('query failed');
            if (mysqli_num_rows($select) > 0) {
              $fetch = mysqli_fetch_assoc($select);
            }
            ?>
            <div>  
              <a href="#" class="nav_logo">
        <i class='bx bx-layer nav_logo-icon'></i>
        <span class="nav_logo-name">
            <?php echo strtoupper($fetch['user_name']); ?>
        </span>
    </a>
                <div class="nav_list"> 
                  <a href="./userboard.php" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> 
                </a> 
                <a href="./voiceadd.php" class="nav_link"> <i class='bx bx-microphone nav_icon'></i> <span class="nav_name">Add Voice</span> 
              </a> 
              <a href="./textspeech.php" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Text to Speech</span> 
            </a> 
            <a href="./tutorial.php" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Tutorial</span> 
          </a> 
          <a href="./about.php" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">About</span> 
        </a> 
        <a href="./connect.php" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Connect us</span> 
      </a> 
    </div>
            </div> 
            <a id="ntb" href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <!--Container Main start-->

    <div class="cover-all">
    <div class="background">
  <div class="container">
    <div class="screen">
      <div class="screen-header">
        <div class="screen-header-left">
          <div class="screen-header-button close"></div>
          <div class="screen-header-button maximize"></div>
          <div class="screen-header-button minimize"></div>
        </div>
        <div class="screen-header-right">
          <div class="screen-header-ellipsis"></div>
          <div class="screen-header-ellipsis"></div>
          <div class="screen-header-ellipsis"></div>
        </div>
      </div>
      <div class="screen-body">
        <div class="screen-body-item left">
          <div class="app-title">
            <span>Add New</span>
            <span>Audio Record</span>
          </div>
          <div class="app-contact">comMUTEnicate</div>
        </div>
        <div class="screen-body-item">
        
          <div class="app-form">
            <div class="app-form-group">
            <form id="imageUploadForm" enctype="multipart/form-data">
            <label for="title" class="control-label">User</label>
          
              <input readonly type="text" name="user" id="user" class="form-control form-control-sm rounded-0" value="<?php echo ($fetch['user_name']); ?>" required/>
            </div>
            <div class="app-form-group">
            <label for="title" class="control-label">Title</label>
            <input type="text" placeholder="Name of the audio" name="title" id="title" class="form-control form-control-sm rounded-0" value="" required/>
            </div>
            <div class="app-form-group">
            <label for="" class="control-label">Image Banner</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input rounded-circle" id="customFile1" accept="image/*" onchange="previewImage(event, 'bannerPreview')">
              <label class="custom-file-label" for="customFile1">Choose file</label>
            </div>
            <!-- Image preview -->
            <img id="bannerPreview" src="#" alt="Banner Preview" class="mt-2" style="max-width: 100%; height: auto; display: none;">
            </div>
           
            <div class="app-form-group">
            <label for="" class="control-label">Audio File</label>
            <div class="custom-file mb-2">
              <input type="file" class="custom-file-input rounded-circle" id="customFile2" accept="audio/*" onchange="previewAudio(event)">
              <label class="custom-file-label" for="customFile2">Choose file</label>
            </div>
             <!-- Audio preview -->
             <audio id="audioPreview" controls style="display: none;"></audio>
            </div>
            <div class="app-form-group">
            <label for="categories" class="control-label">Categories</label>
    <select name="categories" id="categories" class="form-control form-control-sm rounded-0" required="required">
        <?php
        // Assuming you have a database connection established
        
        // Fetch the categories from the database
        $pdo = new PDO('mysql:host=localhost;dbname=capstone', 'root', '');
        $stmt = $pdo->prepare('SELECT * FROM voice_categ');
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Generate the options for the select element
        foreach ($categories as $category) {
            $categoryId = $category['voice_id'];
            $categoryName = $category['voice_name'];
            
            echo "<option value=\"$categoryId\">$categoryName</option>";
        }
        ?>
    </select>
            </div>
            <div class="app-form-group buttons">
        
              <button type="submit" class="app-form-button">Submit</button>
              </form>
            </div>
          </div>
          
        </div>
      
      </div>
    </div>
    
  </div>
</div>

    </div>   


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  
  function previewImage(event, previewId) {
  var input = event.target;
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      var previewElement = document.getElementById(previewId);
      previewElement.src = e.target.result;
      previewElement.style.display = "block";
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function previewAudio(event) {
  var input = event.target;
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      var audioPreview = document.getElementById('audioPreview');
      audioPreview.src = e.target.result;
      audioPreview.style.display = "block";
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function uploadImages(event) {
  event.preventDefault();
  var form = document.getElementById('imageUploadForm');
  var formData = new FormData(form);

   // Get feature image file and append it to the form data
   var customFile1 = document.getElementById('customFile1').files[0];
  formData.append('customFile1', customFile1);

  var customFile2 = document.getElementById('customFile2').files[0];
  formData.append('customFile2', customFile2);

  // Send Ajax request to the server
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'voiceupload.php', true); // Update the URL to point to your PHP file
  xhr.onload = function () {
    if (xhr.status === 200) {
      // Request successful, do something with the response
      Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Don't save`,
      }).then((result) => {
        if (result.isConfirmed) {
          const formInputs = document.getElementById('imageUploadForm').querySelectorAll('input');
          formInputs.forEach(input => input.value = "");

          Swal.fire({
            title: 'Saved!',
            icon: 'success',
            confirmButtonText: 'OK',
          }).then(() => {
            window.location.reload();
          });
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info');
        }
      });
    } else {
      // Error occurred during the request
      console.error(xhr.statusText);
    }
  };
  xhr.send(formData);
}

// Attach event listener to the form submit event
document.getElementById('imageUploadForm').addEventListener('submit', uploadImages);



  document.addEventListener("DOMContentLoaded", function(event) {
   
   const showNavbar = (toggleId, navId, bodyId, headerId) =>{
   const toggle = document.getElementById(toggleId),
   nav = document.getElementById(navId),
   bodypd = document.getElementById(bodyId),
   headerpd = document.getElementById(headerId)
   
   // Validate that all variables exist
   if(toggle && nav && bodypd && headerpd){
   toggle.addEventListener('click', ()=>{
   // show navbar
   nav.classList.toggle('show')
   // change icon
   toggle.classList.toggle('bx-x')
   // add padding to body
   bodypd.classList.toggle('body-pd')
   // add padding to header
   headerpd.classList.toggle('body-pd')
   })
   }
   }
   
   showNavbar('header-toggle','nav-bar','body-pd','header')
   
   /*===== LINK ACTIVE =====*/
   const linkColor = document.querySelectorAll('.nav_link')
   
   function colorLink(){
   if(linkColor){
   linkColor.forEach(l=> l.classList.remove('active'))
   this.classList.add('active')
   }
   }
   linkColor.forEach(l=> l.addEventListener('click', colorLink))
   
    // Your code to run since DOM is loaded and ready
   });

   
</script>
<script>
 $("#ntb").click(function (e) {

e.preventDefault(); // Prevent the default navigation behavior

Swal.fire({
  title: 'Logout',
  text: 'Are you sure you want to logout?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, logout',
  cancelButtonText: 'Cancel'
}).then((result) => {
  if (result.isConfirmed) {
    // Perform logout actions here
    window.location.href = "./index.php"; // Redirect to the logout page
  }
});
});

</script>
</div>
</html>