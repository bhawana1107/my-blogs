<?php
require_once('./includes/header.php');

$existed_user = "SELECT * FROM `users` ";
$existed_query = mysqli_query($con, $existed_user);
$existed_sql = mysqli_fetch_all($existed_query, MYSQLI_ASSOC);
?>

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Users Tables</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item btn btn-primary btn-lg"> <a href="" class="text-white">Add Users</a></li>
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
                        <h3 class="card-title">Users Table</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:20px;">S.No</th>
                                    <th>User Name</th>
                                    <th>User Email</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($existed_sql) && count($existed_sql)) {
                                    foreach ($existed_sql as $key => $users_res) {
                                ?>
                                        <tr class="align-middle">
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $users_res['user_name'] ?></td>
                                            <td><?= $users_res['email'] ?></td>

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

<?php
require_once('./includes/footer.php');
?>