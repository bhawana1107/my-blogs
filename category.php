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
            require_once('newsletter.php'); ?>
        </div>
    </div>
</div>
</div>
<!-- News With Sidebar End -->


<!-- Footer Start -->
<div class="container-fluid bg-light pt-5 px-sm-3 px-md-5">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-5">
            <a href="index.html" class="navbar-brand">
                <h1 class="mb-2 mt-n2 display-5 text-uppercase"><span class="text-primary">News</span>Room</h1>
            </a>
            <p>Volup amet magna clita tempor. Tempor sea eos vero ipsum. Lorem lorem sit sed elitr sed kasd et</p>
            <div class="d-flex justify-content-start mt-4">
                <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="font-weight-bold mb-4">Categories</h4>
            <div class="d-flex flex-wrap m-n1">
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Politics</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Business</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Corporate</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Sports</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Health</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Education</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Science</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Technology</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Foods</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Entertainment</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Travel</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Lifestyle</a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="font-weight-bold mb-4">Tags</h4>
            <div class="d-flex flex-wrap m-n1">
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Politics</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Business</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Corporate</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Sports</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Health</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Education</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Science</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Technology</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Foods</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Entertainment</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Travel</a>
                <a href="" class="btn btn-sm btn-outline-secondary m-1">Lifestyle</a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="font-weight-bold mb-4">Quick Links</h4>
            <div class="d-flex flex-column justify-content-start">
                <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>About</a>
                <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Advertise</a>
                <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Privacy & policy</a>
                <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Terms & conditions</a>
                <a class="text-secondary" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Contact</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4 px-sm-3 px-md-5">
    <p class="m-0 text-center">
        &copy; <a class="font-weight-bold" href="#">Your Site Name</a>. All Rights Reserved.

        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
        Designed by <a class="font-weight-bold" href="https://htmlcodex.com">HTML Codex</a>
    </p>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-dark back-to-top"><i class="fa fa-angle-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>