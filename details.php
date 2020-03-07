<?php 

session_start();

if(isset($_GET["eid"])){
    $enroll_id = $_GET["eid"];
}else{
    $_SESSION["alerts"] = "Wrong url address, enroll id missing";

    exit();
}


if(isset($_GET["cid"])){
$course_id = $_GET["cid"];

}else {

    $_SESSION["alerts"] = "No courses selected";
    exit();
}


if(isset($_GET["tid"])){
    $topic_id = $_GET["tid"];
}else{
    $_SESSION["alerts"] = "No topics selected, enroll id missing";

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
      <th scope="col">Lesson</th>
      <th scope="col">Lesson Type</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
<tbody>

 <?php

include 'connection.php';

$sql = "SELECT * FROM lessons WHERE lessons.topic_id = $topic_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {
        $lesson_id = $row["lesson_id"];
        $lesson_name = $row["lesson_name"];
        $lesson_type = $row["lesson_type"];
        $lesson_source = $row["lesson_source"];
        $link= "lessons.php?eid=$enroll_id&cid=$course_id&tid=$topic_id&lid=$lesson_id";


?> 
<!---begin $time_spent when Launch button is clicked----->
      <!---default $completion = incomplete ---->
      <!----if $time_spent = 2000s then $completion = complete, echo complete button ---->
      <!---the completion shows complete after the button completed is clicked in the lesson, if complete button is activated after crtain time..complete is linked to another table---->

    <tr> 
      <td><?php echo $lesson_name; ?></td>
      <td><?php echo $lesson_type; ?></td>
      <td><a class="btn btn-success" href="<?php echo "$link";?>">Launch</a></td>   
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
      <th scope="col">Quiz Title</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

<?php

    include 'connection.php';


    $sql = "SELECT * FROM quizzes, topics WHERE topics.topic_id = $topic_id";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row

            while($row = mysqli_fetch_assoc($result)) {
            $quiz_id = $row["quiz_id"];
            $quiz_title = $row["quiz_title"];
            $link= "start_quiz.php?eid=$enroll_id&cid=$course_id&tid=$topic_id&qid=$quiz_id";

    ?> 

   
    <tr>
      <td><?php echo $quiz_title; ?></td>
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