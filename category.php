<?php
include('./includes/header.php');
include('view.php');

?>
<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0"><?= $category_query['category_name'] ?></h3>
                            <?php if (count($blogs_query) > 4) { ?>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="all_categories.php">View All</a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php foreach ($blogs_query as $key => $result) {
                    ?>
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="./admin/<?= htmlspecialchars($result['blog_image']) ?>" style="object-fit: cover;height:250px;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a><?= $result['category_name'] ?></a>
                                        <span class="px-1">/</span>
                                        <span><?= $result['created_on'] ?></span>
                                    </div>
                                    <a class="h4" href="single.php?id=<?= $result['category_id'] ?>"><?= $result['blog_name'] ?></a>
                                </div>
                            </div>
                        </div>
                    <?php  } ?>

                </div>

            </div>

            <?php
            include('newsletter.php'); ?>
        </div>
    </div>
</div>
</div>
<!-- News With Sidebar End -->
<?php
include('./includes/footer.php'); ?>