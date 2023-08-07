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

  .draggableButton {
    width: 200px;
    height: 200px;
    margin: 10px;
    cursor: move;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 10px;
  }

  .buttonIcon {
    font-size: 36px;
    margin-bottom: 10px;
  }
  @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");:root{--header-height: 3rem;--nav-width: 68px;--first-color: #4723D9;--first-color-light: #AFA5D9;--white-color: #F7F6FB;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*,::before,::after{box-sizing: border-box}body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);font-size: var(--normal-font-size);transition: .5s}a{text-decoration: none}.header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem;background-color: var(--white-color);z-index: var(--z-fixed);transition: .5s}.header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}.header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}.header_img img{width: 40px}.l-navbar{position: fixed;top: 0;left: -30%;width: var(--nav-width);height: 100vh;background-color: var(--first-color);padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}.nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}.nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.5rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: var(--white-color)}.nav_logo-name{color: var(--white-color);font-weight: 700}.nav_link{position: relative;color: var(--first-color-light);margin-bottom: 1.5rem;transition: .3s}.nav_link:hover{color: var(--white-color)}.nav_icon{font-size: 1.25rem}.show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active{color: var(--white-color)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: var(--white-color)}.height-100{height:100vh}@media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}.body-pd{padding-left: calc(var(--nav-width) + 188px)}}
  
</style>
</head>


<body>
<div id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        
        <h4>Activities / <a href="./userboard.php">Go Back</a></h4>
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
    <div class="d-none d-sm-block">
    <div class="bg-info h-25 container-fluid row">
<?php

$sql = mysqli_query($conn, 
"select * from button where history = 0 and historyremove = 1 order by id"); 

// Assuming you have executed the query and fetched the results into $buttons
foreach ($sql as $button) {
  echo '<div class="col-sm-12 col-md-6 col-lg-2">';
  echo '<button historyid="' . $button["id"] . '" class="cards card_image audioButton btn btn-primary draggableButton" draggable="true" data-id="' . $button["id"] . '" style="background-image: url(\'../images/' . $button["icon"] . '\'); background-size: cover;  background-repeat: no-repeat; border-radius: 40px; box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22); cursor: pointer; transition: 0.4s;">
  <div class="buttonBackground"  style="background-position: center; width: inherit; height: inherit; border-radius: 30px;"></div>
  <div class="buttonContent">
      <span class="buttonLabel card_title text-warning" style="text-align: center; border-radius: 0px 0px 40px 40px; font-family: sans-serif; font-weight: bold; font-size: 30px; margin-top: -80px; height: 40px;">' . $button["label"] . '</span>
  </div>
</button>
<audio class="clickSound" id="clickSound_' . $button["id"] . '">
  <source src="../images/audio/' . $button["voice_audio"] . '" type="audio/mpeg">
</audio>';
echo '</div>';
}

?>
</div>
    </div>
<div class="container d-none d-sm-block">
<div class="row">
<?php
$buttons = mysqli_query($conn, 
"SELECT * FROM button WHERE label IN ('yes', 'no') AND historyremove = 1 AND status = 1 ORDER BY id"); 

if (mysqli_num_rows($buttons) > 0) {
    foreach ($buttons as $button) {
      echo '<div class="col-sm-12 col-md-4 col-lg-2">';
        echo '<button historyid1="' . $button["id"] . '" class="cards card_image audioButton1 btn btn-primary draggableButton" draggable="true" data-id="' . $button["id"] . '" style="background-image: url(\'../images/' . $button["icon"] . '\'); background-size: cover;  background-repeat: no-repeat; border-radius: 40px; box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22); cursor: pointer; transition: 0.4s;">
            <div class="buttonBackground"  style="background-position: center; width: inherit; height: inherit; border-radius: 30px;"></div>
            <div class="buttonContent">
                <span class="buttonLabel card_title text-warning" style="text-align: center; border-radius: 0px 0px 40px 40px; font-family: sans-serif; font-weight: bold; font-size: 30px; margin-top: -80px; height: 40px;">' . $button["label"] . '</span>
            </div>
        </button>
        <audio class="clickSound" id="clickSound_' . $button["id"] . '">
            <source src="../images/audio/' . $button["voice_audio"] . '" type="audio/mpeg">
        </audio>';
        echo '</div>';
    }
} else {
    echo "No buttons found with 'yes' or 'no' label.";
}
?>
<?php

