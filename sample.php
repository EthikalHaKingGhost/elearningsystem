<?php

if(isset($_GET["email"])){

  $email = $_GET["email"];
}


include "include/connection.php";

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

        
   echo "Email Valid";

} 

} else {
    echo "email already exsist";
}

?>




