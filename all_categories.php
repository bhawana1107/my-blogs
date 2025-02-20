<?php
require_once './includes/header.php';
?>

<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <?php foreach (blogsData($con) as $key => $result) { ?>
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="./admin/<?= htmlspecialchars($result['blog_image']) ?>" style="object-fit: cover;height:250px;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a><?= $result['category_name'] ?></a>
                                        <span class="px-1">/</span>
                                        <span><?= $result['created_on'] ?></span>
                                    </div>
                                    <a class="h4" href="category.php?id=<?= $result['category_id'] ?>"><?= $result['blog_name'] ?>...</a>

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

<?php
require_once './includes/footer.php';
?>