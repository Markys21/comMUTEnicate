<?php
include '../db_conn.php';

if (isset($_POST['historyid1'])) {
    $historyid1 = mysqli_real_escape_string($conn, $_POST['historyid1']);
    $sql = mysqli_query($conn, "UPDATE button SET history = 0 WHERE id = '$historyid1'");

    if ($sql) {
        echo 'approved';
    } else {
        echo 'error';
    }
}
?>