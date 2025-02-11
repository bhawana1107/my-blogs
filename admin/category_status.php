<?php
require_once 'includes/db.php';

// Status Check
if (isset($_POST['status_btn'])) {
    $status_id = mysqli_real_escape_string($con, trim($_POST['status_id']));
    $status = mysqli_real_escape_string($con, trim($_POST['status']));

    // Status Update Query
    $status_Update = "UPDATE `category` SET category_status = '$status' WHERE id = '$status_id'";
    $status_query = mysqli_query($con, $status_Update);

    // Check Query Run Or Not
    if ($status_query) {
        $_SESSION['success'] = 'Status Updated Successfully';
        header('location: category.php');
        exit();
    } else {
        echo 'Something Went Wrong';
    }
}

// Navbar Check
if (isset($_POST['navbar_btn'])) {
    $navbar_id = mysqli_real_escape_string($con, trim($_POST['navbar_id']));
    $navbar = mysqli_real_escape_string($con, trim($_POST['navbar']));

    // Status Update Query
    $navbar_Update = "UPDATE `category` SET on_navbar = '$navbar' WHERE id = '$navbar_id'";
    $navbar_query = mysqli_query($con, $navbar_Update);

    // Check Query Run Or Not
    if ($navbar_query) {
        $_SESSION['success'] = 'On Navbar Updated Successfully';
        header('location: category.php');
        exit();
    } else {
        echo 'Something Went Wrong';
    }
}
