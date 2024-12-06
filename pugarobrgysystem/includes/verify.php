<?php
require_once '../conn/conn.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $sql = "SELECT isVerified, vkey FROM user WHERE isVerified = 0 AND vkey =
         '$code' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result != false && $result->num_rows > 0) {
        $updateQuery = "UPDATE user SET isVerified = 1 WHERE vkey = '$code' LIMIT 1";
        $update_query = mysqli_query($conn, $updateQuery);

        if ($update_query) {
            header('location:../resident/login?success=Your Account Has been Verified');
        } else {
            echo "Error";
        }
    }

    header('location:../resident/login?success=Your Account Has been Verified');
} else {
    die("Something Went Wrong");
}