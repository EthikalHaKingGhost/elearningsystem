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


a.button {
    -webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;
    color: lightblue;

    text-decoration: none;
    color: initial;
}

</style>

<?php

include'connection.php';

$sql = "SELECT * FROM topics WHERE topics.topic_id=$topic_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      $topic_title = $row["topic_title"];
      $topic_description = $row["topic_description"];

    }
  }

?>
</head>
<body>
<br> 
<div class="container">
<div class="card">
<div class="card-body">
<h1> <?php echo $topic_title ?> </h1>
<p><?php echo $topic_description ?></p>


<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Completion</th>
      <th scope="col">Lesson Title</th>
      <th scope="col">Lesson Type</th>
      <th scope="col"></th>
    </tr>
  </thead>
<tbody>

<?php

include 'connection.php';

$sql = "SELECT * FROM lessons";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {
        $lesson_title = $row["lesson_title"];
        $lesson_type = $row["lesson_type"];
       
       // $link= "start_quiz.php?eid=$enroll_id&cid=$course_id&tid=$topic_id&qid=$quiz_id";


?> 
<!---begin $time_spent when Launch button is clicked----->
      <!---default $completion = incomplete ---->
      <!----if $time_spent = 2000s then $completion = complete, echo complete button ---->
      <!---the completion shows complete after the button completed is clicked in the lesson, if complete button is activated after crtain time..complete is linked to another table---->
    <tr> 
      <th scope="row"> complete </th>
      <td><?php echo $lesson_title; ?></td>
      <td><?php echo $lesson_type; ?></td>
      <td><a class="btn btn-success" href="<?php echo "#";?>">Launch</a></td>   
    </tr>
 

<?php 

   }
 }

?>
</tbody>
</table>  
<br> 




<hr>





<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Score</th>
      <th scope="col">Quiz Title</th>
      <th scope="col">Quiz Type</th>
      <th scope="col"></th>
    </tr>
  </thead>
<tbody>
<?php

include 'connection.php';

$sql = "";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {
        $total_correct = $row["total_correct"];
        $total_questions = $row["total_questions"];

        $quiz_id = $row["quiz_id"];
        $quiz_title = $row["quiz_title"];
        $link= "start_quiz.php?eid=$enroll_id&cid=$course_id&tid=$topic_id&qid=$quiz_id";


?> 
    <tr>

      <th scope="row"><?php echo $total_correct;?>/<?php echo $total_questions;?></th>
      <td><?php echo $quiz_title; ?></td>
      <td>#</td>
      <td><a class="btn btn-success" href="<?php echo "$link";?>">Launch</a></td>   
    </tr>
 

<?php 

   }
 }

?>
</tbody>
</table>  
</div>
</div>
</div>
<br>                                   




<?php include 'footer.php'; ?>