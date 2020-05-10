<link rel="stylesheet" href="Trumbowyg-master/dist/ui/trumbowyg.min.css">

<?php

session_start();

if (isset($_SESSION["user_id"]))
{

    $userid = $_SESSION["user_id"];
    $user = $_SESSION["username"];

}
else
{

    header('location: register.php?info=login');

    exit();
}

if (isset($_GET["eid"]))
{
    $enroll_id = $_GET["eid"];
}
else
{

    $_SESSION["alerts_info"] = "Wrong url address, enroll id missing";

    exit();
}

if (isset($_GET["cid"]))
{
    $course_id = $_GET["cid"];

}
else
{

    $_SESSION["alerts_info"] = "No courses  were selected, course id missing";

    exit();
}

if (isset($_GET["tid"]))

{
    $topic_id = $_GET["tid"];
}

else

{

    $_SESSION["alerts_info"] = "No topics selected, enroll id missing";

    exit();
}

include 'include/connection.php';

$sql = "SELECT * FROM topics WHERE topics.topic_id=$topic_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{

    // output data of each row
    while ($row = mysqli_fetch_assoc($result))
    {

        $topic_title = $row["topic_title"];

        $topic_description = $row["topic_description"];

    }
}

include 'header.php'; ?>


<div class="banner" style="background-image: url(images/2.jpg);">

<h1 class="text-center pt-5 text-light"> <?php echo $topic_title ?> </h1>
<div class="col-md-6 offset-md-3 bg-white bg-shadow">
<p class="text-center text-dark"><?php echo $topic_description ?></p>
</div>
</div>


<div class="container-fluid py-5">

<style type="text/css">
  .nav-pills-custom .nav-link {
    color: #aaa;
    background: #fff;
    position: relative;
}

.nav-pills-custom .nav-link.active {
    color: #45b649;
    background: #fff;
}


/* Add indicator arrow for the active tab */
@media (min-width: 992px) {
    .nav-pills-custom .nav-link::before {
        content: '';
        display: block;
        border-top: 8px solid transparent;
        border-left: 10px solid #fff;
        border-bottom: 8px solid transparent;
        position: absolute;
        top: 50%;
        right: -10px;
        transform: translateY(-50%);
        opacity: 0;
    }
}

.nav-pills-custom .nav-link.active::before {
    opacity: 1;
}

</style>

<!--https://bootstrapious.com/p/bootstrap-vertical-tabs--->

<section class="py-5 header">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link mb-3 p-3 shadow active" id="v-pills-lesson-tab" data-toggle="pill" href="#v-pills-lesson" role="tab" aria-controls="v-pills-lesson" aria-selected="true">
                        <i class="fas fa-file-video mr-2"></i>
                        <span class="font-weight-bold small text-uppercase" onclick="">Lessons</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-library-tab" data-toggle="pill" href="#v-pills-library" role="tab" aria-controls="v-pills-library" aria-selected="false">
                        <i class="fas fa-book mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Library</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-quizzes-tab" data-toggle="pill" href="#v-pills-quizzes" role="tab" aria-controls="v-pills-quizzes" aria-selected="false">
                        <i class="fas fa-question-circle mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Quizzes</span></a>


             <?php include 'include/connection.php';

$sql = "SELECT * FROM assignments WHERE topic_id = '$topic_id'";
$queryresult = mysqli_query($conn, $sql);

if (mysqli_num_rows($queryresult) > 0)
{

?>
                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-assignments-tab" data-toggle="pill" href="#v-pills-assignments" role="tab" aria-controls="v-pills-assignments" aria-selected="false">
                        <i class="fas fa-pencil-ruler mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Assignments</span></a>

              <?php
}
?>
                    </div>
            </div>


            <div class="col-md-9">
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
                    
<div class="tab-pane fade shadow rounded bg-white show active p-2" id="v-pills-lesson" role="tabpanel" aria-labelledby="v-pills-lesson-tab">
      <h4 class="font-italic mb-4 text-center">Lessons and Tutorials</h4>
          <div class="font-italic border">

<input class="form-control border-0" type="text" id="myInput" placeholder="Search for lesson..."> 
  <div class="table-responsive">
<table class="table">
  <thead class="thead-light">
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">Lesson</th>
      <th class="text-center">Lesson Type</th>
      <th class="text-center">File Size</th>
      <th class="text-center">Action</th>
    </tr>
  </thead>
<tbody id="myTable">

 <?php
include 'include/connection.php';

