<?php

if(session_status() === PHP_SESSION_NONE) session_start();


if(isset($_SESSION["user_id"])){

    $user_id = $_SESSION["user_id"];

}else{

  header("location: index.php?info=login");
  
  exit();
}

?>


<div class="container bg-light mt-2 p-3 rounded-lg">

<div class="container"> 
<h3>Delete Topic</h3>
<div class="table-responsive bg-shadow mb-5">
 <table class="table table-bordered small" id="mytable">
    <thead class="thead-light">
      <tr>
      	<th>ID</th>
        <th>Topic</th>
        <th>Description</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>

<?php 

include 'connection.php';

//code to show recent courses added

        $sqltopics = "SELECT * FROM topics ORDER BY topics.topic_id ASC";

        $resulttopics = mysqli_query($conn, $sqltopics);
        
        if (mysqli_num_rows($resulttopics) > 0) {
            // output data of each row
            while($rows = mysqli_fetch_assoc($resulttopics)) {
                      $topic_id = $rows["topic_id"];

          $deltopic = "dashboard_edit.php?tid=$topic_id";

           $edittopic = "dashboard_topic.php?tid=$topic_id";
          ?>

	<tbody>
      <tr>
      	<td><?php echo $rows["topic_id"]; ?></td>
        <td><?php echo $rows["topic_title"]; ?></td>
		    <td><?php echo $rows["topic_description"]; ?></td>
		    <td class="text-center">
      <a href="<?php echo $edittopic; ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button></a>

			<a href="<?php echo $deltopic; ?>" class="btn btn-danger btn-sm submit"><i class="fas fa-trash"></i></a>

		</td>
      </tr>
    </tbody>

          <?php

           }
       }

           ?> 
		     
		  </table>
</div>

<h3>Remove Topic from Course</h3>
<div class="table-responsive bg-shadow">
  <table class="table table-bordered small" id="mytable">
    <thead class="thead-light">
      <tr>
      	<th>ID</th>
        <th>Course</th>
        <th>Topic</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>

<?php 

include 'connection.php';

//code to show recent courses added

        $sqltopics = "SELECT * FROM topics, topics_assigned, courses WHERE courses.course_id = topics_assigned.course_id AND topics.topic_id = topics_assigned.topic_id ORDER BY topics_assigned.ta_id ASC";
        $resulttopics = mysqli_query($conn, $sqltopics);
        
        if (mysqli_num_rows($resulttopics) > 0) {
        	
            // output data of each row
            while($row = mysqli_fetch_assoc($resulttopics)) {
            	$ta_id = $row["ta_id"];
          $remtopic = "dashboard-edit.php?taid=$ta_id#!tab0=4";
          ?>

	<tbody>
      <tr>
      	<td><?php echo $row["ta_id"]; ?></td>
        <td><?php echo $row["course_title"]; ?></td>
        <td><?php echo $row["topic_title"]; ?></td>
		<td class=" w-25 text-center">
			<a href="<?php echo $remtopic; ?>" class="btn btn-primary btn-sm">Remove</a>
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





