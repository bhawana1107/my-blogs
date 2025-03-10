<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once './includes/header.php';
@include '../private.php';
$ck_editor_key = defined('CK_EDITOR_KEY') ? CK_EDITOR_KEY : 'nhi h';

// PHP MAILER
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



// GET DATA FROM CATEGORY TABLE FOR CATEGORY NAME
$category = "SELECT * FROM `category` ";
$category_query = mysqli_query($con, $category);
$category_result = mysqli_fetch_all($category_query, MYSQLI_ASSOC);


$existed_tags = "SELECT * FROM tags ";
$existed_tags_sql = mysqli_query($con, trim($existed_tags));
$existed_tags_result = mysqli_fetch_all($existed_tags_sql, MYSQLI_ASSOC);


$errors = [];
$success = '';
$blog_name = "";
$blog_category = "";
$blog_content = "";
$blog_image = "";
$blog_tag = [];
// IF EDIT DONE
if (isset($_GET['edit_id'])) {
    $edit_id = mysqli_real_escape_string($con, trim($_GET['edit_id']));
    $existed_blog = "SELECT * FROM `blogs` WHERE id = '$edit_id'";
    $existed_blog_sql = mysqli_query($con, $existed_blog);
    $existed_blog_sql_res = mysqli_fetch_assoc($existed_blog_sql);
    $blog_name = $existed_blog_sql_res['blog_name'];
    $blog_category = $existed_blog_sql_res['category_id'];
    $blog_image = $existed_blog_sql_res['blog_image'];
    $blog_content = $existed_blog_sql_res['blog_content'];
    $blog_tag = explode(',', $existed_blog_sql_res['blog_tag']);
}

