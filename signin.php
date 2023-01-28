
<style type="text/css">

  body{
    background-image:url(images/login-cover.jpeg);
    background-size:cover;
    background-repeat:no-repeat;
  }

  .field-icon {
  float: right;
  margin: 0 0 0 -17px;
  position: relative;
  top:12px;
  left:-7px;
  z-index: 3;
  font-size:2vh;

}

</style>

<?php

include "header.php"; ?>

<div class="container p-5">
<div class="row p-5">

  <div class="col-md-6 rounded-sm"  style="background-image:url(slideimages/2.jpg); background-size:cover;">

</div>

  <div class="col-md-6 p-0 m-0">
    <div class="card p-4">
      <h2 class="text-center">Reset your password</h2>
      <div class="card-body">
                       <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Password Reset</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off">
                                <div class="form-group">
                                    <label for="inputResetPasswordEmail">Email</label>
                                    <input type="email" class="form-control" id="inputResetPasswordEmail" required="">
                                    <span id="helpResetPasswordEmail" class="form-text small text-muted">
                                            Password reset instructions will be sent to this email address.
                                        </span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg float-right">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>       
    </div>
  </div>
</div>
</div>

            
</body>
</html>