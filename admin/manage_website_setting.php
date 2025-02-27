<?php
include('includes/header.php');

$errors = [];
$success = '';
$website_name = '';
$website_email = '';
$website_phone = '';
$website_logo = '';
$facebook_link = '';
$twitter_link = '';
$instagram_link = '';
$head_add = '';
$linkedin_link = '';
$branch_add = '';

// IF EDIT DONE
if (isset($_GET['edit_id'])) {
    $edit_id = mysqli_real_escape_string($con, trim($_GET['edit_id']));
    $existed_detail = "SELECT * FROM `websitedetails` WHERE id = '$edit_id'";
    $existed_detail_sql = mysqli_query($con, $existed_detail);
    $existed_detail_sql_res = mysqli_fetch_assoc($existed_detail_sql);
    $website_name = $existed_detail_sql_res['website_name'];
    $website_email = $existed_detail_sql_res['website_email'];
    $website_phone = $existed_detail_sql_res['website_phone'];
    $website_logo = $existed_detail_sql_res['website_logo'];
    $facebook_link = $existed_detail_sql_res['facebook_link'];
    $twitter_link = $existed_detail_sql_res['twitter_link'];
    $linkedin_link = $existed_detail_sql_res['linkedin_link'];
    $instagram_link = $existed_detail_sql_res['instagram_link'];
    $head_add = $existed_detail_sql_res['head_address'];
    $branch_add = $existed_detail_sql_res['branch_address'];
}

// Add Details
if (isset($_POST['submit'])) {

    $website_name = mysqli_real_escape_string($con, trim($_POST['website_name']));
    $website_email = mysqli_real_escape_string($con, trim($_POST['website_email']));
    $website_phone = mysqli_real_escape_string($con, trim($_POST['website_phone']));
    $facebook_link = mysqli_real_escape_string($con, trim($_POST['facebook_link']));
    $instagram_link = mysqli_real_escape_string($con, trim($_POST['instagram_link']));
    $twitter_link = mysqli_real_escape_string($con, trim($_POST['twitter_link']));
    $linkedin_link = mysqli_real_escape_string($con, trim($_POST['linkedin_link']));
    $head_add = mysqli_real_escape_string($con, trim($_POST['head_address']));
    $branch_add = mysqli_real_escape_string($con, trim($_POST['branch_address']));

    if (!empty($_FILES['website_logo']['name'])) {
        $target_dir = "assets/image/";
        $file_name = time() . "_" . basename($_FILES["website_logo"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["website_logo"]["tmp_name"], $target_file)) {
            $website_logo = $target_file;
        } else {
            $errors[] = "Failed to upload the image.";
        }
    }

    if (
        $website_name === '' || $website_email === '' || $website_phone === ''
        || $website_logo === '' || $head_add === ''
        || $branch_add === ''
    ) {
        $errors[] = 'Please fill all details';
    }

    $existed_detail = "SELECT * FROM `websitedetails` WHERE website_name = '$website_name' 
    AND website_email = '$website_email' AND website_phone = '$website_phone' AND website_logo = '$website_logo' AND
    head_address = '$head_add' AND branch_address = '$branch_add'";
    $existed_detail_sql = mysqli_query($con, $existed_detail);

    if (mysqli_num_rows($existed_detail_sql) > 0) {

        if ($_GET['edit_id']) {
            $edit_data = mysqli_fetch_assoc($existed_detail_sql);
            if ($_GET['edit_id'] !== $edit_data['id']) {
                $errors[] = 'Already existed website details ';
            }
        } else {
            $errors[] = 'Already existed website Details';
        }
    }

    if (empty($errors)) {

        if (isset($_GET['edit_id'])) {
            $update_detail = "UPDATE `websitedetails` SET website_name = '$website_name' ,"
                . " website_email = '$website_email' , website_phone = '$website_phone' ,"
                . " website_logo = '$website_logo' ,head_address = '$head_add' , branch_address = '$branch_add' , facebook_link = '$facebook_link' ,
                instagram_link = '$instagram_link' , twitter_link = '$twitter_link' , linkedin = '$linkedin_link' "
                . " WHERE id='" . $_GET['edit_id'] . "'";
            $update_detail_sql = mysqli_query($con, $update_detail);
            $_SESSION['success'] = 'detail Updated Successfully';
            header('location: website_setting.php');
            die();
        } else {
            $website_details = "INSERT INTO `websitedetails` (website_name,website_email,website_phone,website_logo,
            head_address,branch_address,facebook_link,instagram_link,twitter_link,linkedin_link) VALUES ('$website_name',
             '$website_email','$website_phone','$website_logo','$branch_add','$head_add','$facebook_link','$instagram_link','$twitter_link','$linkedin_link')";
            $website_details_query = mysqli_query($con, $website_details);
            if ($website_details_query) {
                $_SESSION['success'] = 'Details Add Successfully';

                header('location: website_setting.php');
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

<!-- HEADER OF THE PAGE -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">

                <h3 class="mb-0">Manage Website</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item btn btn-primary btn-lg">
                        <a href="website_setting.php" class="text-white">Back</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- FORM OF CONTENT  -->
<div class="container-fluid">
    <div class="row g-4">
        <div class="col-md-12">
            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">Website Settings</div>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="websiteName" class="form-label">Website Name</label>
                            <input type="text" class="form-control" id="websiteName" name="website_name" value="<?= $website_name ?>" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="website_email" value="<?= $website_email ?>" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone" name="website_phone" value="<?= $website_phone ?>" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="headAddress" class="form-label">Head Office Address</label>
                            <input type="text" class="form-control" id="headAddress" name="head_address" value="<?= $head_add ?>" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="branchAddress" class="form-label">Branch Office Address</label>
                            <input type="text" class="form-control" id="branchAddress" name="branch_address" value="<?= $branch_add ?>" autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="websiteLogo" class="form-label">Website Logo</label>
                            <input type="file" class="form-control" id="websiteLogo" name="website_logo">

                            <?php if ($website_logo): ?>
                                <img src="<?= $website_logo ?>" alt="Current Blog Image" style="max-width: 200px; max-height: 150px; object-fit: cover;">
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook_link" value="<?= $facebook_link ?>" autofocus>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="twitter" class="form-label">Twitter</label>
                                <input type="text" class="form-control" id="twitter" name="twitter_link" value="<?= $twitter_link ?>" autofocus>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram_link" value="<?= $instagram_link ?>" autofocus>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="linkedin" class="form-label">Linkedin</label>
                                <input type="text" class="form-control" id="linkedin" name="linkedin_link" value="<?= $linkedin_link ?>" autofocus>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>