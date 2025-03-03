<?php require_once "./admin/includes/db.php";
ob_start();

$existed_website_blog = "SELECT * FROM `websitedetails`";
$existed_website_query = mysqli_query($con, $existed_website_blog);
$website_result = mysqli_fetch_all($existed_website_query, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MY BLOGS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-2 px-lg-5">
            <div class="col-lg-4">
                <a href="index.php" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">MY</span> BLOGS</h1>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid p-0 mb-3">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">MY</span>BLOGS</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <!-- SHOW ACTIVE CATEGORY MAXIMUM 5 ON NAVBAR -->
                    <?php foreach (NavbarCategory($con, 1, 5) as $key => $result) {   ?>
                        <a href="category.php?id=<?= $result['id'] ?>" class="nav-item nav-link"><?= $result['category_name'] ?></a>
                    <?php } ?>
                    <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                </div>
                <?php
                if(isset($_POST['search-submit'])){
                    $search_id = mysqli_real_escape_string($con,trim($_POST['search']));
                        $search_name = "SELECT * FROM `blogs` WHERE blog_name LIKE '%$search_id%' OR blog_content LIKE '%$search_id%'";
                        $search_query = mysqli_query($con,$search_name);
                        $search_res = mysqli_fetch_all($search_query,MYSQLI_ASSOC);
                           

                      
                    if (!empty($search_res)) {  
                        $first_result = $search_res[0]; 
                     
                        $src_id = $first_result['category_id'];

                      
                        header("Location: category.php?id=$src_id");
                        exit(); 
                    }         
                }
                ?>
                <form action="" method="post">
                    <div class="input-group ml-auto" style="width: 100%; max-width: 300px;">

                        <input type="text" class="form-control" placeholder="Keyword" name="search">
                        <div class="input-group-append">
                            <button class="input-group-text text-secondary" name="search-submit"><i
                                    class="fa fa-search"></i></button>
                        </div>

                    </div>
                </form>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->