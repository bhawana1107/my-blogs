<?php include_once "./includes/header.php";

// Not show Tags to user
if ($_SESSION['roleid'] !== '1') {
    header('location: error.php');
    exit;
}

// TOASTER FOR SUCCESS
if (!empty($_SESSION['success'])) {

    echo "<script>
            toastr.success('" . $_SESSION['success'] . "');
        </script>";
    unset($_SESSION['success']);
}

// GET ALL DATA OF Tags
$existed_tags = "SELECT * FROM tags ";
$existed_tags_sql = mysqli_query($con, trim($existed_tags));
$existed_tags_result = mysqli_fetch_all($existed_tags_sql, MYSQLI_ASSOC);
?>

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tags Tables</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item btn btn-primary btn-lg"> <a href="manage_tags.php" class="text-white">Add Tag</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Tags Table</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:20px;">S.No</th>
                                    <th>Tag Name</th>
                                    <th>Tag Status</th>
                                   
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($existed_tags_result) && count($existed_tags_result)) {
                                    foreach ($existed_tags_result as $key => $tags_res) {
                                ?>
                                        <tr class="align-middle">
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $tags_res['tag_name'] ?></td>
                                            <td>
                                                <form action="tag_status.php" method="post">
                                                    <input type="hidden" name="status_id" value="<?= $tags_res['id'] ?>">
                                                    <?php if ($tags_res['tag_status'] == 1) { ?>
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
                                                    <form action="manage_tags.php" method="get">
                                                        <input type="hidden" name="edit_id" value="<?= $tags_res['id'] ?>">
                                                        <button type="submit" class="btn btn-success">Edit</button>
                                                    </form>
                                                    <form action="tag_delete.php" method="post" id="delete_form">
                                                        <input type="hidden" name="delete_id" value="<?= $tags_res['id'] ?>">
                                                        <button type="submit" class="btn btn-danger delete_btn" name="delete_btn">Delete</button>
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
            </div>
        </div>
    </div>
</div>

<?php include_once "./includes/footer.php" ?>
<!-- SCRIPT FOR DELETE ALERT -->
<script>
    $('.delete_btn').click(function(e) {
        e.preventDefault()
        if (confirm('Are You Sure Want To Delete ?')) {
            $(this).closest('form').submit()
        }
    })
</script>