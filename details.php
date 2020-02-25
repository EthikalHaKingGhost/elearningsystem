<?php 
if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_GET["eid"])){
    $enroll_id = $_GET["eid"];
}else{
    echo "No enroll id in the url";

    exit();
}


if(isset($_GET["cid"])){
$course_id = $_GET["cid"];

}else {

    echo "No courses Id in the url";
    exit();
}



if(isset($_GET["tid"])){
    $topic_id = $_GET["tid"];
}else{
    echo "No topic id in the url";

    exit();
}

include 'header.php'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap 4 Accordion</title>
<style>
    .bs-example{
        margin: 20px;
    }
</style>





</head>
<body>

<div class="container">
<br>
<br>
<br>
<div class="card">
<div class="card-body">
<h1>Deatails</h1>
<p>
Addition (usually signified by the plus symbol "+") is one of the four basic operations of arithmetic; the others are subtraction, multiplication and division. The addition of two whole numbers is the total amount of those values combined. For example, in the adjacent picture, there is a combination of three apples and two apples together, making a total of five apples. This observation is equivalent to the mathematical expression "3 + 2 = 5" i.e., "3 add 2 is equal to 5".
</p>


<?php

include 'connection.php';

$sql = "SELECT * FROM quizzes";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    
        $quiz_id = $row["quiz_id"];
        $quiz_title = $row["quiz_title"];
        $quiz_description = $row["quiz_description"];
        $link= "start_quiz.php?eid=$enroll_id&cid=$course_id&tid=$topic_id&qid=$quiz_id";

    ?>


<div class="bs-example">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><?php echo $quiz_title ?></button>                                    
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <p><?php echo $quiz_description ?><a href="<?php echo "start_quiz.php?eid=$enroll_id&cid=$course_id&tid=$topic_id&qid=$quiz_id";?>" target="_blank">Learn more.</a></p>
              </div>
            </div>
          </div>
        </div>
    </div>
 </div>
</div>
</div>
                                                      
    <?php

    }
} else {
    echo "Not in database";
}

?>
<br>                                   

<?php include 'footer.php'; ?>