<?php
require_once './includes/db.php';

$errors = [];
$success = '';

if (isset($_POST['delete_id'])) {
    $delete_id = mysqli_real_escape_string($con, trim($_POST['delete_id']));
    $delete_blog = "DELETE FROM `blogs` WHERE id = '$delete_id'";
    $delete_query = mysqli_query($con, $delete_blog);

    if ($delete_query) {
        $success = 'Deleted Successfully';
        header('location: blogs.php');
        exit();
    } else {
        $errors[] = 'Something went Wrong';
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
