
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
  <a class="navbar-brand" href="#">ElearningProject</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="homepage.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="courses.php">courses</a>
      </li>
        <li class="nav-item">
  <?php
if(isset($_SESSION["first_name"])){

echo '<a class="nav-link" href ="logout.php">Logout</a>';
} else {
echo '<a class="nav-link" href="registration.php">REGISTER</a>';
?> 
<li class="nav-item"> 
  <?php
echo '<a class="nav-link" href="login.php">Login</a>';
echo '<ul>';
}
?> 
      </li>    
      </li>
    </ul>
  </div>  
</nav>

<style>
body  {
  background-image: url("./background/blur-background09.jpg");
  background-color: #cccccc;
      background-size: cover;
background-repeat: no-repeat;

}

}
</style> 
