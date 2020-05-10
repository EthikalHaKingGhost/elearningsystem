
<style type="text/css">
  
body{
    background-image:url(images/login-cover.jpeg);
    background-size:cover;
    background-repeat:no-repeat;
  }

  .card h2{
    text-decoration: none !important;
    color:black !important;
  }

  .card

  .card-links{
    text-decoration: none !important;
    color:grey !important;
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


.divider-text {
    position: relative;
    text-align: center;
    margin-top: 10px;
    margin-bottom: 10px;
}
.divider-text span {
    padding: 7px;
    font-size: 12px;
    position: relative;   
    z-index: 2;
}
.divider-text:after {
    content: "";
    position: absolute;
    width: 100%;
    border-bottom: 1px solid #ddd;
    top: 55%;
    left: 0;
    z-index: 1;
}

</style>


<?php include "header.php"; ?>

<div class="container p-5">

<div class="row p-3">

  <div class="col-md-6 p-0 m-0">
    <div class="card p-4">

    
    <a class="card-links" href="#">
      <div class="btn btn-outline-dark bg-light mb-4 mt-4 ml-5 mr-5">
        <img style="width:25px;" src="https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png" alt='F'>
      </i> Login via Facebook</a>
    </div>

    
    <a class="card-links" href="#">
      <div class=" btn btn-outline-dark bg-light mb-3 ml-5 mr-5">
      <img style="width:25px;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/1024px-Google_%22G%22_Logo.svg.png" alt="G">
       Login via Google</a>
    </div>

    <p class="divider-text pb-1">
        <span class="bg-light">OR</span>
    </p>

      <h2 class="text-center">Sign In</h2>
      <div class="card-body">

        <form action="include/login-info.php" method="post">
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control form-control" placeholder="username" name="mailuid">
          </div>


          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input id="password-field" type="password" class="form-control" placeholder="password" name="pwd">
            <span toggle="#password-field" class="far fa-fw fa-eye field-icon toggle-password"></span>
          </div>
          <div class="custom-control custom-checkbox my-1 mr-sm-2 my-4">
          <input type="checkbox" class="custom-control-input" id="customControlInline">
          <label class="custom-control-label" for="customControlInline">Remember Me</label>
          </div>

          <div class="form-group">
            <input type="submit" name="signin" class="btn btn-info btn-block" value="Login">
          </div>

          <div class="text-center"><a href="create-new-password.php">Forgot your email or password?</a></div> 

        </form>
      </div>
    </div>


<script type="text/javascript">

  $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

</script>

</div>


  <div class="col-md-6 p-0 m-0">
    <div class="card p-4">
        <h2 class="text-center">Register</h2>

      <div class="card-body">

<!--------------error messages for users server side valiation-------------->
  
         <?php

        if (isset($_GET["error"])) {

          if ($_GET["error"] == "emptyfields") {

            echo '<p class="text-center text-danger"> Please ensure that all fields are filled!</p>';
          }

           else if ($_GET["error"] == "invalidmailuid") {

            echo '<p class="text-center text-danger"> Please ensure that username and email is correct!</p>';
          }

          else if ($_GET["error"] == "invalidmail") {

            echo '<p class="text-center text-danger"> Please ensure that the email is spelt correctly!</p>';
          }

          else if ($_GET["error"] == "invaliduid") {

            echo '<p class="text-center text-danger"> Username Invalid!</p>';

          }else if ($_GET["error"] == "usertaken") {

            echo '<p class="text-center text-danger">Sorry, that username already exists!</p>';

          }else if ($_GET["error"] == "passwordcheck") {

            echo '<p class="text-center text-danger">Passwords does not match!</p>';
          }


        }

        ?>

 <!------------end of error messages-------------->   



  <form action="include/register-info.php" method= "post">

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
         </div>
        <input name="uid" class="form-control" minlength="4" placeholder="username" type="text" >
    </div> <!-- form-group// -->


    <div class="form-group input-group mt-4 mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
         </div>
        <input name="email" id="email"class="form-control" placeholder="Email address" type="email" pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$" required>
    </div><!-- form-group// -->


    <div class="form-group input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
        </div>
     <input  name="pwd" class="form-control" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" minlength="8" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" placeholder="Password" type="password" required>

    </div>
    <!-- form-group// -->

      <div class="form-group input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
        </div>
     <input name="pwd-repeat" type="password" class="form-control" placeholder="Confirm password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  required>

    </div>
  <!-- form-group// -->



<!------googlerecaptcha ----->

   <div class="g-recaptcha mb-4" data-sitekey="6LfAXtkUAAAAAOw3rmTY3-n___31Jx4JaXugeUG-"></div>

    <div class="form-group">
        <button name="register" type="submit" class="btn btn-warning btn-block" value="register"> Create Account </button>
    
    </div> <!-- form-group// -->      
    <div class="text-center">Don't have an email?<a href="https://accounts.google.com/signup/v2/webcreateaccount?flowName=GlifWebSignIn&flowEntry=SignUp" target="_blank"> Create Gmail</div> 

    </form> 
   </div>
  </div>
 </div>
</div>
</div>

<?php include "footer.php"; ?>
