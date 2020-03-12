<?php

session_start();

if(isset($_GET["lid"])){

$lesson_id = $_GET["lid"];

}else{ 
	$_SESSION["alerts"] = "No lesson id in url";
	exit();
}


include 'connection.php';

$sql = "SELECT * FROM lessons WHERE lessons.lesson_id = $lesson_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

    	 $lesson_name = $row["lesson_name"];
         $lesson_source = $row["lesson_source"];
         $lesson_type = $row["lesson_type"];
}



} else {
    echo "0 results";
}


 include 'header.php'; ?>

<style>
 	
.container{
	align-content: center;
	padding:auto;
	margin:none;
}

#mydiv {
  position: absolute;
  z-index: 9;
  background-color: #f1f1f1;
  text-align: center;
  border: 1px solid #d3d3d3;
}

#mydivheader {
  padding: 10px;
  cursor: move;
  z-index: 5;
  background-color: #012;
  color: #fff;
}

.embed-responsive{
	height: 480px;
	width:800px;
}


.ul-lessons {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: auto;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.lessons a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

.lessons a.active {
  background-color: #4CAF50;
  color: white;
}

.lessons a:hover:not(.active) {
  background-color: #555;
  color: white;
}




</style>



<?php

include 'connection.php';

$sql = "SELECT * FROM lessons WHERE lessons.lesson_id = $lesson_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

         $lesson_type = $row["lesson_type"];



// audio lessons page
if ($lesson_type == "Audio") {

		?>

		 <div class="container">
		  <h2 style="text-align: center;">Lessons</h2>
		  <p style="text-align: center;"><?php echo $lesson_name ?></p><hr>
		    <audio controls preload="metadata" style=" width:400px; ">
		 <source <?php echo "$lesson_source" ?>>
		 Your browser does not support the audio element.
		</audio><br />			
		  <div>
		    <?php echo "$lesson_source" ?>
		</div>

		<?php


// video lessons page
}elseif ($lesson_type == "Video"){

		?>
		<div class="container">
		  <h2 style="text-align: center;">Lessons</h2><hr>
		  		<div id="mydiv">
				  <div id="mydivheader"><?php echo $lesson_name ?></div>

		       <?php echo "$lesson_source" ?>
        </div>
		  </div>
		</div>
		<script>

		//Make the DIV element draggagle:
		dragElement(document.getElementById("mydiv"));

		function dragElement(elmnt) {
		  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
		  if (document.getElementById(elmnt.id + "header")) {
		    /* if present, the header is where you move the DIV from:*/
		    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
		  } else {
		    /* otherwise, move the DIV from anywhere inside the DIV:*/
		    elmnt.onmousedown = dragMouseDown;
		  }

		  function dragMouseDown(e) {
		    e = e || window.event;
		    e.preventDefault();
		    // get the mouse cursor position at startup:
		    pos3 = e.clientX;
		    pos4 = e.clientY;
		    document.onmouseup = closeDragElement;
		    // call a function whenever the cursor moves:
		    document.onmousemove = elementDrag;
		  }

		  function elementDrag(e) {
		    e = e || window.event;
		    e.preventDefault();
		    // calculate the new cursor position:
		    pos1 = pos3 - e.clientX;
		    pos2 = pos4 - e.clientY;
		    pos3 = e.clientX;
		    pos4 = e.clientY;
		    // set the element's new position:
		    elmnt.style.center = (elmnt.offsetTop - pos2) + "px";
		    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
		  }

		  function closeDragElement() {
		    /* stop moving when mouse button is released:*/
		    document.onmouseup = null;
		    document.onmousemove = null;
		  }

		}

</script>

<?php

}elseif ($lesson_type == "Document") {

?>		
				<div class="container">
				  <h2 style="text-align: center;">Lessons</h2>
				  <p style="text-align: center;"><?php echo $lesson_name ?></p><hr>
				  <?php echo "$lesson_source"?>
				    </div>
				  </div>
				</div>
		</div>

	  	<?php
					
				}
			}
		}

		?>

<?php include 'footer.php'; ?>