$buttons1 = mysqli_query($conn, "SELECT * FROM button WHERE historyremove = 1 AND status = 1 AND categ = 6 AND user = '' ORDER BY id");

if (mysqli_num_rows($buttons1) > 0) {
  foreach ($buttons1 as $button) {
    // Check if the user column is empty
    if (empty($button["user"])) {
      echo '<div class="col-sm-12 col-md-4 col-lg-2">';
      echo '<button historyid1="' . $button["id"] . '" class="cards card_image audioButton1 btn btn-primary draggableButton" draggable="true" data-id="' . $button["id"] . '" style="background-image: url(\'../images/' . $button["icon"] . '\'); background-size: cover;  background-repeat: no-repeat; border-radius: 40px; box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22); cursor: pointer; transition: 0.4s;">
        <div class="buttonBackground"  style="background-position: center; width: inherit; height: inherit; border-radius: 30px;"></div>
        <div class="buttonContent">
            <span class="buttonLabel card_title text-warning" style="text-align: center; border-radius: 0px 0px 40px 40px; font-family: sans-serif; font-weight: bold; font-size: 30px; margin-top: -80px; height: 40px;">' . $button["label"] . '</span>
        </div>
      </button>
      <audio class="clickSound" id="clickSound_' . $button["id"] . '">
        <source src="../images/audio/' . $button["voice_audio"] . '" type="audio/mpeg">
      </audio>';
      echo '</div>';
    }
  }
} else {
 
}
?>

<?php
$user =  $fetch['user_name'];
$buttons1 = mysqli_query($conn, 
"SELECT * FROM button WHERE historyremove = 1 AND status = 1 AND categ = 6 AND user = '$user' ORDER BY id"); 

if (mysqli_num_rows($buttons1) > 0) {
    foreach ($buttons1 as $button) {
      echo '<div class="col-sm-12 col-md-4 col-lg-2">';
        echo '<button historyid1="' . $button["id"] . '" class="cards card_image audioButton1 btn btn-primary draggableButton" draggable="true" data-id="' . $button["id"] . '" style="background-image: url(\'../images/' . $button["icon"] . '\'); background-size: cover;  background-repeat: no-repeat; border-radius: 40px; box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22); cursor: pointer; transition: 0.4s;">
            <div class="buttonBackground"  style="background-position: center; width: inherit; height: inherit; border-radius: 30px;"></div>
            <div class="buttonContent">
                <span class="buttonLabel card_title text-warning" style="text-align: center; border-radius: 0px 0px 40px 40px; font-family: sans-serif; font-weight: bold; font-size: 30px; margin-top: -80px; height: 40px;">' . $button["label"] . '</span>
            </div>
        </button>
        <audio class="clickSound" id="clickSound_' . $button["id"] . '">
            <source src="../images/audio/' . $button["voice_audio"] . '" type="audio/mpeg">
        </audio>';
        echo '</div>';
    }
} else {
    echo "No buttons found with 'yes' or 'no' label.";
}
?>
</div>
</div>
    

</div>
    <!--Container Main end-->

    <div class="d-sm-none">
    <div class="bg-info h-25 container-fluid row">
    <div class="d-flex flex-row">
<?php

$sql = mysqli_query($conn, 
"select * from button where history = 0 and historyremove = 1 order by id"); 

