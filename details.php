<?php 

session_start();

if(isset($_SESSION["user_id"])){

    $userid = $_SESSION["user_id"];
}else{


    exit();
}


if(isset($_GET["eid"])){
    $enroll_id = $_GET["eid"];
}else{

    echo "<h1>OOPS!</h1><hr>";
    $_SESSION["alerts_info"] = "Wrong url address, enroll id missing";

    exit();
}


if(isset($_GET["cid"])){
$course_id = $_GET["cid"];

}else {

      echo "<h1>OOPS!</h1><hr>";
    $_SESSION["alerts_info"] = "No courses  were selected, course id missing";
    exit();
}


if(isset($_GET["tid"])){
    $topic_id = $_GET["tid"];
}else{
    echo "<h1>OOPS!</h1><hr>";
    $_SESSION["alerts_info"] = "No topics selected, enroll id missing";

    exit();
}


include 'header.php'; ?>

<link rel="stylesheet" href="plugins/tabs/jquery.atAccordionOrTabs.min.css">
<script src="plugins/tabs/jquery.bbq.min.js" type="text/javascript"></script>
<script src="plugins/tabs/jquery.atAccordionOrTabs.min.js" type="text/javascript"></script>

    <?php

include'include/connection.php';

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

<div class="banner" style="background-image: url(images/2.jpg);">

<h1 class="text-center pt-5 text-light"> <?php echo $topic_title ?> </h1>
<div class="col-md-6 offset-md-3 bg-white bg-shadow">
<p class="text-center text-dark"><?php echo $topic_description ?></p>
</div>
</div>


  <div class="container">

    <ul class="topictabs">

<li><a class="font-weight-bold h2">Lessons</a>
<section>
<div class="font-italic border">

<input class="form-control border-0" id="myInput" type="text" placeholder="Search for lesson..."> 
  
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col-xs" class="text-center">ID</th>
      <th scope="col-xs" class="text-center">Lesson</th>
      <th scope="col-xs" class="text-center">Lesson Type</th>
      <th scope="col-xs" class="text-center">File Size</th>
      <th scope="col-xs" class="text-center">Action</th>
    </tr>
  </thead>
<tbody id="myTable">

 <?php

include 'include/connection.php';

$sql = "SELECT * FROM lessons WHERE lessons.topic_id = $topic_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {
        $lesson_id = $row["lesson_id"];
        $bytes = $row['file_size'];
        $lesson_name = $row["lesson_name"];
        $lesson_type = $row["lesson_type"];
        $lesson_source = $row["lesson_source"];
        $link= "lessons.php?eid=$enroll_id&cid=$course_id&tid=$topic_id&lid=$lesson_id";
        $contenttype = $row["content"];
        $buttonlabel = "";


//change file size name according to size, Snippet from PHP Share: http://www.phpshare.org

        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }


        if ($contenttype == "download"){

             $buttonlabel = "Download";
             $buttontype = "btn btn-primary";

        } elseif ($contenttype == "Webbased") {

          $buttonlabel = "Launch";
          $buttontype = "btn btn-success";

        } elseif ($contenttype == "both") {

          $buttonlabel = "View";
          $buttontype = "btn btn-dark";
        }


?>

<!---begin $time_spent when Launch button is clicked----->
      <!---default $completion = incomplete ---->
      <!----if $time_spent = 2000s then $completion = complete, echo complete button ---->
      <!---the completion shows complete after the button completed is clicked in the lesson, if complete button is activated after crtain time..complete is linked to another table---->

    <tr> 
      <td class="text-center"><?php echo $lesson_id ?></td>
      <td><?php echo $lesson_name; ?></td>
      <td class="text-center"><?php echo $lesson_type; ?></td>
      <td class="text-center"><?php echo $bytes; ?></td>
      <td class="text-center"><a class="<?php echo $buttontype; ?>" href="<?php echo "$link";?>"><?php echo $buttonlabel ?></a></td>   
    </tr>
 
<?php 

   }
 }

?>
</tbody>
</table>  
</div>

  </section>
  </li>
  <li><a class="font-weight-bold h2">Quizzes</a>
  <section>
    
  <div class="font-italic border">
    <input class="form-control border-0" id="myInput2" type="text" placeholder="Search for quiz..."> 
  
  <table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col-xs-1" class="text-center">Quiz#</th>
      <th scope="col-xs-3" class="text-center">Quiz Title</th>
      <th scope="col-xs-3" class="text-center">Questions</th>
      <th scope="col-xs-2" class="text-center">Attempts</th>
      <th scope="col-xs-3" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody id="myTable2">

