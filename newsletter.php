  <?php
    if (isset($_POST['signup'])) {
        $email = mysqli_real_escape_string($con, trim($_POST['email']));
        $email_query = "INSERT INTO `newsletter` (email)  VALUES ('$email') ";
        $email_sql = mysqli_query($con, $email_query);
    } ?>
  <div class="col-lg-4 pt-3 pt-lg-0">
      <!-- Social Follow Start -->
      <div class="pb-3">
          <div class="bg-light py-2 px-4 mb-3">
              <h3 class="m-0">Follow Us</h3>
          </div>
          <div class="d-flex mb-3">
              <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #39569E;">
                  <small class="fab fa-facebook-f mr-2"></small><small>12,345 Fans</small>
              </a>
              <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #52AAF4;">
                  <small class="fab fa-twitter mr-2"></small><small>12,345 Followers</small>
              </a>
          </div>
          <div class="d-flex mb-3">
              <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #0185AE;">
                  <small class="fab fa-linkedin-in mr-2"></small><small>12,345 Connects</small>
              </a>
              <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #C8359D;">
                  <small class="fab fa-instagram mr-2"></small><small>12,345 Followers</small>
              </a>
          </div>
          <div class="d-flex mb-3">
              <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #DC472E;">
                  <small class="fab fa-youtube mr-2"></small><small>12,345 Subscribers</small>
              </a>
              <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #1AB7EA;">
                  <small class="fab fa-vimeo-v mr-2"></small><small>12,345 Followers</small>
              </a>
          </div>
      </div>
      <!-- Social Follow End -->

      <!-- Newsletter Start -->
      <div class="pb-3">
          <div class="bg-light py-2 px-4 mb-3">
              <h3 class="m-0">Newsletter</h3>
          </div>

          <div class="bg-light text-center p-4 mb-3">
              <p>Stay Updated! Subscribe to Our Newsletter</p>
              <form method="post" class="input-group" style="width: 100%;">
                  <input type="email" name="email" class="form-control form-control-lg" placeholder="Your Email">
                  <div class="input-group-append">
                      <button class="btn btn-primary" name="signup">Sign Up</button>
                  </div>
              </form>

          </div>
      </div>
      <!-- Newsletter End -->

      <!-- Ads Start -->
      <div class="mb-3 pb-3">
          <a href=""><img class="img-fluid" src="img/news-500x280-4.jpg" alt=""></a>
      </div>
      <!-- Ads End -->

      <!-- Popular News Start -->
      <div class="pb-3">
          <div class="bg-light py-2 px-4 mb-3">
              <h3 class="m-0">Trending</h3>
          </div>
          <?php
            foreach (blogs($con, 4) as $key => $resultview) {
            ?>
              <div class="d-flex mb-3">
                  <img src="./admin/<?= htmlspecialchars($resultview['blog_image']) ?>" style="width: 100px; height: 100px; object-fit: cover;">
                  <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                      <div class="mb-1" style="font-size: 13px;">
                          <a><?= $resultview['category_name'] ?></a>
                          <span class="px-1">/</span>
                          <span><?= $resultview['created_on'] ?></span>
                      </div>
                      <a class="h6 m-0" href="category.php?id=<?= $resultview['category_id'] ?>"><?= $resultview['blog_name'] ?>...</a>
                  </div>
              </div>
          <?php } ?>

      </div>
      <!-- Popular News End -->

      <!-- Tags Start -->
      <div class="pb-3">
          <div class="bg-light py-2 px-4 mb-3">
              <h3 class="m-0">Tags</h3>
          </div>
          <div class="d-flex flex-wrap m-n1">
              <?php
                foreach (tagData($con) as $key => $resultTag) { ?>
                  <a href="" class="btn btn-sm btn-outline-secondary m-1"><?= $resultTag['tag_name'] ?></a>
              <?php } ?>
          </div>
      </div>
      <!-- Tags End -->
  </div>