// Assuming you have executed the query and fetched the results into $buttons
foreach ($sql as $button) {
  echo '<div class="col-sm-2">';
  echo '<button historyid="' . $button["id"] . '" class="cards card_image audioButton btn btn-primary draggableButton" draggable="true" data-id="' . $button["id"] . '" style="background-image: url(\'../images/' . $button["icon"] . '\'); background-size: cover;  background-repeat: no-repeat; width: 100%; height: 100px;  border-radius: 10px; box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22); cursor: pointer; transition: 0.4s;">
  <div class="buttonBackground"  style="background-position: center; width: inherit; height: inherit; border-radius: 30px;"></div>
  <div class="buttonContent">
      <span class="buttonLabel card_title text-warning" style="text-align: center; border-radius: 0px 0px 40px 40px; font-family: sans-serif; font-weight: bold; font-size: 16px; margin-top: -80px; height: 40px;">' . $button["label"] . '</span>
  </div>
</button>
<audio class="clickSound" id="clickSound_' . $button["id"] . '">
  <source src="../images/audio/' . $button["voice_audio"] . '" type="audio/mpeg">
</audio>';
echo '</div>';
}

?>
</div>
    </div>
    </div>
    
    <div style="margin-left: -69px;" class="d-sm-none">
    <div class="row">
        <div class="d-flex flex-row">
            <?php
            $buttons = mysqli_query($conn, 
                "SELECT * FROM button WHERE label IN ('yes', 'no') AND historyremove = 1 AND status = 1 ORDER BY id"); 

            $counter = 0; // Initialize counter
            if (mysqli_num_rows($buttons) > 0) {
                foreach ($buttons as $button) {
             

                    echo '<div class="col-sm-4">'; // Use col-sm-4 instead of col-sm-3 to fit three items per row
                    echo '<button historyid1="' . $button["id"] . '" class="cards card_image audioButton1 btn btn-primary draggableButton" draggable="true" data-id="' . $button["id"] . '" style="background-image: url(\'../images/' . $button["icon"] . '\'); background-size: cover;  background-repeat: no-repeat; width: 100%; height: 100px; border-radius: 10px; box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22); cursor: pointer; transition: 0.4s;">
                            <div class="buttonBackground" style="background-position: center; width: inherit; height: inherit; border-radius: 30px;"></div>
                            <div class="buttonContent">
                                <span class="buttonLabel card_title text-warning" style="text-align: center; border-radius: 0px 0px 40px 40px; font-family: sans-serif; font-weight: bold; font-size: 16px;">' . $button["label"] . '</span>
                            </div>
                        </button>
                        <audio class="clickSound" id="clickSound_' . $button["id"] . '">
                            <source src="../images/audio/' . $button["voice_audio"] . '" type="audio/mpeg">
                        </audio>';
                    echo '</div>';

               
                }
            } else {
                echo "No buttons found with 'yes' or 'no' label.";
            }
            ?>
            
        </div>
        <?php

$buttons1 = mysqli_query($conn, "SELECT * FROM button WHERE historyremove = 1 AND status = 1 AND categ = 6 AND user = '' ORDER BY id");

