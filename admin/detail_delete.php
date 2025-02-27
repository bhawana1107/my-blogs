<?php
require_once './includes/db.php';

if (isset($_POST['delete_id'])) {
    $delete_id = mysqli_real_escape_string($con, trim($_POST['delete_id']));
    $delete_detail = "DELETE FROM `websitedetails` WHERE id = '$delete_id'";
    $delete_query = mysqli_query($con, $delete_detail);
    if ($delete_query) {
        header('location: website_setting.php');
        exit();
    } else {
        echo 'Something went Wrong';
    }
}
