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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    


 
#img-3{
  width: 10vw;
}
  
  @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");:root{--header-height: 3rem;--nav-width: 68px;--first-color: #4723D9;--first-color-light: #AFA5D9;--white-color: #F7F6FB;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*,::before,::after{box-sizing: border-box}body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);font-size: var(--normal-font-size);transition: .5s}a{text-decoration: none}.header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem;background-color: var(--white-color);z-index: var(--z-fixed);transition: .5s}.header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}.header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}.header_img img{width: 40px}.l-navbar{position: fixed;top: 0;left: -30%;width: var(--nav-width);height: 100vh;background-color: var(--first-color);padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}.nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}.nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.5rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: var(--white-color)}.nav_logo-name{color: var(--white-color);font-weight: 700}.nav_link{position: relative;color: var(--first-color-light);margin-bottom: 1.5rem;transition: .3s}.nav_link:hover{color: var(--white-color)}.nav_icon{font-size: 1.25rem}.show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active{color: var(--white-color)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: var(--white-color)}.height-100{height:100vh}@media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}.body-pd{padding-left: calc(var(--nav-width) + 188px)}}
  *, *:before, *:after {
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.carousel-item {
  text-align: center;
  padding: 30px;
  background-color: antiquewhite;
  font-weight: 700; /* Set font-weight to 700 for bolder text */
  color: wheatewhite;
  text-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5); /* Add a subtle text shadow */
  font-family: Arial, sans-serif; /* Font family */
  text-shadow:
    -1px -1px 0 #000, /* Top-left border */
    1px -1px 0 #000,  /* Top-right border */
    -1px 1px 0 #000,  /* Bottom-left border */
    1px 1px 0 #000;   /* Bottom-right border */
    border-radius: 40px;
}


.carousel-content1 {
  max-width: 600px;
  margin: 0 auto;
  background-image: url('./assets/img/about1.png');
  border-radius: 20px;
  padding: 40px;
}

.carousel-content2 {
  max-width: 600px;
  margin: 0 auto;
  background-image: url('./assets/img/about2.png');
  border-radius: 20px;
  padding: 40px;
}
.carousel-content3 {
  max-width: 600px;
  margin: 0 auto;
  background-image: url('./assets/img/about3.png');
  border-radius: 20px;
  padding: 40px;
}
#myCarousel{
  height: 60vh;
  display: flex;
  justify-content: center;
  align-items: center;
  
}


/* Custom styles for carousel */
.carousel-item .person-about {
  text-align: center;
  margin-bottom: 20px;
}

.carousel-item .divider {
  height: 1px;
  background-color: #020000;
  margin: 10px 0;
}

.carousel-item .name {
  font-weight: bold;
}

.carousel-item .title {
  color: #9c4a4a;
}



/* Developers */
@import url("https://fonts.googleapis.com/css2?family=Merriweather:wght@900&family=Sumana:wght@700&display=swap");
.boody {
  align-items: center;
  background-color: inherit;
  display: flex;
  font-family: "Merriweather", serif;
  flex-wrap: wrap;
  justify-content: center;
  height: auto;
  margin: 0;
}
.person-about {
  align-items: center;
  display: flex;
  flex-direction: column;
  width: 280px;
}
.container-about {
  border-radius: 50%;
  height: 312px;
  -webkit-tap-highlight-color: transparent;
  transform: scale(0.48);
  transition: transform 250ms cubic-bezier(0.4, 0, 0.2, 1);
  width: 400px;
}
.container-about:after {
 
  content: "";
  height: 10px;
  position: absolute;
  top: 390px;
  width: 100%;
}
.container-about:hover {
  transform: scale(0.54);
}
.container-inner {
  clip-path: path(
    "M 390,400 C 390,504.9341 304.9341,590 200,590 95.065898,590 10,504.9341 10,400 V 10 H 200 390 Z"
    );
  position: relative;
  transform-origin: 50%;
  top: -200px;
}
.circle-about {

  border-radius: 50%;
  cursor: pointer;
  height: 380px;
  /* left: 10px; */
  pointer-events: none;
  position: absolute;
  top: 210px;
  width: 380px;
}
.img {
  pointer-events: none;
  position: relative;
  transform: translateY(20px) scale(1.15);
  transform-origin: 50% bottom;
  transition: transform 300ms cubic-bezier(0.4, 0, 0.2, 1);
}
.container-about:hover .img {
  transform: translateY(0) scale(1.2);
}
.img1 {
  left: 5px;
  top: 164px;
  width: 340px;
}
.img2 {
  left: -420px;
  top: 100px;
  width: 800px;
}
.img3 {
  left: -550px;
  top: 40px;
  width: 900px;
}

