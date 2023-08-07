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
     <!-- DataTables -->
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <style>
    

 
  
  @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");:root{--header-height: 3rem;--nav-width: 68px;--first-color: #4723D9;--first-color-light: #AFA5D9;--white-color: #F7F6FB;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*,::before,::after{box-sizing: border-box}body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);font-size: var(--normal-font-size);transition: .5s}a{text-decoration: none}.header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem;background-color: var(--white-color);z-index: var(--z-fixed);transition: .5s}.header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}.header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}.header_img img{width: 40px}.l-navbar{position: fixed;top: 0;left: -30%;width: var(--nav-width);height: 100vh;background-color: var(--first-color);padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}.nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}.nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.5rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: var(--white-color)}.nav_logo-name{color: var(--white-color);font-weight: 700}.nav_link{position: relative;color: var(--first-color-light);margin-bottom: 1.5rem;transition: .3s}.nav_link:hover{color: var(--white-color)}.nav_icon{font-size: 1.25rem}.show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active{color: var(--white-color)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: var(--white-color)}.height-100{height:100vh}@media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}.body-pd{padding-left: calc(var(--nav-width) + 188px)}}
  *, *:before, *:after {
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}



</style>
</head>


<body>
<div id="body-pd">
  
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <h4>Your added archived Voice</h4>
        <a id="arch" class="text-white btn btn-info btn-sm">Go Back</a>
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

   
    <div class="container-fluid">
  <div class="row">

    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div style="overflow:auto;" class="table-scrollable">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Voice</th>
                  <th>Categories</th>
                  <th>Banner</th>
                  <th>Status</th>
                  <th>Action</th>


                </tr>
              </thead>
              <tbody>
                <?php

                include '../db_conn.php';
                $user = $fetch['user_name'];
                $sql = mysqli_query(
                  $conn,
                  "select * from button where status = 4 AND user = '$user' order by id desc"
                );
                $i = 1;
                while ($result = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td>
                      <?php
                      echo $i . '.';
                      $i++;
                      ?>
                    </td>

                    <td>
                      <?php
                      echo $result['label'];
                      ?>
                    </td>

                    <td>
                      <?php
                      $audioFileName = $result['voice_audio'];
                      ?>
                      <audio controls>
                        <source src="../images/audio/<?php echo $audioFileName; ?>" type="audio/mp3">
                        Your browser does not support the audio element.
                      </audio>
                    </td>

                    <td>
                      <?php
                     $uid = $result['categ'];
                     $search = mysqli_query($conn, "select * from voice_categ where voice_id=$uid");
                     $res = mysqli_fetch_array($search);
                     echo $res['voice_name'];
                      ?>
                    </td>

                    <td>
                    <a href="../images/<?php echo $result['icon']?>" target="_blank">
                      <img src="../images/<?php echo $result['icon']?>" alt="Your Image" style="width: 50px; height: 50px;">
                      </a>
                    </td>

                    <td>
                      <?php
                      $status = $result['status'];
                      $badgeClass = ($status == 4) ? 'badge-warning' : 'badge-success';
                      $statusText = ($status == 4) ? 'Unpublish' : 'Publish';
                      ?>
                      <span class="badge <?php echo $badgeClass; ?>"><?php echo $statusText; ?></span>
                    </td>
                    <td>
                   
                      <a href="voiceedit.php&editvoiceid=<?php echo md5($result['id']); ?>"
                        editvoiceide="<?php echo $result['id']; ?>" class="btn btn-info btn-sm">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit info</a>

                    <a voiceid="<?php echo $result['id']; ?>"
                        class="btn btn-warning btnapproveevent btn-sm"><i class="fas fa-check" class="nav-link">
                        </i> Retrieved</a>
                    </td>
               
                    <?php
                } ?>
               


                  
                 



          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->


<script src="./plugins/jquery/jquery.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="./plugins/jszip/jszip.min.js"></script>
  <script src="./plugins/pdfmake/pdfmake.min.js"></script>
  <script src="./plugins/pdfmake/vfs_fonts.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
<script>
  $(function () {
      $("#example1").DataTable({
        "responsive": false,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

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

$("#arch").click(function (e) {

e.preventDefault(); // Prevent the default navigation behavior

Swal.fire({
    title: 'Approved Page',
  text: 'Are you sure you want to go Approved page?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, I want',
  cancelButtonText: 'Cancel'
}).then((result) => {
  if (result.isConfirmed) {
    // Perform logout actions here
    window.location.href = "./usertable.php"; // Redirect to the logout page
  }
});
});

</script>
<script>
  $(document).ready(function() {
  var voiceid = "0";
 
  $('.btnapproveevent').click(function () {
    voiceid = $(this).attr('voiceid');  
    Swal.fire({
      title: 'Confirmation',
      html: '<input type="password" id="passwordInput" class="swal2-input" placeholder="Enter your password">',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        var password = $('#passwordInput').val();
        
        if (password === '') {
          showAlert('Password Required');
        } else {
          $.ajax({
            url: './approve.php',
            method: 'post',
            data: {
              voiceid: voiceid,
              password: password,
              id: "<?php echo $id; ?>"
            },
            success: function (response) {
              if (response === 'approved') {
                // Additional actions after successful approval
                Swal.fire({
                  title: 'Approved!',
                  text: 'Your file has been approved.',
                  icon: 'success'
                }).then(() => {
                  window.location.reload();
                });
              } else {
                Swal.fire({
                  title: 'Error!',
                  text: 'Your file could not be approved.',
                  icon: 'error'
                });
              }
            }
          });
        }
      }
    });
  });
});
</script>
</div>
</html>