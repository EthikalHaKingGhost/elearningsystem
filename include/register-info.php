  
<?php 

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



if(isset($_POST["register"])){

  include 'connection.php';

  //google recaptcha 
    $secret = "6LfAXtkUAAAAALan_VfC9IweBZkDE5SRSJUIP5Lz";
    $response = $_POST["g-recaptcha-response"];
    $remoteip = $_SERVER["REMOTE_ADDR"];
    $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    $google_response =  file_get_contents($recaptcha_url);
    $google_details = json_decode($google_response);



$username = $_POST["uid"];
$email = $_POST["mail"];
$password = $_POST["pwd"];
$password_repeat = $_POST["pwd-repeat"];           

$sql = "SELECT * FROM users WHERE uid_username = '$username' and email='$email'";
        $result = mysqli_query($conn, $sql);
        if($result){
          if (mysqli_num_rows($result) > 0) {

            echo "user already exist;";

}else{

  if (empty($username) || empty($email) || empty($password) || empty($password_repeat) ){
    header("location: ../register.php?error=emptyfields&uid=".$username."&mail=".$email);

  exit();


  //check for both username and email
  }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){

    header("location: ../register.php?error=invalidmailuid");

  exit();

 
//check parameter to see if email is valid

  }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){

        header("location: ../register.php?error=invalidmail&uid=".$email);

  exit();


  }elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){

        header("location: ../register.php?error=invaliduid&mail=".$username);

 exit();


}elseif($password !== $password_repeat){

     header("location: ../register.php?error=passwordcheck&uid=".$username."&email=".$email);

exit();

//added recaptcha v3 for more security
}elseif($google_details->success){

//prepared statements to prevent SQL hacking
  $sql = "SELECT uid_username FROM users WHERE uid_username=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {

    header("location: ../register.php?error=sqlerror");

exit();


}else{

//pass on string to the database
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {

        header("location: ../register.php?error=usertaken&mail=".$username);
exit();

}else{

//sign user in prevent sq hack
      $sql = "INSERT INTO users (uid_username, email, password) VALUES(?, ?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {

        header("location: ../register.php?error=sqlerror");

exit();

}else{

$password_hash = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password_hash);
    mysqli_stmt_execute($stmt);

    header("location: ../register.php?signup=success");

   exit();

}

}  

}

}else{

  header("location: ../register.php?error=norecaptcha");

exit();

}

mysqli_stmt_close($stmt);
mysqli_close($conn);


}else{

  header("location: ../register.php");

exit();

}