$counter = 0; // Initialize counter
if (mysqli_num_rows($buttons1) > 0) {
  foreach ($buttons1 as $button) {
    // Check if the user column is empty
    if (empty($button["user"])) {
      // Check if the counter reaches three
      if ($counter % 3 === 0) {
        echo '</div><div class="d-flex flex-row">'; // Close the current row and start a new one
      }

      echo '<div class="col-sm-4">'; // Use col-sm-4 instead of col-sm-3 to fit three items per row
      echo '<button historyid1="' . $button["id"] . '" class="cards card_image audioButton1 btn btn-primary draggableButton" draggable="true" data-id="' . $button["id"] . '" style="background-image: url(\'../images/' . $button["icon"] . '\'); background-size: cover;  background-repeat: no-repeat; width: 100%; height: 100px; border-radius: 10px; box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22); cursor: pointer; transition: 0.4s;">
        <div class="buttonBackground" style="background-position: center; width: inherit; height: inherit; border-radius: 30px;"></div>
        <div class="buttonContent">
            <span class="buttonLabel card_title text-warning" style="text-align: center; border-radius: 0px 0px 40px 40px; font-family: sans-serif; font-weight: bold; font-size: 16px; margin-top: -80px; height: 40px;">' . $button["label"] . '</span>
        </div>
      </button>
      <audio class="clickSound" id="clickSound_' . $button["id"] . '">
        <source src="../images/audio/' . $button["voice_audio"] . '" type="audio/mpeg">
      </audio>';
      echo '</div>';

      $counter++; // Increment the counter
    }
  }
} else {
 
}
?>

        <?php
        $user =  $fetch['user_name'];

            $buttons1 = mysqli_query($conn, 
                "SELECT * FROM button WHERE historyremove = 1 AND status = 1 AND categ = 6 AND user = '$user' ORDER BY id"); 

            $counter = 0; // Initialize counter
            if (mysqli_num_rows($buttons1) > 0) {
                foreach ($buttons1 as $button) {
                    // Check if the counter reaches three
                    if ($counter % 3 === 0) {
                        echo '</div><div class="d-flex flex-row">'; // Close the current row and start a new one
                    }

                    echo '<div class="col-sm-4">'; // Use col-sm-4 instead of col-sm-3 to fit three items per row
                    echo '<button historyid1="' . $button["id"] . '" class="cards card_image audioButton1 btn btn-primary draggableButton" draggable="true" data-id="' . $button["id"] . '" style="background-image: url(\'../images/' . $button["icon"] . '\'); background-size: cover;  background-repeat: no-repeat; width: 100%; height: 100px; border-radius: 10px; box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22); cursor: pointer; transition: 0.4s;">
                            <div class="buttonBackground" style="background-position: center; width: inherit; height: inherit; border-radius: 30px;"></div>
                            <div class="buttonContent">
                                <span class="buttonLabel card_title text-warning" style="text-align: center; border-radius: 0px 0px 40px 40px; font-family: sans-serif; font-weight: bold; font-size: 16px; margin-top: -80px; height: 40px;">' . $button["label"] . '</span>
                            </div>
                        </button>
                        <audio class="clickSound" id="clickSound_' . $button["id"] . '">
                            <source src="../images/audio/' . $button["voice_audio"] . '" type="audio/mpeg">
                        </audio>';
                    echo '</div>';

                    $counter++; // Increment the counter
                }
            } else {
                echo "No buttons found with 'yes' or 'no' label.";
            }
            ?>
    </div>
