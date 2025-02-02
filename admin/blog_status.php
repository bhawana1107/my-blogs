<?php
require_once './includes/db.php';

// GET , STORE , UPDATE STATUS & LOCATION TO BLOGS
if (isset($_POST['status_id'])) {
    $blog_id = mysqli_real_escape_string($con, trim($_POST['status_id']));
    $blog_status = mysqli_real_escape_string($con, trim($_POST['status']));
    // UPDATE QUERY
    $status_update = "UPDATE `blogs` SET blog_status = '$blog_status' WHERE id = '$blog_id'";
    $status_query = mysqli_query($con, $status_update);
    if ($status_query) {
        $_SESSION['success'] = 'Status Updated Successfully';
        header('location: blogs.php');
        exit();
    } else {
        $errors[] = 'Something Went Wrong';
    }
}
