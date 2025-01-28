<?php
require_once './includes/db.php';

$errors = [];
$success = '';

if (isset($_POST['status_id'])) {
    $blog_id = mysqli_real_escape_string($con, trim($_POST['status_id']));
    $blog_status = mysqli_real_escape_string($con, trim($_POST['status']));
    // UPDATE QUERY
    $status_update = "UPDATE `blogs` SET blog_status = '$blog_status' WHERE id = '$blog_id'";
    $status_query = mysqli_query($con, $status_update);
    if ($status_query) {
        $success = 'Status Updated Successfully';
        header('location: blogs.php');
        exit();
    } else {
        $errors[] = 'Something Went Wrong';
    }
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<script>
            toastr.error('$error');
        </script>";
    }
}
if (!empty($success)) {

    echo "<script>
            toastr.success('$success');
        </script>";
}
