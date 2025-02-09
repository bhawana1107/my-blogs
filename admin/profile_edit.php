<?php
require_once './includes/header.php';

if (isset($_POST['update'])) {
    $new_name = mysqli_real_escape_string($con, trim($_POST['user_name']));
    $update_name = "UPDATE `users` SET user_name = '$new_name' WHERE id = '" . $_SESSION['user_id'] . "' ";
    $update_query = mysqli_query($con, $update_name);
    if ($update_query) {
        header('location: index.php');
        die();
    }
}
?>

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Profile </h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item btn btn-primary btn-lg"> <a href="index.php" class="text-white">Back</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Update Your Name</label>
                                <input type="text" class="form-control" id="name" name="user_name" value="<?= $_SESSION['user_name'] ?>" autofocus>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="update">Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once './includes/footer.php';
?>