.img4 {
  left: -10px;
  top: 220px;
  width: 350px;
}

.img5 {
  left: -120px;
  top:  50px;
  width: 600px;
}


.divider {
  background-color: #ca6060;
  height: 1px;
  width: 160px;
}
.name {
  
  font-size: 36px;
  font-weight: 600;
  margin-top: 16px;
  text-align: center;
}
.title {
  color: #6e6e6e;
  font-family: arial;
  font-size: 14px;
  font-style: italic;
  margin-top: 4px;
}






</style>
</head>


<body>
<div id="body-pd">
  
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <h4>About</h4>
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

    <div class="container text-center">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Slides -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="carousel-content1 p-5">
        <h3>Our Community</h3>
        <p>Our community is a crucible of experiences and capabilities, from software developers, biomedical engineers, speech therapists, families, and people with disabilities. We treat ourselves as equals with respect and empathy.</p>
      </div>
    </div>
    <div class="carousel-item">
      <div class="carousel-content2 p-5">
        <h3>Our Vision</h3>
        <p>Be a global one-stop solution for technological solutions for people with disabilities. With innovation, affordability, and empathy as key motivators and guidelines.</p>
      </div>
    </div>
    <div class="carousel-item">
      <div class="carousel-content3 p-5">
        <h3>Our Mission</h3>
        <p>Everyday we work to improve people with disabilities' lifestyle by returning the voice to all those who have lost it; we are sure that technology can empower people with disabilities.</p>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

 <!-- Developers -->
 <section>
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2 class="text-center">OUR TEAM</h2>
            </div>

            <!-- Carousel -->
            <div id="developerCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">

                    <!-- First Slide -->
                    <div class="carousel-item active">
                        <div class="container-fluid body">
                            <div class="row">
                                <!-- JM -->
                                <div class="col-sm-12 col-md-6 col-lg-4 person-about">
                                <div class="container-about">
        <div class="container-inner">
          
        <img
            class="circle-about"
            src="./assets/img/about/bg-1.avif"
          />
          <img
            class="img img1"
            src="./assets/img/about/JM-img-removebg-preview.png"/>
        </div>
      </div>
      <div class="divider"></div>
      <div class="name">John Mark</div>
      <div class="title">Developer</div>
                                </div>

                                <!-- Edward -->
                                <div class="col-sm-12 col-md-6 col-lg-4 person-about">
                                <div class="container-about">
        <div class="container-inner">
          <img
            class="circle-about"
            src="./assets//img/about//bg-2.jpg"
          />
          <img
            class="img img2"
            src="./assets/img/about/joe-img.png"
          />
        </div>
      </div>
      <div class="divider"></div>
      <div class="name">Edward</div>
      <div class="title">Developer</div>
                                </div>

                                <!-- Nadine -->
                                <div class="col-sm-12 col-md-6 col-lg-4 person-about">
                                <div class="container-about">
        <div class="container-inner">
          <img
            class="circle-about"
            src="./assets/img/about/bg-3.jpg"
          />
          <img
            class="img img3"
            src="./assets/img/about/nadine.png"
          />
        </div>
      </div>
      <div class="divider"></div>
      <div class="name">Nadine</div>
      <div class="title">Developer</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Second Slide -->
                    <div class="carousel-item">
                        <div class="container-fluid body">
                            <div class="row">
                                <!-- Jelleca -->
                                <div class="col-sm-12 col-md-6 col-lg-6 person-about">
                                <div class="container-about">
        <div class="container-inner">
          <img
            class="circle-about"
            src="./assets/img/about/bg-4.jpg"
          />
          <img
            class="img img4"
            src="./assets/img/about/jelleca.png"
          />
        </div>
      </div>
      <div class="divider"></div>
      <div class="name">Jelleca</div>
      <div class="title">Developer</div>
                                </div>

                                <!-- Rey -->
                                <div class="col-sm-12 col-md-6 col-lg-6 person-about">
                                <div class="container-about">
        <div class="container-inner">
          <img
            class="circle-about"
            src="./assets/img/about/bg-5.jpg"
          />
          <img
            class="img img5"
            src="./assets/img/about/rey-removebg-preview.png"
          />
        </div>
      </div>
      <div class="divider"></div>
      <div class="name">Rey</div>
      <div class="title">Developer</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Carousel controls -->
                <a class="carousel-control-prev text-black" href="#developerCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next text-black" href="#developerCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        </div>
    </section>



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