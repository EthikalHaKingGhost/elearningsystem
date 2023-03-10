<<?php 

if(isset($_POST["signin"])){

include "connection.php";

$mailuid =  $_POST["mailuid"];

$password = $_POST["pwd"];

if(empty($mailuid) || empty($password)){

	header("location: ../register.php?error=emptyfields");

	exit();

}else{

	//allow use to signin with email or username

	$sql = "SELECT * FROM users WHERE uid_username=? OR email=?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {

		header("location: ../register.php?error=sqlerror");
		
		exit();

	}else{

		mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		}if ($row = mysqli_fetch_assoc($result)) {
			$pwdCheck = password_verify($password, $row["password"]);
			if($pwdCheck == false){

				header("location: ../register.php?error=wronginfo");

			exit();

//keep user logged in

		}else if ($pwdCheck == true){

			session_start();

			$_SESSION["user_type"] = $row["user"];
			$_SESSION["user_id"] =$row["user_id"];
			$_SESSION["username"] =$row["uid_username"];

		require 'connection.php';

			$sql = "UPDATE `users` SET `last_login` =  CURRENT_TIMESTAMP() WHERE `users`.`user_id` = '{$row["user_id"]}'";

			$query = mysqli_query($conn, $sql);
			

		header("location: ../index.php?login=success");
		
		exit();

	}else{

		header("location: ../register.php?error=wronginfo");
		
		exit();
	}
	
	}else{

		header("location: ../register.php?error=nouser");

		exit();

	}

}

}else{

	header("location: ../register.php");
}

 