<?php

    include 'include/connection.php';


    $sql = "SELECT * FROM quizzes, topics WHERE quizzes.topic_id = topics.topic_id AND topics.topic_id = $topic_id";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row

            while($row = mysqli_fetch_assoc($result)) {
            $quiz_id = $row["quiz_id"];
            $quiz_title = $row["quiz_title"];
            $total_questions = $row["total_questions"];
            $link= "start_quiz.php?eid=$enroll_id&cid=$course_id&tid=$topic_id&qid=$quiz_id";

    ?> 

   
    <tr>
      <td class="text-center"><?php echo $quiz_id; ?></td>
      <td class="text-center"><?php echo $quiz_title; ?></td>
      <td class="text-center"><?php echo $total_questions; ?></td>
       <td class="text-center">
        <?php 

             $count = "SELECT * FROM quizzes_attempted WHERE user_id = '$userid' AND quiz_id= '$quiz_id'";

               if ($countqry = mysqli_query($conn, $count))

                {
                    // Return the number of rows in result set
                    $row = mysqli_num_rows($countqry);

                    //$limit = $row['limit'];

                    mysqli_free_result($countqry);

                    $submit = " ";

              }if($row > 0){

                $button = "Try Again";
                $submit = "btn btn-warning";

                echo $row;

              }if($row >= 20 ){
                      
              $link = "details.php?eid=$enroll_id&cid=$course_id&tid=$topic_id&error=limit";
              $submit = "btn btn-outline-light text-dark";
              $button = "Launch";

              }if($row < 1){

                echo "No Attempts";

                $button = "Launch";
                $submit = "btn btn-success";
                
                
                } 
            ?>

           
         </td>

      <td class="text-center"><a class="<?php echo $submit; ?>" href="

        <?php echo "$link"; ?>">

       <?php echo "$button"; ?>

      </a></td>

    </tr>
 

<?php 

   }
 }

?>
</tbody>
</table>  
</div>
   </section>
  </li>
  <li><a class="font-weight-bold h2">Library</a>
<section>
<div class="font-italic border">

<input class="form-control border-0" id="myInput3" type="text" placeholder="Search for Book..."> 
  
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col-xs-2" class="text-center">ID</th>
      <th scope="col-xs-2" class="text-center">Book</th>
      <th scope="col-xs-4" class="text-center">Book Details</th>
      <th scope="col-xs-2" class="text-center">File Size</th>
      <th scope="col-xs-2" class="text-center">Action</th>
    </tr>
  </thead>
<tbody id="myTable3">

 <?php

include 'include/connection.php';

$sql = "SELECT * FROM Library WHERE topic_id = $topic_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {
        $book_id = $row["book_id"];
        $bytes1 = $row['file_size'];
        $book_title = $row["book_title"];
        $book_details = $row["book_details"];
        $book_path = $row["book_path"];
        $link= "";
        $buttonlabel = "";


//change file size name according to size, Snippet from PHP Share: http://www.phpshare.org

        if ($bytes1 >= 1073741824)
        {
            $bytes1 = number_format($bytes1 / 1073741824, 2) . ' GB';
        }
        elseif ($bytes1 >= 1048576)
        {
            $bytes1 = number_format($bytes1 / 1048576, 2) . ' MB';
        }
        elseif ($bytes1 >= 1024)
        {
            $bytes1 = number_format($bytes1 / 1024, 2) . ' KB';
        }
        elseif ($bytes1 > 1)
        {
            $bytes1 = $bytes1 . ' bytes';
        }
        elseif ($bytes1 == 1)
        {
            $bytes1 = $bytes1 . ' byte';
        }
        else
        {
            $bytes1 = '0 bytes';
        }


        if ($contenttype == "download"){

             $buttonlabel = "Download";
             $buttontype = "btn btn-primary";

        } elseif ($contenttype == "Webbased") {

          $buttonlabel = "Launch";
          $buttontype = "btn btn-success";

        } elseif ($contenttype == "both") {

          $buttonlabel = "View";
          $buttontype = "btn btn-dark";
        }


?>

<!---begin $time_spent when Launch button is clicked----->
      <!---default $completion = incomplete ---->
      <!----if $time_spent = 2000s then $completion = complete, echo complete button ---->
      <!---the completion shows complete after the button completed is clicked in the lesson, if complete button is activated after crtain time..complete is linked to another table---->

    <tr> 
      <td class="text-center"><?php echo $book_id ?></td>
      <td><?php echo $book_title; ?></td>
      <td class="text-center"><?php echo $book_details; ?></td>
      <td class="text-center"><?php echo $bytes1; ?></td>
      <td class="text-center"><a class="<?php echo $buttontype; ?>" href="<?php echo "$link";?>"><?php echo $buttonlabel ?></a></td>   
    </tr>
 
<?php 

   }
 }

?>
</tbody>
</table>  
</div>

  </section>
  </li>
  </section>
  </li>
  <li><a class="font-weight-bold h2">Assignments</a>
  <section>
    

  </section>
  </li>
  <li><a class="font-weight-bold h2">Submissions</a>
  <section>
    

  </section>
  </li>
</ul>
</div>


<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(document).ready(function(){
  $("#myInput2").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable2 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(document).ready(function(){
  $("#myInput3").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable3 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>              


<script type="text/javascript">

$('.topictabs').accordionortabs({
  hashbangPrefix: "tab",
  tabsIfPossible: true,
  });
</script>





<?php include 'footer.php'; ?>