// IF ADD BLOG DONE
if (isset($_POST['submit'])) {

    $blog_name = mysqli_real_escape_string($con, trim($_POST['blog_name']));
    $blog_category = mysqli_real_escape_string($con, trim($_POST['blog_category']));
    $blog_tag = !empty($_POST['blog_tag']) ? implode(',', $_POST['blog_tag']) : '';

    $blog_content = mysqli_real_escape_string($con, trim($_POST['blog_content']));

    $blog_content = htmlspecialchars($blog_content);
    $date = date('y-m-d');
    if (!empty($_FILES['blog_image']['name'])) {
        $target_dir = "assets/image/";
        $file_name = time() . "_" . basename($_FILES["blog_image"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $target_file)) {
            $blog_image = $target_file;
        } else {
            $errors[] = "Failed to upload the image.";
        }
    }

    if ($blog_name === '' || $blog_category === 'choose' || $blog_content === '' || $blog_image === '' || $blog_tag === '') {
        $errors[] = 'Please fill all details';
    }

    $existed_blog = "SELECT * FROM `blogs` WHERE blog_name = '$blog_name' AND
     category_id = '$blog_category' AND blog_image = '$blog_image' AND
    blog_content = '$blog_content' AND blog_tag = '$blog_tag'";
    $existed_blog_sql = mysqli_query($con, $existed_blog);

    pr($existed_blog_sql);
    if (mysqli_num_rows($existed_blog_sql) > 0) {

        if ($_GET['edit_id']) {
            $edit_data = mysqli_fetch_assoc($existed_blog_sql);
            if ($_GET['edit_id'] !== $edit_data['id']) {
                $errors[] = 'Already existed blog name ';
            }
        } else {
            $errors[] = 'Already existed blog name ';
        }
    }

    if (empty($errors)) {

        if (isset($_GET['edit_id'])) {
            $update_blog = "UPDATE `blogs` SET blog_name = '$blog_name' ,"
                . " category_id = '$blog_category' , blog_image = '$blog_image' ,"
                . " blog_content = '$blog_content' ,created_on = '$date' , blog_tag = '$blog_tag'"
                . " WHERE id='" . $_GET['edit_id'] . "'";
            $update_blog_sql = mysqli_query($con, $update_blog);
            $_SESSION['success'] = 'blog Updated Successfully';
            header('location: blogs.php');
            die();
        } else {
            $user_id = $_SESSION['user_id'];
            $blog_add = "INSERT INTO `blogs` (blog_name ,category_id ,blog_image, blog_content,user_id,
            created_on,created_by,blog_tag) VALUES ('$blog_name','$blog_category','$blog_image','$blog_content',
            '$user_id','$date','$user_id' , '$blog_tag')";
            $blog_add_query = mysqli_query($con, $blog_add);
            if ($blog_add_query) {

                // Fetch all registered users' emails
                $userQuery = "SELECT email FROM newsletter";
                $result = mysqli_query($con, $userQuery);
                // Create a new PHPMailer instance
                $mail = new PHPMailer(true);
                $blog_contents =  substr(strip_tags(html_entity_decode($blog_content)), 0);
                try {
                    // SMTP Configuration
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'bhawana6851@gmail.com'; // Your email
                    $mail->Password = 'gbbf dgob mcjb hwfu'; // Use app password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    $mail->setFrom('bhawana6851@gmail.com', 'MY BLOGS');

                    // Email Content
                    $mail->isHTML(true);
                    $mail->Subject = "New Blog Added: $blog_name";
                    $mail->Body = "<h2>New Blog Published: $date</h2>
                           <p>$blog_contents </p>
                           <a href='http://localhost/my-blog/index.php'>Read More</a>";

                    // Send email to all users
                    while ($row = mysqli_fetch_assoc($result)) {
                        $mail->addAddress($row['email']);
                    }

                    if ($mail->send()) {
                        echo "Email notifications sent successfully!";
                    }
                } catch (Exception $e) {
                    echo "Email sending failed. Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "Error adding blog: " . mysqli_error($con);
            }
        }
        $_SESSION['success'] = 'blog Add Successfully';
        header('location: blogs.php');


        die();
    } else {
        $errors[] = 'Something wrong';
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- CK EDITOR LINK -->
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" />

<!-- HEADER OF THE PAGE -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">

                <h3 class="mb-0">Manage Blogs</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item btn btn-primary btn-lg">
                        <a href="blogs.php" class="text-white">Back</a>
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
                    <div class="card-title">Add Blogs</div>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="blogName" class="form-label">Blog Name</label>
                            <input type="text" class="form-control" id="blogName" name="blog_name" value="<?= $blog_name ?>" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="blogCategory" class="form-label">Blog Category</label>
                            <select class="form-select" id="addblogCategory" name="blog_category" value="<?= $blog_category ?>" autofocus>
                                <option selected="" value="choose">Choose...</option>

                                <?php
                                if (is_array($category_result) && count($category_result)) {
                                    foreach ($category_result as $key => $category_res) {
                                        if ($category_res['category_status'] == 1) {
                                ?>
                                            <option value="<?= $category_res['id'] ?>" <?= ($blog_category == $category_res['id'] ? 'selected' : '') ?>><?= $category_res['category_name'] ?></option>
                                <?php }
                                    }
                                }
                                ?>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="blogCategory" class="form-label">Tags</label>
                            <select class="form-select" id="tagsMenu" name="blog_tag[]" multiple="multiple">
                                <option selected value="choose">Choose...</option>

                                <?php
                                if (is_array($existed_tags_result) && count($existed_tags_result)) {
                                    foreach ($existed_tags_result as $key => $tag_res) {
                                        if ($tag_res['tag_status'] == 1) {
                                ?>
                                            <option value="<?= $tag_res['tag_name'] ?>" <?= (in_array($tag_res['tag_name'], $blog_tag) ? 'selected' : '') ?>><?= $tag_res['tag_name'] ?></option>
                                <?php }
                                    }
                                }
                                ?>
                            </select>
                        </div>



                        <div class="mb-3">
                            <label for="blogImage" class="form-label">Blog Image</label>
                            <input type="file" class="form-control" id="blogImage" name="blog_image">

                            <?php if ($blog_image): ?>
                                <img src="<?= $blog_image ?>" alt="Current Blog Image" style="max-width: 200px; max-height: 150px; object-fit: cover;">
                            <?php endif; ?>
                        </div>
                        <div class=" mb-3">
                            <label for="blogContent" class="form-label">Blog Content</label>
                            <textarea id="editor" name="blog_content" id="blog_content">
                                <?= $blog_content ?>
                            </textarea>
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
require_once './includes/footer.php';
?>

<script src="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.umd.js"></script>
<script src="https://cdn.ckbox.io/ckbox/2.4.0/ckbox.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    const {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Font,
        Paragraph,
        Heading,
        BlockQuote,
        Link,
        List,
        Alignment,
        Image,
        ImageUpload,
        Code,
        CodeBlock,
        Strikethrough,
        Subscript,
        Superscript,
        TodoList,

    } = CKEDITOR;

    ClassicEditor
        .create(document.querySelector('#editor'), {
            licenseKey: '<?= $ck_editor_key ?>',
            plugins: [
                Essentials, Bold, Italic, Font, Paragraph, Heading, BlockQuote,
                Link, List, Alignment, Image, ImageUpload, Code, CodeBlock,
                Strikethrough, Subscript, Superscript, TodoList
            ],

            toolbar: {
                items: [
                    'undo', 'redo',
                    '|',
                    'heading',
                    '|',
                    'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                    '|',
                    'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                    '|',
                    'link', 'uploadImage', 'blockQuote', 'codeBlock',
                    '|',
                    'alignment',
                    '|',
                    'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                ],
                shouldNotGroupWhenFull: true
            },


        })

        .then(editor => {
            console.log("Editor loaded successfully", editor);
        })
        .catch(error => {
            console.error("Editor error:", error);
        });
</script>

<script>
    $('#tagsMenu').select2();
</script>