$sql = "SELECT * FROM lessons WHERE lessons.topic_id = $topic_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
    // output data of each row
    while ($row = mysqli_fetch_assoc($result))
    {
        $lesson_id = $row["lesson_id"];
        $bytes = $row['file_size'];
        $lesson_name = $row["lesson_name"];
        $lesson_type = $row["lesson_type"];
        $lesson_source = $row["lesson_source"];
        $link = "lessons.php?eid=$enroll_id&cid=$course_id&tid=$topic_id&lid=$lesson_id";
        $content = $row["content"];
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

        if ($content == "download")
        {

            $download = '<a href="' . $link . '"><img src="images/download.png" height="30" width="90"></a>';

        }
        elseif ($content == "webbased")
        {

            $download = '<a class="btn btn-success" href="' . $link . '">Launch</a>';

        }
        elseif ($content == "both")
        {

            $download = '<a class="btn btn-success" href="' . $link . '">Launch</a>';

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
      <td class="text-center"><?php echo $download; ?></td>   
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
                    
<div class="tab-pane fade shadow rounded bg-white p-2" id="v-pills-library" role="tabpanel" aria-labelledby="v-pills-library-tab">
    <h4 class="font-italic mb-4 text-center">Reading Material</h4>
      <div class="font-italic border">


<input class="form-control border-0" type="text" id="myInput2" placeholder="Search for Book..."> 
<div class="table-responsive">
<table class="table">
  <thead class="thead-light">
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">Book</th>
      <th class="text-center">Book Details</th>
      <th class="text-center">File Size</th>
      <th class="text-center">Action</th>
    </tr>
  </thead>
<tbody id="myTable2">

   <?php
include 'include/connection.php';

$sql = "SELECT * FROM library, books_assign WHERE library.book_id = books_assign.book_id AND books_assign.topic_id = '$topic_id'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
    // output data of each row
    while ($row = mysqli_fetch_assoc($result))
    {
        $book_id = $row["book_id"];
        $bytes1 = $row['file_size'];
        $book_title = $row["book_title"];
        $book_details = $row["book_details"];
        $book_path = $row["book_path"];
        $author = $row["author"];
        $year_publish = $row["year_publish"];
        $access = $row["access"];
        $link = "";
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

        if ($contenttype = "download")
        {

            $download = '<a href="' . $link . '">
                              <img src="images/download.png" height="30" width="90">
                          </a>';

        }

        if ($contenttype = "webbased")
        {

            $download = '<a class="btn btn-success" href="' . $link . '">Launch</a>';

        }

        if ($contenttype = "both")
        {

            $download = '<a class="btn btn-dark" href="' . $link . '">View</a>';

        }

?>




<!---begin $time_spent when Launch button is clicked----->
      <!---default $completion = incomplete ---->
      <!----if $time_spent = 2000s then $completion = complete, echo complete button ---->
      <!---the completion shows complete after the button completed is clicked in the lesson, if complete button is activated after crtain time..complete is linked to another table---->

    <tr> 
      <td class="text-center "><?php echo $book_id ?></td>
      <td class="w-25"><?php echo $book_title; ?></td>
      <td class="w-50"><?php echo $book_details . " (" . $author . ", " . $year_publish . ")" ?></td>
      <td class="text-center w-25"><?php echo $bytes1; ?></td>
      <td class="text-center"><?php echo $download; ?></td>   
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
                    
<div class="tab-pane fade shadow rounded bg-white p-2" id="v-pills-quizzes" role="tabpanel" aria-labelledby="v-pills-quizzes-tab">
 <h4 class="font-italic mb-4 text-center">Take a quiz</h4>

<div class="font-italic border">
    <input class="form-control border-0" type="text" id="myInput3" placeholder="Search for quiz..."> 
  <div class="table-responsive">
  <table class="table">
  <thead class="thead-light">
    <tr>
      <th class="text-center">Quiz#</th>
      <th class="text-center w-25">Quiz Title</th>
      <th class="text-center w-50">Questions</th>
      <th class="text-center">Attempts</th>
      <th class="text-center w-25">Action</th>
    </tr>
  </thead>
  <tbody id="myTable3">

<?php
include 'include/connection.php';

$sql = "SELECT * FROM quizzes, topics WHERE quizzes.topic_id = topics.topic_id AND topics.topic_id = $topic_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{

    // output data of each row
    while ($row = mysqli_fetch_assoc($result))
    {
        $quiz_id = $row["quiz_id"];
        $limit = $row["total_attempts"];
        $quiz_title = $row["quiz_title"];
        $total_questions = $row["total_questions"];
        $link = "start_quiz.php?eid=$enroll_id&cid=$course_id&tid=$topic_id&qid=$quiz_id";
        $button = "";

if ($total_questions > 0) {

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
            $capture = mysqli_num_rows($countqry);

            mysqli_free_result($countqry);

            if ($limit == 0)
            {

                $button = "Launch";
                $submit = "btn btn-success";

                echo "unlimited";

            }

            if ($capture < $limit)
            {

                $button = "Retry";
                $submit = "btn btn-info";

                echo $capture . "/" . $limit;

            }

            elseif ($capture = $limit)
            {

          if (isset($_POST["submitbtn"])){
              
              $_SESSION["alerts-danger"] = "You have reached the maximum number of attempts";            }

                $submit = "btn btn-outline-danger text-dark";

                $button = "N/A";

                echo $limit . "/" . $limit;

            }

        }

?>

         </td>

      <td class="text-center"><input class="<?php echo $submit; ?>" type="submit" name="submitbtn" value="<?php echo "$button"; ?>">

      </td>

    </tr>

<?php

    }
}

}

?>
</tbody>
</table>  
</div>
</div>
 </div>               

<style type="text/css">
  .nav-tabs .nav-link.active {
    font-weight:bold;
    background-color: transparent;
    border-bottom:3px solid #dd0000;
    border-right: none;
    border-left: none;
    border-top: none;
}

</style>

<div class="tab-pane fade shadow rounded bg-white p-2" id="v-pills-assignments" role="tabpanel" aria-labelledby="v-pills-assignments-tab">
      <section class=" ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center ">
                <nav class="nav-justified ">
                  <div class="nav nav-tabs " id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true">Assignments</a>
                    <a class="nav-item nav-link" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false">Submit Assignment</a>
                    <a class="nav-item nav-link" id="pop3-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3" aria-selected="false">Submissions</a>
                    
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                        <div class="pt-3"></div>
                        <p>
                       
<div class="font-italic border">

<input class="form-control border-0" id="myInput4" type="text" placeholder="Search for assignment..."> 

<div class="table-responsive">
<table class="table">
  <thead class="thead-light">
    <tr>
      <th class="text-center w-25">Assignment</th>
      <th class="text-center w-50">Description</th>
      <th class="text-center w-25">File Size</th>
      <th class="text-center">Action</th>
    </tr>
  </thead>
<tbody id="myTable4">

<?php
include 'include/connection.php';

$sql = "SELECT * FROM assignments WHERE topic_id = $topic_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
    // output data of each row
    while ($row = mysqli_fetch_assoc($result))
    {
        $assignment_id = $row["assignment_id"];
        $bytes1 = $row['file_size'];
        $assignment_title = $row["assignment_title"];
        $assignment_details = $row["assignment_details"];
        $assignment_path = $row["assignment_path"];
        $link = "";
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

?>

    <tr> 
      <td class="text-center"><?php echo $assignment_title . "[" . $assignment_id . "]"; ?></td>
      <td class="w-50"><?php echo $assignment_details; ?>  blah blah blah blah blah blah blah blah blah blah blah blah</td>
      <td class="w-25 text-center px-5"><?php echo $bytes1; ?></td>
      <td class="text-center"><a href="<?php echo "$link"; ?>" class="text-decoration-none">
    <img src="images/download.png" height="50" width="120"> 
   </a></td>   
    </tr>
    <?php
    }

?>
  </tbody>
</table>  
</div>
</div>
<?php

}
if (mysqli_num_rows($result) == 0)
{

?>

  <div class="h1 text-center">NO ASSIGNMENTS</div>

  <?php
}

