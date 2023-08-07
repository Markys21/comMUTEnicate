<?php
if (isset($_POST['password']) && isset($_POST['id'])) {
    include "../db_conn.php";
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "SELECT * FROM users WHERE password = '$password' AND id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        // Password is correct
        if (isset($_POST['voiceid'])) {
           
            $voiceid = mysqli_real_escape_string($conn, $_POST['voiceid']);
            $sql = mysqli_query($conn, "UPDATE button SET status = 1 WHERE id = '$voiceid'");

            if ($sql) {
                echo 'approved';
            } else {
                echo 'error';
            }
        }
    } else {
        echo 'Invalid';
    }
    exit; // Exit to prevent executing the rest of the PHP script
}
?>