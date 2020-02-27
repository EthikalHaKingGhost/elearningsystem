
<?php if(session_status() === PHP_SESSION_NONE) session_start(); 


  ?>

<!DOCTYPE html>
<html lang="en">
<head>

<!----------bootstrap------------>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!--------------fontawesome------------------------------->

<script src="https://kit.fontawesome.com/bc9aeacf84.js" crossorigin="anonymous"></script>


<!----google recaptcha -----> 

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!----google recaptcha end ----->

</script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
  <a class="navbar-brand" href="#">ElearningProject</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">

            <ul class="nav navbar-nav navbar-right">
              <li class="nav-item">
                <a class="nav-link" href="homepage.php" class="active-page">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php" class="active-page">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="courses.php"class="active-page">Courses</a>
              </li>

        <li class="nav-item">
            <?php if(isset($_SESSION["first_name"])){  

              $first_name = $_SESSION["first_name"];
              $last_name = $_SESSION["last_name"];

              ?>
                    <li class="nav-item" >
                    <a class="nav-link" href ="logout.php"><?php echo "Logout"; ?> </a>
                    
                    <li class="nav-item"> 
                    <a class="nav-link" href ="##"> <?php echo "Welcome $first_name $last_name";?> </a>

                    <li class="nav-item"> 
             <?php
                    } else {             
                    echo '<a class="nav-link" href="registration.php">REGISTER</a>';
             ?> 


                    <li class="nav-item"> 
             <?php echo '<a class="nav-link" href="login.php">Login</a>';

                   echo '</ul>';
                    }
             ?> 
            </li>    
            </li>
          </ul>
        </div>  
      </nav>

<style>
.nav .nav-link{
  color: orange;
}

/*body { 
  background: url("./background/blur-background11.jpg") no-repeat center center fixed; 
   background-color: #cccccc;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style> 

  