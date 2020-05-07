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


        }else if ($_GET["error"] == "norecaptcha") {

echo
            '<div class="alert alert-danger m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong> Please Click the google recaptcha checkbox to validate that you are not a bot</div>';


        }else if ($_GET["error"] == "topic") {

echo
            '<div class="alert alert-warning m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong>This Topic already exsist</div>';

        }


      }


 ?>



<?php
  
        if (isset($_GET["info"])) {

          if ($_GET["info"] == "login") {

        echo  '<div class="alert alert-info m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong> Please Log in to continue, do not have an account? thats fine Registeration is FREE -- "<a href="register.php">register.</a>"</div>';

        }
    }

?>

<?php 

if (isset($_GET["signup"])) {

  if ($_GET["signup"] == "success") {

   echo '<div class="alert alert-success m-0 alert-sm alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong> Registration successful, Please check you email!</div>';

      }
    }
?>


<?php
  
        if (isset($_GET["login"])) {

          if ($_GET["login"] == "success") {

        echo  '<div class="alert alert-success m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong> Welcome <b>' .$_SESSION["username"]. '</b> You have logged in successfully!</div>';

        }else{


        }
    }


  
        if (isset($_GET["error"])) {

          if ($_GET["error"] == "url") {

         echo  '<div class="alert alert-warning m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>OOPS! </strong> Error in the url please select a course and enroll </div>';

        }else{


        }

    }

    if (isset($_GET["error"])) {

          if ($_GET["error"] == "limit") {

         echo  '<div class="alert alert-danger m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>OOPS! </strong> You have reached the maximum number of attempts, please check administration</div>';

        }else{


        }
    }


  if (isset($_GET["error"])) {

          if ($_GET["error"] == "url") {

         echo  '<div class="alert alert-success m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>OOPS! </strong> Topic created successfully</div>';

        }else{


        }

    }

?>



<!------successful password reset --------->

   <?php
        if (isset($_GET["newpwd"])) {

          if ($_GET["newpwd"] == "pwdupdated") {

echo
            '<div class="alert alert-danger m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong> Your password has been changed successfully!</div>';

        }

      }

 ?>




 <?php
        if (isset($_GET["error"])) {

          if ($_GET["error"] == "wrongpwd") {

?>
            <div class="alert alert-danger alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Message!</strong><?php echo "incorrect email or password please sign in , successful, Please check you email!" ?>
            </div>


<?php

        }

      }

  ?>