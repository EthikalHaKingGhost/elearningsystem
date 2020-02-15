
<?php 
	if(isset($_POST["registration"])){

include "connection.php";

	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	
	$password = password_hash($password, PASSWORD_DEFAULT);

	//////////////////////////////////////////////////////////////

	$sql = "INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `regdate`) 
	VALUES ('NULL', '$first_name', '$last_name', '$email', '$password', current_timestamp());";

	if (mysqli_query($conn, $sql)) {
         header("location: login.php");
    
        echo "Welcome please login in with your user credentials";

       
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

}


include 'header.php'; ?>

<style>


.divider-text {
    position: relative;
    text-align: center;
    margin-top: 15px;
    margin-bottom: 15px;
}
.divider-text span {
    padding: 7px;
    font-size: 12px;
    position: relative;   
    z-index: 2;
}
.divider-text:after {
    content: "";
    position: absolute;
    width: 100%;
    border-bottom: 1px solid #ddd;
    top: 55%;
    left: 0;
    z-index: 1;
}

.text-center{
    color: White;
}
.card-title{
    color: White;
}

.input-group-prepend span{
width: 50px;
background-color: #FFC312;
color: black;
border:0 !important;
}
.btn-facebook {
    background-color: #FFC312;
    color: black;
}
.btn-twitter {
    background-color: #FFC312;
    color: black;
}

.btn-primary{
     background-color: #FFC312;
    color: black;
    border: none;
}
.btn-facebook:hover{
color: black;
background-color: #3b5998;
}
.btn-twitter:hover{
color: black;
background-color: #00acee;
}
.btn-primary:hover{
color: black;
background-color: #39C16C;
}
.card{
height: 100%;
margin-top: auto;
margin-bottom: auto;
width: 100%;
background-color: rgba(0,0,0,0.5) !important;
}


</style>

<br>
<div class="container" >
<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Create Account</h4>
	<p class="text-center">Get started with your free account</p>
	<p>
		<a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
		<a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
	</p>
	<p class="divider-text">
        <span class="bg-light">OR</span>
    </p>
	<form action="registration.php" method= "post">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="first_name" class="form-control" placeholder="First Name" type="text" required>



    </div> <!-- form-group// -->
    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="last_name" class="form-control" placeholder="Last Name" type="text" required>
    </div> <!-- form-group// -->



    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email" class="form-control" placeholder="Email address" type="email" required>
    </div> <!-- form-group// -->



    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-building"></i> </span>
			</div>
		<select class="form-control">
			<option selected=""> Select employement status</option>
			<option>Employed</option>
			<option>Unemployed</option>
		</select>
	</div> <!-- form-group end.// -->



    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>

        <input  name="password" class="form-control" placeholder="Password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
	title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required></p>
    </div> <!-- form-group// -->    


    <div class="form-group">
        <button name="registration" type="submit" class="btn btn-primary btn-block" value="register"> Create Account  </button>
    </div> <!-- form-group// -->      
    <p class="text-center">Have an account? <a href="login.php">Log In</a> </p>

</form>
</article>
</div> <!-- card.// -->
</div>
<br><br>
</article>
<?php include 'footer.php'; ?>