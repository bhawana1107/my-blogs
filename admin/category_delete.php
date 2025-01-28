<?php
require_once 'includes/db.php';

// Check Delete Or Not
if (isset($_POST['delete_id'])) {
   
    $delete_id = mysqli_real_escape_string($con, trim($_POST['delete_id']));

    // Delete Query
    $delete_category = "DELETE FROM `category` WHERE id = '$delete_id' ";
    $delete_query = mysqli_query($con, $delete_category);

    // Check Query Run Or Not
    if ($delete_query) {
        header('location: index.php');
        exit();
    } else {
        echo "Try Again Something Went Wrong";
    }
}
?>