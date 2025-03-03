<?php
require_once './includes/header.php';

// CHECK LOGIN(ADMIN OR USER) 
if ($_SESSION['roleid'] !== '1') {
    header('location: error.php');
    exit;
}

// SUCCESS BY TOASTR
if (!empty($_SESSION['success'])) {
    echo "<script>
            toastr.success('" . $_SESSION['success'] . "');
        </script>";
    unset($_SESSION['success']);
}

$existed_website_blog = "SELECT * FROM `websitedetails`";
$existed_website_query = mysqli_query($con, $existed_website_blog);
$website_result = mysqli_fetch_all($existed_website_query, MYSQLI_ASSOC);

?>

<!-- HEADER OF THE PAGE -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Website Settings</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item btn btn-primary btn-lg">
                        <a href="manage_website_setting.php" class="text-white">Manage</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- TABLE CONTENT FOR BLOGS -->
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Website Table</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:20px;">S.No</th>
                                    <th>Website Name</th>
                                    <th>Website Logo</th>
                                    <th>Website Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($website_result) && count($website_result)) {
                                    foreach ($website_result as $key => $website_res) {

                                ?>
                                        <tr class="align-middle">
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $website_res['website_name'] ?></td>
                                            <td>
                                                <img src="<?= htmlspecialchars($website_res['website_logo']) ?>" width="100" height="100" />
                                            </td>


                                            <td>
                                                <form action="detail_status.php" method="post">
                                                    <input type="hidden" name="status_id" value="<?= $website_res['id'] ?>">
                                                    <?php if ($website_res['detail_status'] == 1) { ?>
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
                                                    <form action="manage_website_setting.php" method="get">
                                                        <input type="hidden" name="edit_id" value="<?= $website_res['id'] ?>">
                                                        <button type="submit" class="btn btn-success">Edit</button>
                                                    </form>
                                                    <form action="detail_delete.php" method="post" class="delete_form">
                                                        <input type="hidden" name="delete_id" value="<?= $website_res['id'] ?>">
                                                        <button type="submit" class="btn btn-danger delete_btn" name="delete_btn">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">No Data Found !</td>
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

<?php
require_once './includes/footer.php';
?>

<!-- ALERT FOR DELETING BLOGS -->
<script>
    $('.delete_btn').click(function(e) {
        e.preventDefault()
        // console.log($('input[type=hidden]').val())
        if (confirm('Are You Sure Want To Delete ?')) {
            $(this).closest('form').submit()
        }
    })
</script>