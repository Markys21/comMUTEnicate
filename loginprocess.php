<?php
session_start();
if (isset($_POST['uname']) && isset($_POST['pass'])) {
    include "../db_conn.php";
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_name = '$uname' AND password = '$pass' AND status = 1 AND roleid IN ('guest', 'admin')");

    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $_SESSION['gate'] = $row['id'];
        echo 'Welcome';
    } else {
        echo 'Error';
    }
} else {
    echo 'error';
}
?>
