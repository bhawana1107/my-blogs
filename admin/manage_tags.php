<?php include_once "./includes/header.php";

// INITIALIZE VARIABLE
$errors = [];
$success = '';
$tag_name = '';

// CHECK LOGIN(ADMIN OR USER) 
if ($_SESSION['roleid'] !== '1') {
    header('location: error.php');
    exit;
}

// IF EDIT
if (isset($_GET['edit_id'])) {
    $edit_id = mysqli_real_escape_string($con, trim($_GET['edit_id']));
    $existed_tag = "SELECT * FROM `tags` WHERE id = '$edit_id'";
    $existed_tag_sql = mysqli_query($con, $existed_tag);
    $existed_tag_sql_res = mysqli_fetch_assoc($existed_tag_sql);
    $tag_name = $existed_tag_sql_res['tag_name'];
    $date = date('y-m-d');
}

// IF ADD 
if (isset($_POST['add_btn'])) {
    $tag_name = mysqli_real_escape_string($con, trim($_POST['tag_name']));
    $date = date('y-m-d');
    if ($tag_name === '') {
        $errors[] = 'Tags cannot be blank ';
    }

    // Check Tags already exist or not
    $existed_tags = "SELECT * FROM `tags` WHERE tag_name = '$tag_name'";
    $existed_tags_sql = mysqli_query($con, $existed_tags);
    if (mysqli_num_rows($existed_tags_sql) > 0) {
        $errors[] = 'Already existed tags ';
    }

    if (empty($errors)) {
        if (isset($_GET['edit_id'])) {
            $update_tag = "UPDATE `tags` SET tag_name = '$tag_name' WHERE id='" . $_GET['edit_id'] . "' ";
            $update_tag_sql = mysqli_query($con, $update_tag);
            $_SESSION['success'] = 'Tag Updated Successfully';
            header('location: tags.php');
            die();
        } else {
            $tag_add = "INSERT INTO `tags` (tag_name, created_at) VALUES ('$tag_name', '$date')";
            $tag_add_query = mysqli_query($con, $tag_add);
            if ($tag_add_query) {
                $_SESSION['success'] = 'Tag Add Successfully';
                header('location: tags.php');
                die();
            } else {
                $errors[] = 'Something wrong';
            }
        }
    }
}

// TOASTER FOR ERROR & SUCCESS
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
?>


<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manage Tags</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item btn btn-primary btn-lg"> <a href="tags.php" class="text-white">Back</a></li>
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
                                <label for="category">Enter Your Tags</label>
                                <input type="text" class="form-control" id="category" name="tag_name" value="<?= $tag_name ?>" autofocus>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="add_btn">Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once "./includes/footer.php" ?>