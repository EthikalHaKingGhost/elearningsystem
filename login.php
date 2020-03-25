
<?php
session_start();

if(isset($_POST["login"])){

    include "connection.php";

//add login as admin functionality

    $email = $_POST["email"];                       
    $password = $_POST["password"];


    $sql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

            $db_password = $row["password"];
            if(password_verify($password, $db_password)){

                    $_SESSION["user_id"] = $row["user_id"];
                    $_SESSION["first_name"] = $row["first_name"];
                    $_SESSION["last_name"] = $row["last_name"];
                    $_SESSION["email"] = $row["email"];
                    $first_name = $_SESSION["first_name"];
                    $last_name = $_SESSION["last_name"];


                   $_SESSION["alerts_success"] = ' Login Successful, Welcome ' .$first_name. ', ' .$last_name. '! <i class="fas fa-smile"></i>'; 

                    header("location: index.php");

                    exit();

                     // for login page
                    //redirect to page

            } else 
            $_SESSION["alerts_danger"] = "You have entered an invalid username or password";
            }
            } else {
            $_SESSION["alerts_danger"] = "You have entered an invalid username or password";
            }
    }



include "header.php"; ?>

<div class="container p-5">
<div class="row">

  <div class="col-md-6 rounded-sm"  style="background-image:url(images/blur-background09.jpg); background-size:cover;">

</div>

  <div class="col-md-6 p-0 m-0">
    <div class="card p-4">
      <h2 class="text-center">Login</h2>
      <div class="card-body">
        <div class="d-flex justify-content-end social_icon">
          <a href="#"><i class="fab fa-facebook-square fa-3x ml-1" style="color:#3b5998;"></i></a>
          <a href="#"><i class="fab fa-google-plus-square fa-3x ml-1" style="color:red;"></i></a>
          <a href="#"><i class="fab fa-twitter-square fa-3x ml-1" style="color:#00acee;"></i></a>
        </div>
        <hr>
  
        <form action="login.php" method="post">
          <div class="input-group form-group my-4">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Email Address" name="email">
          </div>


          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" class="form-control" placeholder="password" name="password">
          </div>
     
          <div class="custom-control custom-checkbox my-1 mr-sm-2 my-4">
          <input type="checkbox" class="custom-control-input" id="customControlInline">
          <label class="custom-control-label" for="customControlInline">Remember Me</label>
          </div>


          <div class="form-group">
            <input type="submit" name="login" class="btn btn-success btn-block" value="Login">
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
</div>


            
</body>
</html>