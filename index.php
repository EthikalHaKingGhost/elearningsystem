
<?php 

session_start();

if(isset($_SESSION["username"])){

  $username = $_SESSION["username"];


}

include 'header.php'; ?>

<div class="banner" style='background-image: url("images/1.jpg")';>
  
</div>


<div class="container-fluid" style="background-image: url('images/blur-background12.jpg');  background-size: cover; background-size: no-repeat; ">

<div class="row">

  <div class="col-md-4 text-center">

        <div class="card text-white bg-danger border-0 mt-5 mb-3">
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

        <div class="card border-0 bg-light mb-5 mt-5">
          <div class="card-body rounded-0">
            <div class="h5 text-left"><strong>Newly Released Courses</strong>
              <hr>
            
<div class="container-fluid">

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

<div class="row py-auto my-2">

<a <?php

      if(isset($_SESSION["user_id"])){
        echo 'href="courses.php"';
      }else{
        echo 'href="register.php"';
      } ?> class="btn btn-light bg-shadow text-decoration-none rounded-0">

<div class="row p-0 m-0">    
 <div class="col-md-3 m-0 p-0">
   <img class="card-img-top e" src="<?php echo "images/$course_img"; ?>" alt="Image">
 </div> 
  
  <div class="col-md-7 rounded-0 my-auto">
    <h5 class="text-left"><?php echo $course_title; ?></h5>
    <p class="card-text text-justify font-italic"><?php echo $course_description; ?></p>
  </div>

  <div class="col-md-2 rounded-0 my-auto">

  </div>
</div>
</a>
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


<?php include 'footer.php'; ?>