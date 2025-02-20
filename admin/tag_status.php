<?php
require_once 'includes/db.php';

// Status Check
if (isset($_POST['status_btn'])) {
    $status_id = mysqli_real_escape_string($con, trim($_POST['status_id']));
    $status = mysqli_real_escape_string($con, trim($_POST['status']));

    // Status Update Query
    $status_Update = "UPDATE `tags` SET tag_status = '$status' WHERE id = '$status_id'";
    $status_query = mysqli_query($con, $status_Update);

    // Check Query Run Or Not
    if ($status_query) {
        $_SESSION['success'] = 'Tag Status Updated Successfully';
        header('location: tags.php');
        exit();
    } else {
        echo 'Something Went Wrong';
    }
}
