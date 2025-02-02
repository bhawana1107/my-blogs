<?php
require_once './includes/db.php';

// GET , STORE , MATCHES WITH DB & RUN QUERY & LOCATION ON BLOG PAGE
if (isset($_POST['delete_id'])) {
    $delete_id = mysqli_real_escape_string($con, trim($_POST['delete_id']));
    $delete_blog = "DELETE FROM `blogs` WHERE id = '$delete_id'";
    $delete_query = mysqli_query($con, $delete_blog);
    if ($delete_query) {
        header('location: blogs.php');
        exit();
    } else {
        echo 'Something went Wrong';
    }
}
