
<?php
session_start();

if(isset($_POST["login"])){

    include "connection.php";

//add login as admin functionality

    $email = $_POST["email"];                       
    $password = $_POST["password"];


    $sql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

            $db_password = $row["password"];
            if(password_verify($password, $db_password)){

                    $_SESSION["user_id"] = $row["user_id"];
                    $_SESSION["first_name"] = $row["first_name"];
                    $_SESSION["last_name"] = $row["last_name"];
                    $_SESSION["email"] = $row["email"]; 

                    $_SESSION["alerts"] = "Login Successful"; 

                    header("location: index.php");
                    exit();

                     // for login page
                    //redirect to page

            } else 
            $_SESSION["alerts"] = "incorrect Login Details";
            }
            } else {
            $_SESSION["alerts"] = "Please enter correct login information";
            }
		}

include 'header.php'; ?>

<style>

.container{
padding: 50px;
}

.card{
background-image: url("./images/blur-background13.jpg");
height: 400px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
border:none;
align-content: center;
background-attachment: fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
background-position: center;
-o-background-size: cover;
background-repeat: no-repeat;
background-size: cover;  
background-image: url("./images/blur-background13.jpg");
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}
.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -15px;
}

.input-group-prepend span{
width: 50px;
background-color: #FFC312;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #FFC312;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}

.footer-links:hover {color:#FFC312;
}




</style>

<title>Login Page</title>
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form action="login.php" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Email Address" name="email">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="password">
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div>
					<div class="form-group">
						<input type="submit" name="login" class="btn float-right login_btn" value="Login">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="registration.php" class="footer-links">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#" class="footer-links">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>


<?php include 'footer.php'; ?>