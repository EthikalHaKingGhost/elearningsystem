 <?php
if(session_status() === PHP_SESSION_NONE) session_start();  


if (isset($_GET["signup"])) {

  if ($_GET["signup"] == "success") {

   echo '<div class="alert alert-success m-0 alert-sm alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong> Registration successful, Please check you email!</div>';

      }
    }

  
        if (isset($_GET["login"])) {

          if ($_GET["login"] == "success") {

        echo  '<div class="alert alert-success m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong> Welcome <b>' .$_SESSION["username"]. '</b> You have logged in successfully!</div>';

        }else{


        }
    }


if (isset($_GET["newpwd"])) {

          if ($_GET["newpwd"] == "pwdupdated") {

echo
            '<div class="alert alert-danger m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong> Your password has been changed successfully!</div>';

        }

      }



if (isset($_GET["error"])) {

    ?>
          <div class="alert alert-danger m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong> 
<?php

    if ($_GET["error"] == "wronginfo") {

    echo 'incorrect login details please try again, or <a href="create-new-password.php">forgot password </a>';

  }else if ($_GET["error"] == "nouser") {

    echo 'You have entered an invalid username please try again, or <a href="register.php">SIGN UP </a> for FREE';

  }else if ($_GET["error"] == "norecaptcha") {

      echo 'Please Click the google recaptcha checkbox to validate that you are not a bot';

  }else if ($_GET["error"] == "topic") {

    echo 'This Topic already exsist';

  } else if ($_GET["error"] == "url") {

      echo 'Error in the url please select a course and enroll';

  } else if ($_GET["error"] == "wrongpwd") { 

 echo 'incorrect email or password please sign in , successful, Please check you email!';

}


?>
</div>
<?php

}

if (isset($_GET["info"])) {

            ?>
        <div class="alert alert-info m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong> 

          <?php

            if ($_GET["info"] == "login") {

          echo 'Please Log in to continue, do not have an account? thats fine Registeration is FREE -- "<a href="register.php">register.</a>"</div>';

        }
    }





if(isset($_SESSION["alerts_info"])){
  
        $alerts_info = $_SESSION["alerts_info"];

        echo '<div class="alert alert-info alert-dismissible" name="alerts">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message! </strong>'.$alerts_info.'</div>';

          unset($_SESSION["alerts_info"]);

      }


    if(isset($_SESSION["alerts_success"])){

      echo "something";
  
        $alerts_success = $_SESSION["alerts_success"];

        echo '<div class="alert alert-success alert-dismissible" name="alerts">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success! </strong>'.$alerts_success.'</div>';

          unset($_SESSION["alerts_success"]);

      }






if(isset($_SESSION["alerts_danger"])){
        $alerts_success = $_SESSION["alerts_danger"];

   echo

        '<div class="alert alert-danger alert-dismissible" name="alerts">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Alert! </strong>' .$alerts_danger. '
        </div>';

          unset($_SESSION["alerts_danger"]);

      }



if(isset($_SESSION["alerts_warning"])){

        $alerts_success = $_SESSION["alerts_warning"];

       echo '<div class="alert alert-info alert-dismissible" name="alerts">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning! </strong>'.$alerts_warning.'</div>';

          unset($_SESSION["alerts_warning"]);

      }
?>