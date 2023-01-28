
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

<input class="form-control border-0" type="text" id="formInput" placeholder="Search for Lesson..."> 
<div class="table-responsive bg-shadow mb-5">
 <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th>ID</th>
        <th>Topic</th>
        <th>Lesson</th>
        <th>Type</th>
        <th>Access</th>
        <th>Size</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>

<?php 

include 'connection.php';

//code to show recent courses added

        $sqllessons = "SELECT * FROM lessons, topics WHERE lessons.topic_id = topics.topic_id ORDER BY lessons.lesson_id ASC";

        $resultlessons = mysqli_query($conn, $sqllessons);
        
        if (mysqli_num_rows($resultlessons) > 0) {
            // output data of each row
            while($rows = mysqli_fetch_assoc($resultlessons)) {
                $lessonid = $rows["lesson_id"];
                $topicid = $rows["topic_id"];
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


          $dellesson = "dashboard_edit.php?id=$topicid&lid=$lessonid";

           $editlesson = "dashboard_lesson.php?lid=$lessonid";

           $download = "download.php?lid=$lessonid";
          ?>

  <tbody id="tableInput">
      <tr>
        <td class="small"><?php echo $rows["lesson_id"]; ?></td>
        <td class="w-25 small"><?php echo $rows["topic_title"]; ?></td>
        <td class="w-25 small"><?php echo $rows["lesson_name"]; ?></td>
        <td class="small"><?php echo $rows["lesson_type"]; ?></td>
        <td class="small"><?php echo $rows["content"]; ?></td>
        <td class="small"><?php echo $bytes; ?></td>
        <td>

      <a href="<?php echo $download; ?>" class="btn btn-warning btn-sm"><i class="fas fa-download"></i></a>
      
      <a href="<?php echo $editlesson; ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
  
      <a href="<?php echo $dellesson; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

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
  $("#formInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tableInput tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>