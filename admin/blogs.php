<?php
require_once './includes/header.php';

// SUCCESS BY TOASTR
if (!empty($_SESSION['success'])) {
    echo "<script>
            toastr.success('" . $_SESSION['success'] . "');
        </script>";
    unset($_SESSION['success']);
}


if ($_SESSION['user_id'] == 1) {
    // ALL DATA FROM BLOG DATABASE
    $existed_blog = "SELECT blogs.*, category.category_name, users.user_name"
        . " FROM `blogs`"
        . " LEFT JOIN category ON category.id=blogs.category_id"
        . " LEFT JOIN users ON users.id=blogs.created_by";

    $existed_blog_query = mysqli_query($con, $existed_blog);
    $blog_result = mysqli_fetch_all($existed_blog_query, MYSQLI_ASSOC);
} else {
    $puser_id = $_SESSION['user_id'];
    // ALL DATA FROM BLOG DATABASE
    $existeduser_blog = "SELECT blogs.*, category.category_name, users.user_name"
        . " FROM `blogs`"
        . " LEFT JOIN category ON category.id=blogs.category_id"
        . " LEFT JOIN users ON users.id=blogs.created_by"
        . " WHERE user_id = '$puser_id' ";
    // pr($existeduser_blog);
    $existeduser_blog_query = mysqli_query($con, $existeduser_blog);
    $blog_result = mysqli_fetch_all($existeduser_blog_query, MYSQLI_ASSOC);

}
?>

<!-- HEADER OF THE PAGE -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Blogs</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item btn btn-primary btn-lg">
                        <a href="manage_blogs.php" class="text-white">Add Blogs</a>
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
                        <h3 class="card-title">Blog Table</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:20px;">S.No</th>
                                    <th>Blog Name</th>
                                    <th>Blog Category</th>
                                    <th>Blog Image</th>
                                    <th>Tags</th>
                                    <th>Created By</th>
                                    <th>Is Featured</th>
                                    <th>Blog Status</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($blog_result) && count($blog_result)) {
                                    foreach ($blog_result as $key => $blog_res) {
                                 
                                ?>
                                        <tr class="align-middle">
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $blog_res['blog_name'] ?></td>
                                            <td><?= $blog_res['category_name'] ?></td>
                                            <td>
                                                <img src="<?= htmlspecialchars($blog_res['blog_image']) ?>" width="100" height="100" />
                                            </td>
                                            <td><?= $blog_res['blog_tag'] ?></td>
                                            <td><?= $blog_res['user_name'] ?></td>
                                            <td>
                                                <form action="blog_status.php" method="post">
                                                    <input type="hidden" name="feature_id" value="<?= $blog_res['id'] ?>">
                                                    <?php if ($blog_res['is_featured'] == 1) { ?>
                                                        <input type="hidden" name="feature" value="0">
                                                        <button type="submit" class="btn btn-success" name="status_btn">On</button>
                                                    <?php } else { ?>
                                                        <input type="hidden" name="feature" value="1">
                                                        <button type="submit" class="btn btn-danger" name="status_btn">Off</button>
                                                    <?php } ?>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="blog_status.php" method="post">
                                                    <input type="hidden" name="status_id" value="<?= $blog_res['id'] ?>">
                                                    <?php if ($blog_res['blog_status'] == 1) { ?>
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
                                                    <form action="manage_blogs.php" method="get">
                                                        <input type="hidden" name="edit_id" value="<?= $blog_res['id'] ?>">
                                                        <button type="submit" class="btn btn-success">Edit</button>
                                                    </form>
                                                    <form action="blog_delete.php" method="post" class="delete_form">
                                                        <input type="hidden" name="delete_id" value="<?= $blog_res['id'] ?>">
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