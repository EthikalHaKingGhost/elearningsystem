  
 <?php 

session_start();

    if(isset($_POST["registration"])){


include "connection.php";

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

        $_SESSION["alerts"] = "Registration Successful";
         header("location: login.php");
       exit();

    } else {

        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


        }else{
        
       $_SESSION["alerts"] = "Please click google reCAPTCHA";

        }


}

include "header.php"; ?>

<div class="container p-5">
<div class="row">

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

    <input  name="password" class="form-control" placeholder="Password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
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
<?php include "footer.php"; ?>
