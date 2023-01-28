
<?php 

if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION["user_id"])){

if ($_SESSION["user_type"] == "Admin") {
  
    $user_id = $_SESSION["user_id"];

}else{

  header("location: ../index.php");
  
  exit();
}

}else{

  header("location: ../index.php?login=info");
}

include 'alerts.php';

?>

<div class="container bg-light mt-2 p-3 rounded-lg">

<div class="container"> 

<input class="form-control border-0" type="text" id="formInput1" placeholder="Search for quiz..."> 
<div class="table-responsive bg-shadow mb-5">
 <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th>ID</th>
        <th>Topic</th>
        <th>quiz</th>
        <th>Question(s)#</th>
        <th>Attempt(s)#</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>

<?php 

include 'connection.php';

//code to show recent courses added

        $sqlquiz = "SELECT * FROM quizzes, topics WHERE quizzes.topic_id = topics.topic_id ORDER BY quizzes.quiz_id ASC";

        $resultquiz = mysqli_query($conn, $sqlquiz);
        
        if (mysqli_num_rows($resultquiz) > 0) {
            // output data of each row
            while($rows = mysqli_fetch_assoc($resultquiz)) {
                $quizid = $rows["quiz_id"];
                $topicid = $rows["topic_id"];

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


          $delquiz = "dashboard_edit.php?id=$topicid&lid=$quizid";

           $editquiz = "dashboard_quiz.php?lid=$quizid";
          ?>

  <tbody id="tableInput1">
      <tr>
        <td class="small"><?php echo $rows["quiz_id"]; ?></td>
        <td class="w-25 small"><?php echo $rows["topic_title"]; ?></td>
        <td class="w-25 small"><?php echo $rows["quiz_title"]; ?></td>
        <td class="w-25 small"><?php echo $rows["total_questions"]; ?></td>
        <td class="w-25 small"><?php echo $rows["total_attempts"]; ?></td>
        <td>
      <a href="<?php echo $editquiz; ?>"><button type="button" class="btn btn-info btn-sm btn-block mb-2"><i class="fas fa-edit"></i></button></a>

      <a href="<?php echo $delquiz; ?>"><button type="button" class="btn btn-danger btn-sm btn-block"><i class="fas fa-trash"></i></button></a>

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
  $("#formInput1").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tableInput1 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>