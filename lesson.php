<?php

session_start();

if(isset($_GET["lid"])){

	$lesson_id = $_GET["lid"];

}else{

  header("Location: index.php");
die();

}



if(isset($_GET["tid"])){

	$topic_id = $_GET["tid"];

}else{

  header("Location: index.php");

die();

}
?>

<?php include"header.php"; ?>


<div class="container">

	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="text-center">ID</th>
				<th class="text-center">File</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php

		include 'include/connection.php';

		$sql = "SELECT * FROM lessons, topics WHERE topics.topic_id = lessons.topic_id AND lessons.lesson_id = '$lesson_id' AND lessons.topic_id= '$topic_id'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {

    	// output data of each row
    	while($row = mysqli_fetch_assoc($result)) {
    	 
    	 $lesson_name = $row["lesson_name"];
         $lesson_source = $row["lesson_source"];
         $lesson_type = $row["lesson_type"];

        ?>

		<tr>
			<td class="text-center"><?php echo $lesson_id ?></td>
			<td><?php echo $lesson_name ?></td>
			<td class="text-center"><a href="download.php?lid=<?php echo $lesson_id ?>" class="btn btn-primary">Download</a></td>
		</tr>

		<?php

		}

		} else {
		    echo "0 results";
		}

		?>
		</tbody>
	</table>
	
</div>


<?php include"footer.php"; ?>