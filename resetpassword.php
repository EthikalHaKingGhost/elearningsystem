
<style type="text/css">

  body{
    background-image:url(images/login-cover.jpeg);
    background-size:cover;
    background-repeat:no-repeat;
  }

</style>

<?php

        if (isset($_GET["reset"])) {

          if ($_GET["reset"] == "success") {

echo
            '<div class="alert alert-danger m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong> Your password link has been sent!, Please check your Email.</div>';

        }

      }

 ?>

<?php include "header.php"; ?>



<div class="col-md-6 offset-md-3 pt-5">
        <div class="card ">
            <h2 class="text-center">Reset your password</h2>
            <div class="card-body">
                       <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h5 class="mb-0">Password Reset</h5>
                        </div>
                        <div class="card-body">



                        <?php

                        $selector = $_GET["selector"];
                        $validator = $_GET["validator"];


                        if (empty($selector) || empty($validator)) {
                          
                          echo "could not validate your request!";

                        }else{

                          if (ctype_xdigits($selector) !== false && ctype_xdigits($validator) !== false) {
                          
                          ?>

                          <form action="include/reset-password-link.php"  method="post">
                          <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                          <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                          <input type="password"  name="pwd"  placeholder="enter a new password...">
                          <input type="password"  name="pwd-repeat"  placeholder="Repeat a new password...">
                          <button type="submit" name="reset-password-submit">Reset Password</button>
                          </form>


                          <?php

                          }

                        }

                     ?>      


                      </div>
                    </div>       
              </div>
            </div>
            </div>

<?php include 'footer.php'; ?>