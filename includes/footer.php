 <!-- Footer Start -->
 <div class="container-fluid bg-light pt-5 px-sm-3 px-md-5">
     <div class="row">
         <div class="col-lg-4 col-md-6 mb-5">
             <a href="index.html" class="navbar-brand">
                 <h1 class="mb-2 mt-n2 display-5 text-uppercase"><span class="text-primary">MY</span>BLOGS</h1>
             </a>
             <p>Explore insightful articles, tips, and trends. Stay updated with fresh content every week.</p>
             <div class="d-flex justify-content-start mt-4">
                 <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-twitter"></i></a>
                 <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-facebook-f"></i></a>
                 <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                 <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-instagram"></i></a>
             </div>
         </div>
         <div class="col-lg-4 col-md-6 mb-5">
             <h4 class="font-weight-bold mb-4">Categories</h4>
             <div class="d-flex flex-wrap m-n1">
                 <?php
                    foreach (categoryData($con) as $key => $resultCat) { ?>
                     <a href="" class="btn btn-sm btn-outline-secondary m-1"><?= $resultCat['category_name'] ?></a>
                 <?php } ?>

             </div>
         </div>
         <div class="col-lg-4 col-md-6 mb-5">
             <h4 class="font-weight-bold mb-4">Tags</h4>
             <div class="d-flex flex-wrap m-n1">
                 <?php
                    foreach (tagData($con) as $key => $resultTag) { ?>
                     <a href="" class="btn btn-sm btn-outline-secondary m-1"><?= $resultTag['tag_name'] ?></a>
                 <?php } ?>

             </div>
         </div>

     </div>
 </div>
 <div class="container-fluid py-4 px-sm-3 px-md-5">
     <p class="m-0 text-center">
         &copy; <a class="font-weight-bold" href="#">My Blogs</a>. All Rights Reserved.
         Designed by <a class="font-weight-bold" href="https://bhawana1107.github.io/">Bhawana</a>
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