<?php
include('./includes/header.php');

// POPULAR BLOGS
$category = "SELECT category.category_name, COUNT(blogs.category_id) AS
 NumberOfCategory, MIN(category.id) as cat_id 
FROM blogs LEFT JOIN category ON blogs.category_id = category.id
GROUP BY category_id ORDER BY COUNT(blogs.category_id) DESC LIMIT 4";
$category_sql = mysqli_query($con, $category);
$category_sqli = mysqli_fetch_all($category_sql, MYSQLI_ASSOC);
?>

<!-- Main News Slider Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">
                    <!-- THREE LATEST BLOGS ADDS -->
                    <?php foreach (latest($con, 3) as $key => $result) {
                    ?>
                        <div class="position-relative overflow-hidden" style="height: 435px;">
                            <img class="img-fluid h-100" src="./admin/<?= htmlspecialchars($result['blog_image']) ?>" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-1">
                                    <a class="text-white"><?= $result['category_name'] ?></a>
                                    <span class="px-2 text-white">/</span>
                                    <a class="text-white"><?= $result['created_on'] ?></a>
                                </div>
                                <a class="h6 m-0 text-white font-weight-bold"
                                    href="category.php?id=<?= $result['category_id'] ?>">
                                    <?= $result['blog_name'] ?></a>
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>
            <div class="col-lg-4" style="overflow:auto;height:450px;">
                <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">Categories</h3>
                    <a class="text-secondary font-weight-medium text-decoration-none" href="?category=all">View All</a>
                </div>
                <?php
                // CATEGORY WHICH ARE ACTIVE
                if (isset($_GET['category'])) {
                    foreach (categoryData($con) as $key => $result) {   ?>
                        <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                            <img class="img-fluid w-100 h-100" src="https://www.shutterstock.com/image-photo/category-word-scattered-english-alpabets-260nw-1594857565.jpg" style="object-fit: cover;">
                            <a href="category.php?id=<?= $result['id'] ?>" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                                <?= $result['category_name'] ?>
                            </a>
                        </div>
                    <?php }
                } else {

                    foreach (categoryData($con, 4) as $key => $result) {

                    ?>
                        <div class="position-relative overflow-hidden mb-3" style="height: 80px;">

                            <img class="img-fluid w-100 h-100" src="https://www.shutterstock.com/image-photo/category-word-scattered-english-alpabets-260nw-1594857565.jpg" style="object-fit: cover;">

                            <a href="category.php?id=<?= $result['id'] ?>" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                                <?= $result['category_name'] ?>
                            </a>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
<!-- Main News Slider End -->

<!-- Featured News Slider Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Featured</h3>
            <a class="text-secondary font-weight-medium text-decoration-none" href="all_categories.php">View All</a>
        </div>
        <div class="owl-carousel owl-carousel-2 carousel-item-4 position-relative">
            <?php foreach (featureData($con, 5) as $key => $result) {   ?>
                <div class="position-relative overflow-hidden" style="height: 300px;">
                    <img class="img-fluid w-100 h-100" src="./admin/<?= htmlspecialchars($result['blog_image']) ?>" style="object-fit: cover;">
                    <div class="overlay">
                        <div class="mb-1" style="font-size: 13px;">
                            <a class="text-white"><?= $result['category_name'] ?></a>
                            <span class="px-1 text-white">/</span>
                            <a class="text-white" href=""><?= $result['created_on'] ?></a>
                        </div>
                        <a class="h6 m-0 text-white font-weight-bold" href="category.php?id=<?= $result['category_id'] ?>"><?= $result['blog_name'] ?></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Featured News Slider End -->

<!-- Category News Slider Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <?php foreach ($category_sqli as $key => $category_res) {
                $cat_id = $category_res['cat_id'];

                $blogs = "SELECT blogs.*, category.category_name FROM `blogs` LEFT JOIN category ON category.id=blogs.category_id WHERE category_id = $cat_id ORDER BY id DESC";
                $blogs_sql = mysqli_query($con, $blogs);
                $blogs_sqli = mysqli_fetch_all($blogs_sql, MYSQLI_ASSOC);
            ?>
                <div class="col-lg-6 py-3">

                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0"><?= $category_res['category_name'] ?></h3>
                    </div>
                    <?php
                    if (count($blogs_sqli) > 1) { ?>
                        <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">

                            <?php
                            foreach ($blogs_sqli as $key => $result) {
                            ?>
                                <div class="position-relative">
                                    <img class="img-fluid w-100" src="./admin/<?= htmlspecialchars($result['blog_image']) ?>" style="object-fit: cover;height:250px;">
                                    <div class="overlay position-relative bg-light">
                                        <div class="mb-2" style="font-size: 13px;">
                                            <a><?= $result['category_name'] ?></a>
                                            <span class="px-1">/</span>
                                            <span><?= $result['created_on'] ?></span>
                                        </div>
                                        <a class="h5 m-0 " href="category.php?id=<?= $result['id'] ?>"><?= $result['blog_name'] ?></a>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    <?php } else { ?>
                        <?php
                        foreach ($blogs_sqli as $key => $result) {
                        ?>
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="./admin/<?= htmlspecialchars($result['blog_image']) ?>" style="object-fit: cover;height:250px;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 13px;">
                                        <a><?= $result['category_name'] ?></a>
                                        <span class="px-1">/</span>
                                        <span><?= $result['created_on'] ?></span>
                                    </div>
                                    <a class="h5 m-0 " href="category.php?id=<?= $result['id'] ?>"><?= $result['blog_name'] ?></a>
                                </div>
                            </div>
                        <?php } ?>

                    <?php
                    } ?>
                </div>
            <?php
            } ?>
        </div>

    </div>
</div>
<!-- Category News Slider End -->

<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Popular</h3>
                            <!-- <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a> -->
                        </div>
                    </div>
                    <?php
                    foreach (blogs($con, 4) as $key => $resultview) {
                    ?>
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="./admin/<?= htmlspecialchars($resultview['blog_image']) ?>" style="object-fit: cover;height:250px;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a><?= $resultview['category_name'] ?></a>
                                        <span class="px-1">/</span>
                                        <span><?= $resultview['created_on'] ?></span>
                                    </div>
                                    <a class="h4" href="category.php?id=<?= $resultview['category_id'] ?>"><?= $resultview['blog_name'] ?>...</a>

                                </div>
                            </div>

                        </div>
                    <?php } ?>

                </div>



                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Latest</h3>
                            <!-- <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a> -->
                        </div>
                    </div>
                    <?php
                    foreach (blogsLatest($con) as $key => $resultview) {
                    ?>

                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="./admin/<?= htmlspecialchars($resultview['blog_image']) ?>" style="object-fit: cover;height:250px;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a><?= $resultview['category_name'] ?></a>
                                        <span class="px-1">/</span>
                                        <span><?= $resultview['created_on'] ?></span>
                                    </div>
                                    <a class="h4" href="category.php?id=<?= $resultview['category_id'] ?>"><?= $resultview['blog_name'] ?>...</a>

                                </div>
                            </div>

                        </div>
                    <?php } ?>

                </div>
            </div>

            <?php
            require_once('newsletter.php'); ?>
        </div>
    </div>
</div>
</div>
<!-- News With Sidebar End -->
<?php
include('./includes/footer.php');
?>