<?php 
include('../db_conn.php');
session_start();
$id = $_SESSION['gate'];

$row = array(); // Initialize $row as an empty array

// Check if the editvoiceid is set and not empty
if (isset($_GET['editvoiceid']) && !empty($_GET['editvoiceid'])) {
    $hashedEditVoiceId = $_GET['editvoiceid'];

    // Assuming you have fetched the data from the database here and stored it in $sql
    $sql = mysqli_query($conn, "SELECT * FROM button WHERE status = 4 AND user = '$id' ORDER BY id DESC");

    // Fetch the data as an associative array
    $data = array();
    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = $row;
    }

    // Decode the hashed ID to get the original ID
    $editvoiceid = array_search($hashedEditVoiceId, array_map('md5', array_column($data, 'id')));

    // Use the original ID to fetch the data
    $getData = mysqli_query($conn, "SELECT * FROM button WHERE id = '$editvoiceid'");
    $row = mysqli_fetch_assoc($getData);
}
?>


<section class="content d-flex align-items-center justify-content-center" style="height: 70vh;">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <!-- Add a warning button -->
        <div class="alert alert-warning" role="alert">
          <h1 class="text-center">Edit Voice Audio</h1> 
        </div>

        <form id="frmeditevent" enctype="multipart/form-data">

          <div class="form-group">
            <label for="title" class="control-label">Title</label>
            <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" value="<?php echo $row['label']; ?>" required/>
          </div>

          <div class="form-group">
            <label for="" class="control-label">Music Banner</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input rounded-circle" id="customFile1" accept="image/*" onchange="previewImage(event, 'bannerPreview')">
              <label class="custom-file-label" for="customFile1">Choose file</label>
              <div class="container mt-2">
                <!-- Image code here -->
                <h6>Old Image</h6>
                <a href="../images/<?php echo $row['icon']?>" target="_blank">
                  <img style="height: 50px;" class="img-fluid img-thumbnail" src="../images/<?php echo $row['icon']?>" alt="Your Image">
                </a>
              </div>
            </div>
            <!-- Image preview -->
            <img id="bannerPreview" src="#" alt="Banner Preview" class="mt-2" style="max-width: 100%; height: auto; display: none;">
          </div>

          <div class="form-group">
            <label for="" class="control-label">Audio File</label>
            <div class="custom-file mb-2">
              <input type="file" class="custom-file-input rounded-circle" id="customFile2" accept="audio/*" onchange="previewAudio(event)">
              <label class="custom-file-label" for="customFile2">Choose file</label>
              <div class="container mt-2">
                <h6>Old Audio</h6>
                <?php
                $audioFile = '../images/audio/' . $row['voice_audio'];
                if (file_exists($audioFile)) {
                  echo '<audio controls>';
                  echo '<source src="' . $audioFile . '" type="audio/mpeg">';
                  echo 'Your browser does not support the audio element.';
                  echo '</audio>';
                } else {
                  echo 'Audio file not found.';
                }
                ?>
              </div>
            </div>
            <!-- Audio preview -->
            <audio id="audioPreview" controls style="display: none;"></audio>
          </div>

          <div class="form-group">
            <label for="categories" class="control-label">Categories</label>
            <select name="categories" id="categories" class="form-control form-control-sm rounded-0" required="required">
              <?php
              // Fetch the categories from the database
              $pdo = new PDO('mysql:host=localhost;dbname=capstone', 'root', '');
              $stmt = $pdo->prepare('SELECT * FROM voice_categ');
              $stmt->execute();
              $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

              // Get the selected category ID (assuming it's stored in $selectedCategoryId)
              $selectedCategoryId = $row['categ']; // Replace with your actual selected category ID

              // Generate the options for the select element
              foreach ($categories as $category) {
                $categoryId = $category['voice_id'];
                $categoryName = $category['voice_name'];

                // Check if the current category ID matches the selected category ID
                $selected = ($categoryId == $selectedCategoryId) ? 'selected' : '';

                echo "<option value=\"$categoryId\" $selected>$categoryName</option>";
              }
              ?>
            </select>
          </div>

          <!-- Add the Submit button -->
          <input id="btnupdateevent" editvoiceide="<?php echo $editvoiceid; ?> " type="button" value="Update" class="btn btn-primary btn-block">

        </form>
      </div>
    </div>
  </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
  
  $(document).ready(function () {
    var editvoiceid = 0;
    $("#btnupdateevent").click(function () {
      editvoiceid = $(this).attr('editvoiceide');
      updateevent(event);
    });

    function updateevent(event) {
      event.preventDefault();
      var form = document.getElementById('frmeditevent');
      var formData = new FormData(form);

      // Get feature image file and append it to the form data
      var customFile1 = document.getElementById('customFile1').files[0];
      formData.append('customFile1', customFile1);

      var customFile2 = document.getElementById('customFile2').files[0];
      formData.append('customFile2', customFile2);

      formData.append('editvoiceid', editvoiceid);

      // Send Ajax request to the server using jQuery
      $.ajax({
        url: 'voiceupdate.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          if (response === 'success') {
            Swal.fire({
              title: 'Do you want to save the changes?',
              showDenyButton: true,
              showCancelButton: false,
              confirmButtonText: 'Update',
              denyButtonText: `Don't update`,
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.fire({
                  title: 'Updated!',
                  icon: 'success',
                  confirmButtonText: 'OK',
                }).then(() => {
                  location.reload();
                });
              } else if (result.isDenied) {
                Swal.fire('Changes are not updated', '', 'info');
              }
            });
          } else {
            // Error occurred during the server-side processing
            Swal.fire('Error occurred', '', 'error');
          }
        },
        error: function (xhr, status, error) {
          // Error occurred during the request
          Swal.fire('Error occurred', 'Error: ' + error, 'error');
        }
      });
    }
  });
</script>
