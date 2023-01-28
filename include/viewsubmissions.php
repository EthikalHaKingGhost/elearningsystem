

<?php 

if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION["user_id"])){

if ($_SESSION["user_type"] == "Admin") {
  
    $user_id = $_SESSION["user_id"];

}else{

  header("location: ../index.php");
  
  exit();
}

}

include 'alerts.php';

?>

<div class="container bg-light mt-2 p-3 rounded-lg">

<div class="container"> 

<input class="form-control border-0" type="text" id="formInput3" placeholder="Search for assignment..."> 
<div class="table-responsive bg-shadow mb-5">
 <table class="table table-bordered small">
    <thead class="thead-light">
      <tr>
        <th>UID</th>
        <th>Course</th>
        <th>Topic</th>
        <th>Assignment</th>
        <th>Size</th>
        <th>Submitted</th>
        <th>Grade</th>
        <th>Score</th>
        <th class="text-center"></th>
      </tr>
    </thead>

<?php 

include 'connection.php';

//code to show recent courses added


        $booksql = "SELECT * FROM `submission`,`assignments`, `courses`, `topics`, `topics_assigned` WHERE submission.assignment_id = assignments.assignment_id AND assignments.course_id = courses.course_id AND topics.topic_id = topics_assigned.topic_id AND courses.course_id = topics_assigned.course_id";

        $bookresults = mysqli_query($conn, $booksql);
        
        if (mysqli_num_rows($bookresults) > 0) {
            // output data of each row
            while($rows = mysqli_fetch_assoc($bookresults)) {
                $courseid = $rows["course_id"];
                 $bytes = $rows['file_size'];


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


          $delbook = "dashboard_edit.php?cid=$course_id";

          $download = "download.php?cid=$course_id";

          ?>

  <tbody id="tableInput3">
      <tr>
        <td><?php echo $rows["user_id"]; ?></td>
        <td><?php echo $rows["course_title"]; ?></td>
        <td><?php echo $rows["topic_title"]; ?></td>
        <td><?php echo $rows["assignment_title"]; ?></td>
        <td><?php echo $bytes; ?></td>
        <td><?php echo $rows["sub_date"]; ?></td>
        <td><div style="width:45px;"><input class="form-control p-0 m-0 text-center" type="number" name="mark" min="0" max="100" value="<?php echo $rows["mark"]; ?>"></div></td>
        <td><?php echo $rows["score"]; ?></td>

        <td style="width:165px;">

      <a href="<?php echo $feedback; ?>" title="submit Grade" class="btn btn-success btn-sm"><i class="fas fa-paper-plane"></i></a>

      <a href="<?php echo $download; ?>" title="download assignment" class="btn btn-warning btn-sm"><i class="fas fa-download"></i></a>

      <a href="<?php echo $feedback; ?>" title="upload feedback" class="btn btn-secondary btn-sm"><i class="fas fa-upload"></i></a>

      <a href="<?php echo $delbook; ?>" title="delete assignment" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

    </td>
      </tr>
    </tbody>

          <?php

           }
       }

           ?> 
         
      </table>
</div>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
  $("#formInput3").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tableInput3 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>


