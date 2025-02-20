<?php include_once "./includes/header.php";
include_once "./includes/footer.php";
// TOASTER FOR SUCCESS
if (!empty($_SESSION['success'])) {

    echo "<script>
            toastr.success('" . $_SESSION['success'] . "');
        </script>";
    unset($_SESSION['success']);
}