</div>

  
    <!--Container Main end-->
           
            
            
           

          


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  
      <!-- sweetalert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var audioButtons = document.getElementsByClassName("audioButton");
  var activeAudioElement = null;
 
  var historyAudios = [];

  function playAudio(buttonId) {
    if (activeAudioElement) {
      activeAudioElement.pause();
    }
    var audioElement = document.getElementById("clickSound_" + buttonId);
    audioElement.currentTime = 0; // Reset audio to the beginning
    audioElement.play();
    activeAudioElement = audioElement;

    // Store audio in history
    var buttonLabel = document.querySelector('[data-id="' + buttonId + '"]').innerHTML;
    var historyItem = document.createElement("li");
    historyItem.textContent = buttonLabel;
   
    historyAudios.push(audioElement);
  }

  Array.from(audioButtons).forEach(function(button) {
    button.addEventListener("click", function() {
      var buttonId = this.getAttribute("data-id");
      playAudio(buttonId);
    });
  });

  var audioButtons = document.getElementsByClassName("audioButton1");
  var activeAudioElement = null;
  
  var historyAudios = [];

  function playAudio(buttonId) {
    if (activeAudioElement) {
      activeAudioElement.pause();
    }
    var audioElement = document.getElementById("clickSound_" + buttonId);
    audioElement.currentTime = 0; // Reset audio to the beginning
    audioElement.play();
    activeAudioElement = audioElement;

    // Store audio in history
    var buttonLabel = document.querySelector('[data-id="' + buttonId + '"]').innerHTML;
    var historyItem = document.createElement("li");
    historyItem.textContent = buttonLabel;
 
    historyAudios.push(audioElement);
  }

  Array.from(audioButtons).forEach(function(button) {
    button.addEventListener("click", function() {
      var buttonId = this.getAttribute("data-id");
      playAudio(buttonId);
    });
  });



 

  // Function to handle the button drag and drop functionality
  function handleButtonDragAndDrop() {
    var draggableButtons = document.querySelectorAll('.draggableButton');
    var dragSrcElement = null;

    // Function to handle the drag start event
    function handleDragStart(event) {
      dragSrcElement = this;
      event.dataTransfer.effectAllowed = 'move';
      event.dataTransfer.setData('text/html', this.innerHTML);
    }

    // Function to handle the drag over event
    function handleDragOver(event) {
      if (event.preventDefault) {
        event.preventDefault();
      }
      event.dataTransfer.dropEffect = 'move';
      return false;
    }

    // Function to handle the drag enter event
    function handleDragEnter(event) {
      this.classList.add('over');
    }

    // Function to handle the drag leave event
    function handleDragLeave(event) {
      this.classList.remove('over');
    }

    // Function to handle the drop event
    function handleDrop(event) {
      if (event.stopPropagation) {
        event.stopPropagation();
      }

      if (dragSrcElement !== this) {
        dragSrcElement.innerHTML = this.innerHTML;
        this.innerHTML = event.dataTransfer.getData('text/html');

        // Update the button order on the frontend
        updateButtonOrder(getButtonOrder());
      }

      return false;
    }

    // Function to handle the drag end event
    function handleDragEnd(event) {
      draggableButtons.forEach(function(button) {
        button.classList.remove('over');
      });
    }

    // Function to get the current button order
    function getButtonOrder() {
      var buttonOrder = [];
      draggableButtons.forEach(function(button) {
        buttonOrder.push(button.getAttribute('data-id'));
      });
      return buttonOrder;
    }

    // Assign the event listeners to the draggable buttons
    draggableButtons.forEach(function(button) {
      button.addEventListener('dragstart', handleDragStart, false);
      button.addEventListener('dragenter', handleDragEnter, false);
      button.addEventListener('dragover', handleDragOver, false);
      button.addEventListener('dragleave', handleDragLeave, false);
      button.addEventListener('drop', handleDrop, false);
      button.addEventListener('dragend', handleDragEnd, false);
    });
  }

  // Execute the button drag and drop functionality when the page has loaded
  $(document).ready(function() {
    handleButtonDragAndDrop();
  });

  $(document).ready(function () {
    //update history
    var historyid = "0";
    $('.audioButton').click(function () {
      historyid = $(this).attr('historyid');

      $.ajax({
        url: 'update_order.php',
        method: 'post',
        data: {
          historyid: historyid,
        },
        success: function (response) {
          // Handle the success response
          console.log(response);
          if (response === 'approved') {
            // Update the button's history attribute
            $('[historyid="' + historyid + '"]').attr('history', '1');
          }
        },
        error: function (xhr, status, error) {
          // Handle the error
          console.error(error);
        }
      });
    });
    

    //update history
    var historyid1 = "0";
    $('.audioButton1').click(function () {
      historyid1 = $(this).attr('historyid1');

      $.ajax({
        url: 'removehistory.php',
        method: 'post',
        data: {
          historyid1: historyid1,
        },
        success: function (response) {
          // Handle the success response
          console.log(response);
          if (response === 'approved') {
            // Update the button's history attribute
            $('[historyid1="' + historyid1 + '"]').attr('history', '1');
          }
        },
        error: function (xhr, status, error) {
          // Handle the error
          console.error(error);
        }
      });
    });
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

</script>
</div>
</html>