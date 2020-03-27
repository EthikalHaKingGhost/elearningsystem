
<?php 
session_start();

if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
}else{
    echo "please login";
    exit();

}

if(isset($_GET["cid"])){
$course_id = $_GET["cid"];

}else {

    echo "No info in the url";
    exit();
}



if(isset($_GET["eid"])){
    $enroll_id = $_GET["eid"];
}else{
    echo "No enroll id in the url";

    exit();
}

 

include 'header.php'; ?>


<style>

/* card details start  */
@import url('https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto+Condensed:400,400i,700,700i');
section{
    padding: 100px 0;
}
.link {
color: black;
font-size: 12px;
}
.link:hover {
    color: orange;
}

.card-content {
	background: #ffffff;
	border: 4px;
	box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
}

.card-desc {
	padding: 1.25rem;
}

.card-desc h3 {
	color: #000000;
    font-weight: 600;
    font-size: 1.5em;
    line-height: 1.3em;
    margin-top: 0;
    margin-bottom: 5px;
    padding: 0;
}

.card-desc p {
	color: #747373;
    font-size: 14px;
	font-weight: 400;
	font-size: 1em;
	line-height: 1.5;
	margin: 0px;
	margin-bottom: 20px;
	padding: 0;
	font-family: 'Raleway', sans-serif;
}
.btn-card{
	background-color: #1ABC9C;
	color: #fff;
	box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    padding: .84rem 2.14rem;
    font-size: .81rem;
    -webkit-transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    -o-transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    margin: 0;
    border: 0;
    -webkit-border-radius: .125rem;
    border-radius: .125rem;
    cursor: pointer;
    text-transform: uppercase;
    white-space: normal;
    word-wrap: break-word;
    color: #fff;
}
.btn-card:hover {
    background: orange;
}
a.btn-card {
    text-decoration: none;
    color: #fff;
}
/* End card section */

</style>

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


