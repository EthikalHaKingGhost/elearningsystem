<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
  <html lang="en">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <title>E-learning2020</title>
        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
        <link rel="stylesheet" type="text/css" href="include/style.css">
            
          <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
          <link rel="stylesheet" type="text/css" href="icons/css/all.min.css">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
          <script src="https://www.google.com/recaptcha/api.js" async defer></script>
         

  </head>

<body>

<?php include "include/alerts.php"; ?>

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
              <li class="nav-item ml-2">
                <a class="nav-link" href="courses.php">Courses</a>
              </li>
              
            

                         <?php
if (isset($_SESSION["user_id"]))
{
    $username = $_SESSION["username"];
    $user_id = $_SESSION["user_id"];
?>
      <li class="nav-item ml-2">
        <a class="nav-link" href="dashboard.php">Dashboard</a>
      </li>
    </ul>
      <ul class="navbar-nav ml-auto nav-flex-icons mr-4">
        <li class="nav-item avatar dropdown">
          <a class="nav-link" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <img  class=" border border-secondary rounded-circle z-depth-0" alt="S" src=<?php echo "images/logo.png" ?> > <?php echo "$username"; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-5">
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">settings</a>
            <a class="dropdown-item" href="include/logout.php"><?php echo "Logout"; ?></a>
          </div>
        </li>
      </ul>
          
      <?php
}
else
{


?>    

        <li class="nav-item ml-2">
          <a class="nav-link" href="about.php">About Us</a>
        </li>
        </ul>

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
