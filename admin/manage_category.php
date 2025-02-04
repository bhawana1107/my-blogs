<?php include_once "./includes/header.php";
$errors = [];
$success = '';
$category_name = '';

if (isset($_GET['edit_id'])) {
    $edit_id = mysqli_real_escape_string($con, trim($_GET['edit_id']));

    $existed_category = "SELECT * FROM `category` WHERE id = '$edit_id'";
    $existed_category_sql = mysqli_query($con, $existed_category);
    $existed_category_sql_res = mysqli_fetch_assoc($existed_category_sql);
    $category_name = $existed_category_sql_res['category_name'];
}


if (isset($_POST['add_btn'])) {

    $category_name = mysqli_real_escape_string($con, trim($_POST['category_name']));

    if ($category_name === '') {
        $errors[] = 'Category cannot be blank ';
    }

    $existed_category = "SELECT * FROM `category` WHERE category_name = '$category_name'";
    $existed_category_sql = mysqli_query($con, $existed_category);

    if (mysqli_num_rows($existed_category_sql) > 0) {

        if ($_GET['edit_id']) {
            $edit_data = mysqli_fetch_assoc($existed_category_sql);
            if ($_GET['edit_id'] !== $edit_data['id']) {
                $errors[] = 'Already existed category name ';
            }
        } else {
            $errors[] = 'Already existed category name ';
        }
    }

    if (empty($errors)) {

        if ($_GET['edit_id']) {
            echo $update_category = "UPDATE `category` SET category_name = '$category_name' WHERE id='" . $_GET['edit_id'] . "' ";
            $update_category_sql = mysqli_query($con, $update_category);
            $_SESSION['success'] = 'Category Updated Successfully';
            header('location: category.php');
            die();
        } else {
            $category_add = "INSERT INTO `category` (category_name, created_at) VALUES ('$category_name', 'current_timestamp()')";
            $category_add_query = mysqli_query($con, $category_add);
            if ($category_add_query) {
                $_SESSION['success'] = 'Category Add Successfully';
                header('location: category.php');
                die();
            } else {
                $errors[] = 'Something wrong';
            }
        }
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
?>


<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manage Category</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item btn btn-primary btn-lg"> <a href="category.php" class="text-white">Back</a></li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category">Enter Your Category</label>
                                <input type="text" class="form-control" id="category" name="category_name" value="<?= $category_name ?>">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                            <button type="submit" class="btn btn-primary" name="add_btn">Submit</button>

                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<?php include_once "./includes/footer.php" ?>