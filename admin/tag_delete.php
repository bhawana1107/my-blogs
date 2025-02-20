<?php
require_once 'includes/db.php';

// GET , STORE , MATCHES WITH DB & RUN QUERY & LOCATION ON BLOG PAGE
if (isset($_POST['delete_id'])) {
    $delete_id = mysqli_real_escape_string($con, trim($_POST['delete_id']));
    $delete_tag = "DELETE FROM `tags` WHERE id = '$delete_id' ";
    $delete_query = mysqli_query($con, $delete_tag);
    if ($delete_query) {
        header('location: tags.php');
        exit();
    } else {
        echo "Try Again Something Went Wrong";
    }
}
