

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
        <th>Student</th>
        <th>Course</th>
        <th>Topic</th>
        <th class="text-center"></th>
      </tr>
    </thead>

<?php 

include 'connection.php';

//code to show recent courses added


        $studentsql = "SELECT * FROM `users`, `courses`, `topics`, `enrollment`, topics_assigned WHERE enrollment.course_id = courses.course_id AND topics.topic_id = topics_assigned.topic_id AND courses.course_id = topics_assigned.course_id AND users.user_id = enrollment.user_id";

        $query = mysqli_query($conn, $studentsql);
        
        if (mysqli_num_rows($query) > 0) {
            // output data of each row
            while($rows = mysqli_fetch_assoc($query)) {
                $courseid = $rows["course_id"];


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
        <td><?php echo $rows["uid_username"]; ?></td>
        <td><?php echo $rows["course_title"]; ?></td>
        <td><?php echo $rows["topic_title"]; ?></td>
        <td>

      <a href="<?php echo $feedback; ?>" title="edit user report" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i></a>

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


