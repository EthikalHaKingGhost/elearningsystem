




<?php 

session_start();

if(isset($_SESSION["username"])){

  $username = $_SESSION["username"];


}

 include 'header.php';?> 


<style>

.banner{

  background-image: url("images/1.jpg");

}

.parallax {
  background-image: url("./images/ma.jpg");

  opacity: 0.9;
    filter: brightness(50%);
    height: 300px;

  background-attachment: fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-position: center;
  -o-background-size: cover;
  background-repeat: no-repeat;
  background-size: cover;

}
.paragraph{
  margin: 20px;
  padding: 20px;
  background-color: #555;
  color: white;
}

</style>




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

 

<div class="banner">
  
</div>


<div class="container-fluid">

<div class="row">

  <div class="col-md-4 text-center">

        <div class="card text-white bg-danger border-0 mt-3 mb-3">
          <div class="card-header">Health Update!</div>
          <a style="text-decoration: none; color:white;" href="about.php">
          <div class="card-body rounded-lg card-danger">
            <h5>Coronavirus (COVID-19) - updated 4pm</h5></a>
          </div>
        </div>

        <div class="card border-0 bg-light">
          <div class=" card-header"><strong>News Update!</strong></div>
          <div class="card-body">
            <h5 class="card-title">Discounts</h5>
            <p>
              Please be advised that all new registion fees will be canceled registeration to our courses are now free of charged. There will be a discount on all Maths courses by weekend. If you need more information please contact us via email.
            </p>

          </div>
        </div>

  </div>


  <div class="col-md-8 text-center">

        <div class="card border-0 bg-light mb-3 mt-3">
          <div class="card-body">
            <h5 class=" card-header text-center"><strong>Newly Released Courses</strong></h5>
            
<div class="container-fluid p-3 mb-3">
    <div class="row m-0 text-center p-4">

<?php 

include 'include/connection.php';

//code to show recent courses added

        $sql = "SELECT * FROM Courses ORDER BY `Courses`.`date_created` ASC LIMIT 3";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                            
        $course_id = $row["course_id"]; 
        $course_title = $row["course_title"];
        $course_description = $row["course_description"];
        $course_img = $row["course_img"];  

    ?>

<div class="col-md-4">
<div class="card">
  <img class="card-img-top e" src="<?php echo "images/$course_img"; ?>" alt="Card image cap">
  <div class="card-body">
    <p class="card-text"><?php echo $course_description; ?></p>
    <h5 class="card-title"><?php echo $course_title; ?></h5>
    <hr>
    <a 

<?php
  if(isset($_SESSION["user_id"])){
    echo 'href="courses.php"';
  }else{
    echo 'href="register.php"';
  }
?>

 class="btn btn-dark btn-sm">find out more</a>
  </div>
</div>
</div>

          
<?php

  }                
          }else{

            header("location: index.php?error=nocourses");

        }

    ?>
</div>
</div> 


          </div>
        </div>
        

  </div>
  

</div>


</div>









<!-- Container element -->
<div class="parallax"></div>


<?php include 'footer.php'; ?>