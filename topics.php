
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



<?php include 'include/connection.php'; ?>

<!-- details card section starts from here -->
            <section class="details-card">
                <div class="container">
                    <div class="row">

                    <?php
                     
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
                            $topic_description = $row["topic_description"];
                            $link= "details.php?eid=$enroll_id&cid=$course_id&tid=$topic_id";

                             ?>
                    
                            <div class="col-md-4">
                                <div class="card-content">
                                
                                    <div class="card-desc">
                                        <h3><?php echo $topic_title?></h3>
                                        <p><?php echo $topic_description ?></p>
                                            <a href="<?php echo $link ?>" class="btn-card">Read</a>   
                                    </div>
                                </div>
                            </div>


                            <?php
                
                                }
                            } else {
                               echo "No courses Available please return to courses page <a href='courses.php'> Courses Page</a>";
                            }
                                
                            ?>

                        </div>
                    </div>
                </section>
                <!-- details card section starts from here -->

<?php include 'footer.php'; ?>


