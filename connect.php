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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <style>
    

 
  
  @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");:root{--header-height: 3rem;--nav-width: 68px;--first-color: #4723D9;--first-color-light: #AFA5D9;--white-color: #F7F6FB;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*,::before,::after{box-sizing: border-box}body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);font-size: var(--normal-font-size);transition: .5s}a{text-decoration: none}.header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem;background-color: var(--white-color);z-index: var(--z-fixed);transition: .5s}.header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}.header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}.header_img img{width: 40px}.l-navbar{position: fixed;top: 0;left: -30%;width: var(--nav-width);height: 100vh;background-color: var(--first-color);padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}.nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}.nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.5rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: var(--white-color)}.nav_logo-name{color: var(--white-color);font-weight: 700}.nav_link{position: relative;color: var(--first-color-light);margin-bottom: 1.5rem;transition: .3s}.nav_link:hover{color: var(--white-color)}.nav_icon{font-size: 1.25rem}.show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active{color: var(--white-color)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: var(--white-color)}.height-100{height:100vh}@media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}.body-pd{padding-left: calc(var(--nav-width) + 188px)}}
  *, *:before, *:after {
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}


.img-fluid{
  width: 150px; /* Adjust the size as needed */
      height: 80px; /* Make sure width and height are the same for a perfect circle */
      border-radius: 50%; /* Set the border-radius to 50% to create a circle */
      object-fit: cover;

}
 
#img-3{
  width: 10vw;
}

</style>
</head>


<body>
<div id="body-pd">
  
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <h4>Connect</h4>
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

    <div class="container text-center mb-5" style="margin-top: 100px;">
   
<div class="container">
  <h1 class="text-center border-bottom">News from comMUTEnicate - Assistive Communication Board</h1>
  <p class="text-center">Updates on our activities and progress.</p>
</div>
<div class ="container">
<div class="container mt-5">
    <!-- Search bar -->
    <div class="row">
      <div class="col-9">

      </div>
      <div class = "col-3">
    <input type="text" id="searchInput" class="form-control mb-3 p-4" placeholder="Search by topic">
    </div>
    </div>
    <!-- Cards container -->
    <div class="row" id="cardsContainer">
      <!-- Cards will be dynamically added here -->
    </div>
  </div>
</div>





</div>

<footer class="pt-4 pb-2 bg-light">
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-4">
        <img id="img-3" src="../images/logo.png" alt="Logo">
      </div>
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-6">
            <h5>Contact</h5>
            <p>Email: contact@example.com</p>
            <p>Phone: (123) 456-7890</p>
          </div>
          <div class="col-md-6">
            <h5>Other Info</h5>
            <p>About Us</p>
            <p>Privacy Policy</p>
            <p>Terms of Service</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12 text-center">
        <p>&copy; 2023 Your Company. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>


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

   $(document).ready(function() {
      // Sample data for cards
      const data = [
        { title: 'comMUTEnicate enters usability testing phase, early feedback [week 1-2]', topic: 'Published on August 21, 2018 by Shay Cojocaru', content: 'Preparing for testing In the weeks before beginning usability testing, we contacted three speech rehabilitation centers in central Buenos Aires, two of which replied they had eligible candidates and would participate in the testing. The fir...' },
        { title: 'Hello World!', topic: 'Published on February 21, 2018 by Shay Cojocaru', 
          content: 'This is our first update, we\'ve just started work on the server, this will allow user logins and user profiles. We will keep you posted with each milestone achieved - hurray!' },
 
      ];

      // Function to create cards and add them to the container
      function createCards() {
        const searchInput = $('#searchInput').val().toLowerCase();
        const filteredData = data.filter(item => item.title.toLowerCase().includes(searchInput));

        $('#cardsContainer').empty();
        filteredData.forEach(item => {
          const card = `
            <div class="col-md-12 mb-4">
              <div class="card">
                <div class="card-body row">
                <div class="col-1">
                <div class="rounded-circle p-1 bg-info">
      <img class="img-fluid rounded-circle" src="./assets/img/b.jpg" alt="Profile Image">
    </div>
                </div>
                <div class="col-11 text-start">
                  <h5 class="card-title">${item.title}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">${item.topic}</h6>
                  <p class="card-text">${item.content}</p>
                  </div>
                </div>
              </div>
            </div>
          `;
          $('#cardsContainer').append(card);
        });
      }

      // Initial card creation
      createCards();

      // Filter cards on search input change
      $('#searchInput').on('input', createCards);
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