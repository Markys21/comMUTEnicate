<?php
include '../db_conn.php';

if (isset($_POST['historyid'])) {
    $historyid = mysqli_real_escape_string($conn, $_POST['historyid']);
    $sql = "UPDATE button SET history = 1 WHERE id = '$historyid'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo 'approved';
    } else {
        echo 'error';
    }
}
?>
