

<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
  <html lang="en">
    <head>
      <link rel="stylesheet" href="styles.css">
        <title>E-learning2020</title>
            <link rel="shortcut icon" type="image/png" href="images/favicon.png">
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
          <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
          <link rel="stylesheet" type="text/css" href="icons/css/all.min.css">
          <script src="https://www.google.com/recaptcha/api.js" async defer></script>


<style>

html body{
  padding:0;
  margin:0;
}

.avatar{
  cursor: pointer;
}

.navbar a{
  color: #34495e !important;
  font-family: 'Raleway', sans-serif;
  font-size:15px;
  font-weight:800;
  }

  .navbar-brand {
    font-size:18px !important;
  }

body,p,h1,h2,h3,h4,h5,h6 {
  font-family: Georgia, Times, "Times New Roman", serif;

}

.banner{

height:200px;
 width:100%;
  background-color:#ecf0f1;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;

}

</style>

</head>

<body>

   <?php
        if (isset($_GET["error"])) {

          if ($_GET["error"] == "wronginfo") {

echo
            '<div class="alert alert-danger m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong> incorrect login details please try again, or <a href="create-new-password.php">forgot password </a></div>';


        } else if ($_GET["error"] == "nouser") {

echo
            '<div class="alert alert-danger m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong> You have entered an invalid username please try again, or <a href="register.php">SIGN UP </a> for FREE </div>';

        }


      }

 ?>


 <div class="header-nav bg-light sticky-top">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
            
            <a class="navbar-brand ml-4" href="index.php"><img src="images/logo.png"><b>E-Learning2020</b></a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item ml-2 active ">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
                    <?php

                        if(isset($_SESSION["user_id"])){

                           

                        }else{

                         
                              echo  '<li class="nav-item ml-2">
                                    <a class="nav-link" href="about.php">About Us</a>
                                  </li>
                                  <li class="nav-item ml-2">
                                    <a class="nav-link" href="courses.php">Courses</a>
                                  </li>'; 
                       
                                  
                            }
                      ?>


               </ul>

         <?php

            if(isset($_SESSION["user_id"])){
                    $username = $_SESSION["username"];
                    $user_id = $_SESSION["user_id"];
        ?>

 <ul class="navbar-nav ml-auto nav-flex-icons mr-4">
        <li class="nav-item avatar dropdown">
          <a class="nav-link" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <img  class=" border border-secondary rounded-circle z-depth-0" alt="S" src=<?php echo "images/logo.png" ?> > <?php echo  "$username"; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-5">
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">settings</a>
            <a class="dropdown-item" href="include/logout.php"><?php echo "Logout";?></a>
          </div>
        </li>
      </ul>
          
      <?php


        }else{

      ?>
           <form action="include/login-header.php" method="post" class="form-inline my-2 my-sm-0">
              <div class="col-auto pl-0 pr-1">
                <div class="input-group">
                  <input type="text" name="mailuid" class="form-control form-control-sm rounded" placeholder="username">
                </div>
              </div>
              <div class="col-auto pl-0 pr-1">
                <div class="input-group">
                  <input type="password" name="pwd" class="form-control form-control-sm rounded" id="inlineFormInputGroup" placeholder="Password">
                </div>
              </div>
              <div class="col-auto pl-0 pr-0">
                  <button class="btn btn-info btn-sm my-2 rounded-lg" type="submit" name="signin">Login</button>
                </div>
            </form>

            <form action="register.php" method="post" class="form-inline my-2 my-lg-0">
          <div class="col-auto pl-2 pr-0">
            <button class="btn btn-warning btn-sm my-2 rounded-lg" type="submit">SIGN UP!</button>
            </div>
          </form>

      <?php
    }
?>
          </div>
        </nav>  
      </div>
    </div>
  </div>
  </div>
  











  