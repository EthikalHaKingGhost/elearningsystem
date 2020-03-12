
<style>

li a:hover {
  background-color: #FFC312;
}

li a:active{
  background-color: darkorange;
}

body h1{
  margin: 20px;
}

body,h1,h2,h3,h4,h5,h6 {
  font-family: "Lato", sans-serif;}

body, html {
  height: 100%;
  line-height: 1.8;
}

body hr{
     position: relative; 
     border: none; 
     background: slategrey; 
     margin-bottom: 30px;

     padding:1px;
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

            <script src="https://kit.fontawesome.com/bc9aeacf84.js" crossorigin="anonymous"></script>

            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="courses.php">Courses</a>
              </li>

        <li class="nav-item">
            <?php if(isset($_SESSION["first_name"])){  

              $first_name = $_SESSION["first_name"];
              $last_name = $_SESSION["last_name"];

              ?>
                    <li class="nav-item" >
                    <a class="nav-link" href ="logout.php"><?php echo "Logout"; ?> </a>
                    
                    <li class="nav-item"> 
                    <a class="nav-link" href ="#"> <?php echo '<i class="fa fa-fw fa-user"></i>'. $first_name ;?></a>

                    <li class="nav-item"> 

                    <?php
                           } else {             
                           echo '<a class="nav-link active" href="registration.php">REGISTER</a>';
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

<?php

    if(isset($_SESSION["alerts"])){
        $alerts = $_SESSION["alerts"];

        ?>
          <div class="message">
          <div class="alert alert-info" id="alerts" name="alerts">
            <strong>Message!</strong> <?php echo $alerts; ?>
          </div>
          </div>

   <script> 
            $("#alerts").fadeTo(2000, 600).slideUp(600, function(){
            $("#alerts").slideUp(600);
            });
          </script>

       
        <?php

          unset($_SESSION["alerts"]);

      }

?>






  