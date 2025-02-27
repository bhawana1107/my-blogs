<?php
require_once './includes/db.php';

if (isset($_POST['status_id'])) {
    $detail_id = mysqli_real_escape_string($con, trim($_POST['status_id']));
    $detail_status = mysqli_real_escape_string($con, trim($_POST['status']));
    // UPDATE QUERY
    $status_update = "UPDATE `websitedetails` SET detail_status = '$detail_status' WHERE id = '$detail_id'";
    $status_query = mysqli_query($con, $status_update);
    if ($status_query) {
        $_SESSION['success'] = 'Status Updated Successfully';
        header('location: website_setting.php');
        exit();
    } else {
        $errors[] = 'Something Went Wrong';
    }
}