?>


                        </p>
                      </div>
                  <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                       <div class="pt-3"></div>
                        <p>

                              
                         <?php

if (isset($_POST["submission"]))
{
    include 'include/connection.php';

    $filesubmit_id = $_POST["filesubmit_id"];
    $uploadOk = 1;
    $comment = $_POST["trumbowyg"];


    if ($_FILES['fileToUpload']['error'] == 0)
    {

        include 'upload.php';

    }
    else
    {

        $_SESSION["alert-danger"] = "error uploading file or no file selected";

    }

    if ($uploadOk == 1){

    $stmt = "SELECT * FROM submission WHERE assignment_id = '$filesubmit_id'";

          $query = mysqli_query($conn, $stmt);

          if (mysqli_num_rows($query) > 0) {

            $sql = "UPDATE `submission` SET `user_id` = '$userid', `topic_id` = '$topic_id', `comments` = '$comment', `sub_file` = '$sub_path', `sub_date` = current_timestamp() WHERE `assignment_id` = '$filesubmit_id'";

            $result = mysqli_query($conn, $sql);

          $_SESSION["alert-success"] = "Assignment updated successfully.";

        }else{


            $sql = "INSERT INTO `submission` (`sub_id`, `user_id`, `topic_id`, `assignment_id`, `sub_file`, `comments`, `sub_date`) VALUES (NULL, '$userid', '$topic_id', '$filesubmit_id', '$sub_path', '$comment', current_timestamp())";

            $result = mysqli_query($conn, $sql);

          $_SESSION["alert-success"] = "Assignment submitted successfully ontime.";

        }

      }

  }

