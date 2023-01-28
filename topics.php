
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

$page_title = "Topics";

include 'header.php'; ?>

<div class="banner" style="background-image: url(images/1.jpg);">
    
</div>
<?php

include 'include/connection.php';

 $sqlcourse = "SELECT * FROM courses WHERE course_id = '$course_id'";

        $results = mysqli_query($conn, $sqlcourse);

        $row = mysqli_fetch_assoc($results);

            $coursetitle = $row["course_title"];

?>

<div class="container-fluid my-3">
<form action="<?php echo $page; ?>" method="post">
<div class="display-4 text-center pb-3"><?php echo "[" .$coursetitle. "] Topics"; ?></div>    
<div class="container p-5">

<table class="table table-bordered font-italic">
<thead>
    <tr>
        <th class="w-25">Topic</th>
        <th class="w-50">Description</th>
        <th class="w-25 text-center">Action</th>
    </tr>
</thead>
<tbody>
     <?php include 'include/connection.php'; 

   $sql = "SELECT * FROM enrollment, topics_assigned, courses, topics
                                     WHERE topics_assigned.course_id = courses.course_id
                                     AND topics_assigned.topic_id =topics.topic_id
                                     AND enrollment.course_id = courses.course_id
                                     AND topics_assigned.course_id = $course_id
                                     AND enrollment.user_id = $user_id";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                            
                            $topic_id = $row["topic_id"];
                            $topic_title = $row["topic_title"];
                            $link = "details.php?eid=$enroll_id&cid=$course_id&tid=$topic_id";
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
                       
                    
                           <tr>
                               <td class="font-weight-bold h5"><?php echo $topic_title ?></td>
                               <td><?php echo $description ?></td>
                               <td class="text-center">
                                <a href="<?php echo  $link ?>"><button type="button" class="btn btn-success">
                                   View
                                </button></a>
                               </td>
                           </tr>

                            <?php
                
                                }
                            } else {

                               echo "<h4> No courses Available please return to courses page  <a href='courses.php'>  Courses Page </a></h4>";
                            }
                            
                            ?>
</tbody>
</table>
 </div>
 </form>
 </div>

               <!-- details card section starts from here -->

<?php include 'footer.php'; ?>


