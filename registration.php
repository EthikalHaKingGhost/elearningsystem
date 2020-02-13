
<?php 

	if(isset($_POST["registration"])){

include "connection.php";
    $user_id = $_POST["user_id"];
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$email = $_POST["email"];
	$password = $_POST["password"];

	$password = password_hash($password, PASSWORD_DEFAULT);

	//////////////////////////////////////////////////////////////

	$sql = "INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `regdate`) 
	VALUES ('NULL', '$first_name', '$last_name', '$email', '$password', current_timestamp());";


	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

}

include 'header.php'; ?>

  	<h1>Student Registration</h1>

	<form action="registration.php" method= "post">

	<p>First Name: <input type="text" name="first_name"></p>
	<p>Last Name: <input type="text" name="last_name"></p>
	<p>Email: <input type="text" name="email"></p>
	<p>Password: <input type="text" name="password"></p>

	<input type="submit" name="registration" value="Register">

	</form>

<?php include 'footer.php';?>