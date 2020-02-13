<?php
session_start();

if(isset($_POST["login"])){

    include "connection.php";
    $email = $_POST["email"];                                           
    $password = $_POST["password"];

    $sql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

            $db_password = $row["password"];
            if(password_verify($password, $db_password)){

                    echo "You are logged in";
                    $_SESSION["user_id"] = $row["user_id"];
                    $_SESSION["first_name"] = $row["first_name"];
                    $_SESSION["last_name"] = $row["last_name"];
                    $_SESSION["email"] = $row["email"];             
                    header("location: homepage.php");
                     // for login page
                    //redirect to page
            } else 
                    echo "incorrect password";
            }
            } else {
                 echo "Please enter correct login information";
            }
}
include "header.php"; ?>

<h1>Login</h1>

    <form action="login.php" method="post">
    
    <p>Email <input type="text" name="email"></p>

    <p>Password <input type="password" name="password"></p>
    
    <input type="submit" name="login">
    
    </form>












<?php include 'footer.php'; ?>

