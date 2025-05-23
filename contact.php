<?php
require_once('./includes/header.php'); ?>

<!-- Contact Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Contact Us For Any Queries</h3>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="bg-light mb-3" style="padding: 30px;">
                    <h6 class="font-weight-bold">Get in touch</h6>
                    <p>We'd love to hear from you! Whether you have a question or want to discuss a project, feel free to reach out. We're here to help you with your needs and will respond as soon as possible.</p>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-2x fa-map-marker-alt text-primary mr-3"></i>
                        <div class="d-flex flex-column">
                            <h6 class="font-weight-bold">Our Office</h6>
                            <p class="m-0"><?= $website_result[0]['branch_address'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-2x fa-envelope-open text-primary mr-3"></i>
                        <div class="d-flex flex-column">
                            <h6 class="font-weight-bold">Email Us</h6>
                            <p class="m-0"><?= $website_result[0]['website_email'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-2x fa-phone-alt text-primary mr-3"></i>
                        <div class="d-flex flex-column">
                            <h6 class="font-weight-bold">Call Us</h6>
                            <p class="m-0"><?= $website_result[0]['website_phone'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <div id="success"></div>
                    <?php
                    if (isset($_POST['send'])) {
                        $name = mysqli_real_escape_string($con, trim($_POST['name']));
                        $email = mysqli_real_escape_string($con, trim($_POST['email']));
                        $subject = mysqli_real_escape_string($con, trim($_POST['subject']));
                        $message = mysqli_real_escape_string($con, trim($_POST['message']));
                        $detail_query = "INSERT INTO `user_details` (name,email,subject,message)  VALUES ('$name','$email','$subject','$message') ";
                        $detail_sql = mysqli_query($con, $detail_query);


                        if ($detail_sql) {
                            echo '<script>alert("Submitted Successfully")</script>';
                        }
                    } ?>
                    <form method="post">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="text" name="name" class="form-control p-4" id="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="email" name="email" class="form-control p-4" id="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <input type="text" name="subject" class="form-control p-4" id="subject" placeholder="Subject" required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" name="message" rows="4" id="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary font-weight-semi-bold px-4" style="height: 50px;" type="submit" id="sendMessageButton" name="send">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
<?php
require_once('./includes/footer.php'); ?>