?>

  <div class="font-italic text-muted">
        <form method="post" action="details.php?eid=<?php echo $enroll_id; ?>&cid=<?php echo $course_id; ?>&tid=<?php echo $topic_id ?>#!tab0=5" enctype="multipart/form-data">

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong for="filesubmit_id">Select Assignment:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
              <select class="form-control form-control-sm" id="assignment" name="filesubmit_id" title="Select an assignment"  data-toggle="dropdown" required>  
<?php

include 'include/connection.php';

$sql = "SELECT * FROM assignments WHERE topic_id = $topic_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
    // output data of each row
    while ($row = mysqli_fetch_assoc($result))
    {

        $id = $row['assignment_id'];
        $assign_title = $row['assignment_title'];

            ?>

               <option value="<?php echo $id; ?>"><?php echo $assign_title; ?></option>

            <?php
    }

}
else
{
?>
                <option disabled>No assignments</option>

              <?php
}

?>
              </select> 
            </div>
        </div>
    </div>
 

  <div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Upload Files:</strong>
        </div>
        <div class="col-md-9 mb-4 text-center">
            <div class="form-group files color">
              <input type="file" name="fileToUpload" id="uploadinput">
            </div>
        </div>
</div>
             

  <div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Comments:</strong>
        </div>
        <div class="col-md-9 mb-4">
          <div id="trumbowyg" name="trumbowyg" class="trumbowyg bg-white" required></div>   
        </div>
</div>

      <div cass="text-center">
        <div class="col-md-6 offset-md-3">
              <input type="submit" name="submission" id="check" class="btn btn-warning" value="Submit Assignment">
              </div>
      </div>


</form> 
</div>
             </p>         
                  </div>
                  <div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
                       <div class="pt-3"></div>
                        <p>

    <div id="accordion">
  <div class="card">
      <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link btn-sm" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Submissions
        </button>
      </h5>
    </div>
    
 <?php

$score="";

$sqlstmt = "SELECT * FROM assignments, submission WHERE assignments.assignment_id = submission.assignment_id AND submission.topic_id = '$topic_id' AND submission.user_id = '$userid'";

$resultqry = mysqli_query($conn, $sqlstmt);

if (mysqli_num_rows($resultqry) > 0)
{
    // output data of each row
    while ($res = mysqli_fetch_assoc($resultqry))
    {

        $assignment = $res["assignment_title"];
        $submit_date = $res["sub_date"];
        $details = $res["assignment_details"];
        $comments = $res["comments"];
        $total = $res["score"];
        $mark = $res["mark"];

    if (!empty($total)) {
        $score = ($mark / $total * 100);
      }else{
        $total = "empty";
      }
        $date = new \DateTime($submit_date,  new \DateTimeZone('America/La_Paz'));
        $subdate = $date->format('D M d, Y G:i A');

      ?>

    <div id="collapseOne" class="collapse show border border-bottom" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body m-0 p-1">
       <div class="row p-0">
         <div class="col-md-3">
          <div class="h6"><?php echo $assignment ?></div>
         </div>
         <div class="col-md-2 h6">Submited
           <div class="figure-caption">
            <?php echo $subdate ?>
            </div>
         </div>
         <div class="col-md-1 h6">Total
           <div class="figure-caption"><?php 

           if ($total !== "empty"){

            echo $score."%";

          }else{

            echo" current score ".$mark;
          }
            
            ?></div>        
         </div>
         <div class="col-md-6 h6">Comment
         <div class="figure-caption text-center"><?php echo $comments ?></div> 
         </div>
       </div>
      </div>
    </div>

      <?php

    }

}

?>
</div>
  </div>
                </p>
                      
                  </div>
                  
                </div>
            </div>
        </div>
    </div>
  </div>

</section>
</div>
</div>
</div>
</div>
</div>


<?php include 'footer.php'; ?>

<script src="Trumbowyg-master/dist/trumbowyg.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/specialchars/trumbowyg.specialchars.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/table/trumbowyg.table.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/upload/trumbowyg.cleanpaste.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/upload/trumbowyg.pasteimage.min.js"></script>

<script type="text/javascript">

    $('#trumbowyg').trumbowyg({
    btns: [
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em'],
        ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['fullscreen']
    ],
 
    autogrow: true

});



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

$(document).ready(function(){
  $("#myInput4").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable4 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>
