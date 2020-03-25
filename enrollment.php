<?php 

session_start();

    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];

    }else{
        echo "<h1>OOPS!</h1><hr>";
        $_SESSION["alerts_info"] = "please login";

        exit();
    }


     if(isset($_GET["cid"])){
         $course_id = $_GET["cid"];
         $page= "enrollment.php?cid=$course_id";   

    }else{
        
         $_SESSION["alerts_info"] = "Please select a course to enroll";

         exit();
    }           
        

                include 'connection.php'; 

                $sql = "SELECT * FROM enrollment WHERE enrollment.course_id = $course_id AND enrollment.user_id = $user_id";
                $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)){
                            //enoll id from database
                            $enroll_id = $row["enroll_id"];
                            
                
                            
                    //send user to topics page
                    $link = "topics.php?eid=$enroll_id&cid=$course_id";

                    header("location: $link");  
                    exit();
                  }
              }
    
       
        //insert enrollment information from database

                include "connection.php";

                        if(isset($_POST["enroll"])){

                        $sql = "INSERT INTO `enrollment` (`enroll_id`, `course_id`, `user_id`) VALUES (NULL, '$course_id', '$user_id');";

                        if (mysqli_query($conn, $sql)) {

                    $enroll_id = mysqli_insert_id($conn);
                    $link = "topics.php?eid=$enroll_id&cid=$course_id";

                    $_SESSION["alerts"] = "course enrolled";

                    header("location: $link");

                    exit();
                        
                } else {
                    
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                
                }
            }



include 'header.php'; ?>


<div class="banner">
    <h1>Enrollment</h1>
</div>

<div class="container p-3 my-3 bg-dark text-white">
  
<form action="<?php echo $link;?>" method="post">

     <?php include 'connection.php'; 

                $sql = "SELECT * FROM courses WHERE course_id = $course_id";
                $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)){
                            //enoll id from database
                         
                            $course_title =$row["course_title"];
                
    
                       }
                   }

              ?>
    
<h3 class="pb-5">Thank you for choosing our <?php echo $course_title; ?>  Course please Click next to enroll into this course</h3>

<a class="btn btn-danger btn-lg" href="courses.php">Cancel</a>

<input class= "btn btn-success btn-lg" type=submit value="Next" name="enroll">

</form>

</div>

<?php include 'footer.php'; ?>