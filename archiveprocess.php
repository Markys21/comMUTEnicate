<?php
if (isset($_POST['password']) && isset($_POST['id'])) {
    include "../db_conn.php";
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "SELECT * FROM users WHERE password = '$password' AND id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        // Password is correct
        if (isset($_POST['voicearchive'])) {
           
            $voicearchive = mysqli_real_escape_string($conn, $_POST['voicearchive']);
            $sql = mysqli_query($conn, "UPDATE button SET status = 4 WHERE id = '$voicearchive'");

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