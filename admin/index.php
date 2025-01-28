<?php include_once "./includes/header.php";

if (!empty($_SESSION['success'])) {

    echo "<script>
            toastr.success('" . $_SESSION['success'] . "');
        </script>";
    unset($_SESSION['success']);
}
?>

<?php
$existed_category = "SELECT * FROM category ";
$existed_category_sql = mysqli_query($con, trim($existed_category));
$existed_category_result = mysqli_fetch_all($existed_category_sql, MYSQLI_ASSOC);
?>

<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Category Tables</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item btn btn-primary btn-lg"> <a href="manage_category.php" class="text-white">Add Category</a></li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>

<div class="app-content">

    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Category Table</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:20px;">S.No</th>
                                    <th>Category Name</th>
                                    <th>Category Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($existed_category_result) && count($existed_category_result)) {
                                    foreach ($existed_category_result as $key => $category_res) {
                                ?>
                                        <tr class="align-middle">
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $category_res['category_name'] ?></td>
                                            <td>
                                                <form action="category_status.php" method="post">
                                                    <input type="hidden" name="status_id" value="<?= $category_res['id'] ?>">
                                                    <?php if ($category_res['category_status'] == 1) { ?>
                                                        <input type="hidden" name="status" value="0">
                                                        <button type="submit" class="btn btn-success" name="status_btn">Active</button>
                                                    <?php } else { ?>
                                                        <input type="hidden" name="status" value="1">
                                                        <button type="submit" class="btn btn-danger" name="status_btn">In Active</button>
                                                    <?php } ?>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <form action="manage_category.php" method="get">
                                                        <input type="hidden" name="edit_id" value="<?= $category_res['id'] ?>">
                                                        <button type="submit" class="btn btn-success">Edit</button>
                                                    </form>
                                                    <form action="category_delete.php" method="post" id="delete_form">
                                                        <input type="hidden" name="delete_id" value="<?= $category_res['id'] ?>">
                                                        <button type="submit" class="btn btn-danger" name="delete_btn" id="delete_btn">Delete</button>

                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-danger">No Data Found</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-end">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.card -->

                <!-- /.card -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
        </div>
        <!--end::Row-->
    </div>

</div>

<?php include_once "./includes/footer.php" ?>
<script>
    $('#delete_btn').click(function(e) {
        e.preventDefault()
        if (confirm('Are You Sure Want To Delete ?')) {
            $('#delete_form').submit()
        }
    })
</script>