
<style>

html body{
  background-color:#D3D3D3;
}


.active {
  background-color: #FFC312;
  transition: 0.3s;
  }
.active:hover{
  filter: brightness(110%);
}

li:hover {
  background-color: #FFC312;
}

li:active{
  background-color: darkorange;
}

.nav-item .nav-link{
    color: white !important;
    font-size: 1em !important;
    font-family: 'Lato', sans-serif;
    }


body,h1,h2,h3,h4,h5,h6 {
  font-family: "Lato", sans-serif;}

.banner{
  width:auto;
  height:150px;
  background-color:#ecf0f1;
  background-attachment: fixed;
  margin: 0;
  padding: 50px;
  text-align:center;
  vertical-align: middle;

}


</style>


<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
  <html lang="en">
    <head>
      <link rel="stylesheet" href="styles.css">
        <title>Learning Management System</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!--------------fontawesome------------------------------->

            <link rel="stylesheet" type="text/css" href="icons/css/all.min.css">

            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      </head>

<body>

<nav class="navbar navbar-expand-sm bg-info navbar-dark sticky-top pl-5 pr-5">
  <a class="navbar-brand" href="#">ElearningProject</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="courses.php">Courses</a>
                </li>

              <?php if(isset($_SESSION["first_name"])){  

              $first_name = $_SESSION["first_name"];

              ?>
                    <li class="nav-item dropdown">
                    
                    
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $first_name; ?>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item" href="#">Account</a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="#">Settings</a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href ="logout.php"><?php echo "Logout"; ?> </a>
                </div>
            </li>
                    

                    

                    <?php

                           } else { 
                           echo '<li class="nav-item">';
                           echo '<a class="nav-link" href="login.php">Login</a>';
                           echo "</li>"; 
                           echo "</ul>";         


                           echo '<ul class="nav navbar-nav ml-auto">';
                            echo '<li class="nav-item active">'; 
                           echo '<a class="nav-link" href="registration.php">REGISTER</a>';
                           echo "</li>"; 
                          echo "</ul>";
                       }

                     ?> 

                    </li>    
                 </li>
             </div>  
           </nav>

<?php

    if(isset($_SESSION["alerts_success"])){
        $alerts_success = $_SESSION["alerts_success"];

        ?>

        <div class="alert alert-success alert-dismissible" name="alerts">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong><?php echo $alerts_success; ?>
        </div>
      
    
       
        <?php

          unset($_SESSION["alerts_success"]);

      }



    if(isset($_SESSION["alerts_danger"])){
        $alerts_danger = $_SESSION["alerts_danger"];

        ?>

        <div class="alert alert-danger alert-dismissible" name="alerts">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong><?php echo $alerts_danger; ?>
        </div>
      
    
        <?php

          unset($_SESSION["alerts_danger"]);

      }


    if(isset($_SESSION["alerts_info"])){
        $alerts_info = $_SESSION["alerts_info"];

        ?>

        <div class="alert alert-info alert-dismissible" name="alerts">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong><?php echo $alerts_info; ?>
        </div>
      
    
       
        <?php

          unset($_SESSION["alerts_info"]);

      }

?>









  