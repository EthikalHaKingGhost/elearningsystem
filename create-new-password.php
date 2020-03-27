
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
            <strong>Message!</strong> Your password has been changed successfully!, Please check your Email.</div>';

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
                            <form action="include/reset-request-link.php"  method="post" class="form" role="form" autocomplete="off">
                                <div class="form-group">
                                    <label for="reset-request-submit">Email</label>
                                    <input class="form-control" name="email" type="text" placeholder="Enter your email address..." required="">
                                    <span class="form-text small text-muted">
                                            Password reset instructions will be sent to this email address.
                                        </span>
                                      </div>
                                     <div class="form-group text-center">
                                    <button type="submit" name="reset-request-submit" class="btn btn-secondary">Send my password</button>
                                </div>
                            </form>
                      </div>
                    </div>       
              </div>
            </div>
            </div>

            
</body>
</html>