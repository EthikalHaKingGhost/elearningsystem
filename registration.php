


 <?php 

session_start();

    if(isset($_POST["registration"])){


include "include/connection.php";

//google recaptcha 
    $secret = "6LfAXtkUAAAAALan_VfC9IweBZkDE5SRSJUIP5Lz";
    $response = $_POST["g-recaptcha-response"];
    $remoteip = $_SERVER["REMOTE_ADDR"];
    $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    $google_response =  file_get_contents($recaptcha_url);
    $google_details = json_decode($google_response);

//login only if reCAPTCHA is clicked on 
 if($google_details->success){

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `regdate`) 
    VALUES ('NULL', '$first_name', '$last_name', '$email', '$password', current_timestamp());";


    if (mysqli_query($conn, $sql)) {

        $_SESSION["alerts_success"] = "Registration Successful, please check your email";
         header("location: login.php");
       exit();

    } else {

        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


        }else{
        
       $_SESSION["alerts_info"] = "Please click google reCAPTCHA";

        }


}


include "header.php"; ?>
<link rel="stylesheet" href="pwdstrength/src/password.css">
<script src="pwdstrength/src/password.js"></script>

  
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
  font-size: 2vh;
  

}

</style>


<div class="container p-5">
<div class="row p-3">

	<div class="col-md-6 rounded-sm"  style="background-image:url(images/blur-background09.jpg); background-size:cover;">

</div>


    <div class="col-md-6 p-0 m-0">
    <div class="card p-4">
        <h2 class="text-center">Register</h2>
      <div class="card-body">
        <div class="d-flex justify-content-end social_icon">
          <a href="#"><i class="fab fa-facebook-square fa-3x ml-1" style="color:#3b5998;"></i></a>
          <a href="#"><i class="fab fa-google-plus-square fa-3x ml-1" style="color:red;"></i></a>
          <a href="#"><i class="fab fa-twitter-square fa-3x ml-1" style="color:#00acee;"></i></a>
        </div>
        <hr>
  <form action="registration.php" method= "post">
    <div class="form-group input-group mt-5">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
         </div>
        <input name="first_name" class="form-control" placeholder="First Name" type="text" required>
</div> <!-- form-group// -->

    <div class="form-group input-group my-4">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
         </div>
        <input name="last_name" class="form-control" placeholder="Last Name" type="text" required>
    </div> <!-- form-group// -->


    <div class="form-group input-group my-4">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
         </div>
        <input name="email" id="email"class="form-control" placeholder="Email address" type="email" required>
    </div><!-- form-group// -->

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
        </div>

    <input id="password" type="password" class="form-control rounded-sm" placeholder="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
    
      <span toggle="#password-field" class="far fa-fw fa-eye field-icon toggle-password"></span>

    </div><!-- form-group// -->    

<!------googlerecaptcha ----->

   <div class="g-recaptcha my-4" data-sitekey="6LfAXtkUAAAAAOw3rmTY3-n___31Jx4JaXugeUG-"></div>

    <div class="form-group">
        <button name="registration" type="submit" class="btn btn-info btn-block" value="register"> Create Account  </button>
    
    </div> <!-- form-group// -->      
    <div class="text-center">Have an account? <a href="login.php">Log In</div> 

</form> 


   </div>
  </div>
 </div>
</div>
</div>

<!--show that email is already in use-->

<script>

  email confirmation

   $("#email").on("focusout", function(){

    console.log("focusout");

///pull information from a field
    var email = $("#email").val();

//send information to the page
    $.get("sample.php", 
        {email: email}, 
        function(data, success){
        $("#warning").html(data);     
            
    });

          
   }); 

</script>



<script type="text/javascript">
  //eye icon changer

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


<script type="text/javascript">

  $('#password').password({
  enterPass: 'Type your password',
  shortPass: 'The password is too short',
  containsField: 'The password contains your username',
  steps: {
    // Easily change the steps' expected score here
    13: 'Really insecure password',
    33: 'Weak; try combining letters & numbers',
    67: 'Medium; try using special characters',
    94: 'Strong password',
  },
  showPercent: false,
  showText: true, // shows the text tips
  animate: true, // whether or not to animate the progress bar on input blur/focus
  animateSpeed: 'fast', // the above animation speed
  field: false, // select the match field (selector or jQuery instance) for better password checks
  fieldPartialMatch: true, // whether to check for partials in field
  minimumLength: 4, // minimum password length (below this threshold, the score is 0)
  useColorBarImage: true, // use the (old) colorbar image
  customColorBarRGB: {
    red: [0, 240],
    green: [0, 240],
    blue: 10,
  } // set custom rgb color ranges for colorbar.

   });
  
</script>
<?php include "footer.php"; ?>


