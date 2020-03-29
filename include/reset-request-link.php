<?php

//code supported by mmuts
// two tokens one for authentication and one to pin point data used
//this avoids timing attacks from hackers

if (isset($_POST["reset-resquest-submit"])) {

$selector = bin2hex(random_bytes(8));
$token = random_bytes(32); //has to be longer to be secure

$url = "http://localhost/elearningproject/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

//set time for token to expired.
$expires = date("U") + 1800;


include "connection.php";


$email = $_POST["email"];

//delete any exsisting tokens to prevent bulking

$sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
$stmt =mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
	 
	 header("location: ../register.php?error=pwdReseterror");

	 exit();

}else{

	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
}


$sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";

$stmt =mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
	 
	 header("location: ../register.php?error=pwdReseterror");

	 exit();

}else{ 

	$hashedToken = password_hash($token, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, "ssss", $email, $pwdResetSelector, $hashedToken, $pwdResetExpires );
	mysqli_stmt_execute($stmt);
}


mysqli_stmt_close($stmt);
mysqli_close($conn);



$to = $email;

$subject = 'Reset your password for your account';

$message = "<p> Click the link below to reset your customer account password. If you didn't request a new password, you can safely delete this email.</p>";
$message .= "<p> Here is your password reset link: </br>";

$message .= '<a href="' . $url . '">' . $url . '<a/></p>';

include("../include/gmail.php");

/*$headers = "From: Elearningproject <travo.edward@gmail.com>\r\n";

$headers .= "Reply-To: Elearningproject travo.edward@gmail.com>\r\n";

$headers .= "Content-type: text/html\r\n";

mail($to, $subject, $message, $headers); */


header("location: ../resetpassword.php?reset=success");

}else{

	echo "error";

	/* header("location: ../index.php"); */


}