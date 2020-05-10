
<?php 
session_start();

if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];

}else{

            header('location: register.php?info=login');


    exit();

}

if(isset($_GET["cid"])){
$course_id = $_GET["cid"];

}else {

            header('location: courses.php?error=url');

    exit();
}



if(isset($_GET["eid"])){
    $enroll_id = $_GET["eid"];
}else{

            header('location: courses.php?error=url');

    exit();
}


include 'header.php'; ?>

<div class="banner" style="background-image: url(images/1.jpg);">
    
</div>
<?php

include 'include/connection.php';

 $sql = "SELECT * FROM courses, topics, topics_assigned WHERE courses.course_id = topics_assigned.course_id AND topics.topic_id = topics_assigned.topic_id AND courses.course_id = '$course_id'";

        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {

            $course_title = $row["course_title"];

    }
}

?>

<div class="container p-3 my-3">
<form action="<?php echo $page; ?>" method="post">
<div class="row p-2 bg-dark text-white"><h1><?php echo $course_title. " Topics"; ?></h1></div>     
<div class="row bg-light p-3">
     <?php include 'include/connection.php'; 

   $sql = "SELECT * FROM topics_assigned, courses, topics
                                     WHERE topics_assigned.course_id = courses.course_id
                                     AND topics_assigned.topic_id =topics.topic_id
                                     AND topics_assigned.course_id = $course_id";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                            
                            $topic_id = $row["topic_id"];
                            $topic_title = $row["topic_title"];
                            $link= "details.php?eid=$enroll_id&cid=$course_id&tid=$topic_id";
                            $topic_description = $row["topic_description"];

                            $max = 150; // or 200, or whatever
                            if(strlen($topic_description) > $max) {
                                                  // find the last space < $max:
                            $shorter = substr($topic_description, 0, $max+1);
                            $description = substr($topic_description, 0, strrpos($shorter, ' ')).'...';

                            }elseif (strlen($topic_description) < $max){

                                $description = $topic_description."...";
                            }

                            
                            ?>
                       
                    
                            <div class="col-md-12" style="padding: 0px 200px 0px 200px;">
                                <a href="<?php echo $link ?>" class="text-decoration-none btn btn-block btn-outline-dark my-1">
                                <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 my-auto">
                                        <h5><?php echo $topic_title?></h5>
                                        </div>
                                        <div class="col-md-8 text-left border-left">
                                        <em><?php echo $description ?></em> 
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>

                            <?php
                
                                }
                            } else {
                               echo "No courses Available please return to courses page <a href='courses.php'> Courses Page</a>";
                            }
                                
    
                            ?>
 </div>
 </form>
 </div>

               <!-- details card section starts from here -->

<?php include 'footer.php'; ?>


