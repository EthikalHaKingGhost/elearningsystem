

<?php 


if(isset($_POST["addbook"])){

	include 'include/connection.php';

   $book_title = $_POST["book_title"];
   $book_details = $_POST["book_details"];
   $uploadOk = 1;
   $topic_id = $_POST["topic_id"];
   $author = $_POST["author"];
   $year = $_POST["year_publish"];
   $access = $_POST["access"];
   $book_path = "images/book.png";
   $size ="";


if ($_FILES['fileToUpload']['error'] == 0){

	  echo '<div class="alert alert-info alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Info! </strong> the file is ok to upload.
            </div>';
    
    include 'upload.php';

}else{

	
		  echo '<div class="alert alert-warning alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>OOPS! </strong> No files were selected for iFile was uploaded with a stock picture.
            </div>';

}


if ($uploadOk == 1){


$sql = "INSERT INTO `library` (`book_id`, `book_title`, `file_size`, `book_details`, `book_path`, `author`, `year_publish`, `access`) VALUES (NULL, '$book_title', '$size', '$book_details', '$book_path', '$author', '$year', '$access');";
		if (mysqli_query($conn, $sql)) {

       $lastbook_id = mysqli_insert_id($conn);

        echo '<div class="alert alert-success alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success! </strong> book Uploaded successfully.
            </div>';


      $sqlupdate = "INSERT INTO `books_assign` (`bookassign_id`, `book_id`, `topic_id`) VALUES (NULL, '$lastbook_id', '$topic_id')";

      if (mysqli_query($conn, $sqlupdate)) {

         echo '<div class="alert alert-success alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Info! </strong>Book has bee assigned to '.$topic_title.' successfully.
            </div>';

      }

			 
		} else {

		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
    }

}
	
?>

<form action="dashboard.php" method="post" enctype="multipart/form-data">


	<div class="container bg-light mt-2 p-3 rounded-lg">


<div class="text-center font-weight-bold h5 pb-4">Add book to Library</div>


 <div class="form-group">
  	<div class="row pl-4 pr-4 text-justify">
		   <div class="col-md-3 pr-0 mt-2">
           <strong>Add existing book:</strong>
        	</div>
        	<div class="col-md-9 mb-4">
                <select type="select" class="form-control form-control-sm exist" id="exist" name="book_title" required>
                	<option> </option>
                	<?php 

					include 'include/connection.php';

					$sql = "SELECT * FROM library, books_assign WHERE library.book_id = books_assign.book_id AND books_assign.topic_id = '$topic_id'";

					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($result)) {
					        $book_title = $row["book_title"];
					        $book_id = $row["book_id"];

					?>

							<option value = "<?php echo $book_id; ?>"> <?php echo $book_title; ?></option>

					<?php
							}

							} else {

							    ?>

							<option>No books available</option>

						<?php

						  }

					  ?>	

				</select>
</div>
</div>
</div>
</div>

<div class="container bg-light mt-2 p-3 rounded-lg">


	<div class="row pl-4 pr-4 pt-3 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Book Title:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input class="form-control form-control-sm"  type="text" id="addnew0" name="book_title" rows="3" maxlength="100" required></input>    
            </div>
        </div>
</div>

	<div class="row pl-4 pr-4 pt-3 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Book Description:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <textarea class="form-control addnew"  type="text" id="addnew" name="book_details" rows="3" maxlength="100" required></textarea>    
            </div>
        </div>
</div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Book Author:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="author" title="Enter the book's name" id="addnew1" class="form-control form-control-sm">      
            </div>
        </div>
</div>


<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Year Published:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input name="year_publish" type="text" pattern="[0-9]+" id="datepicker" title="Enter the book's name" class="form-control form-control-sm">      
            </div>
        </div>
</div>

  <div class="form-group">
  	<div class="row pl-4 pr-4 text-justify">
		   <div class="col-md-3 pr-0 mt-2">
           <strong>Select Topic:</strong>
        	</div>
        	<div class="col-md-9 mb-4">
                <select type="select" class="form-control form-control-sm" id="addnew3"  name="access" required>
                	<option value="download">Downloadable</option>
                	<option value="read">Read Only</option>
                	<option value="unlimited">Full Access</option>
				</select>
</div>
</div>
</div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Upload Book:</strong>
        </div>
        <div class="col-md-9 mb-4 text-center">
            <div class="form-group files color">
              <input type="file" for="fileToUpload" name="fileToUpload" class=" form-control" id="imageupload" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">
            </div>
        </div>
</div>


 <div class="form-group">
  	<div class="row pl-4 pr-4 text-justify">
		   <div class="col-md-3 pr-0 mt-2">
           <strong>Select topic for book:</strong>
        	</div>
        	<div class="col-md-9 mb-4">
                <select type="select" class="form-control form-control-sm"  name="topic_id" required>
                	<option> </option>
                	<?php 

					include 'include/connection.php';

					$sql = "SELECT * FROM topics";

					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($result)) {
					        $topic_id = $row["topic_id"];
					        $topic_title = $row["topic_title"];

					?>

							<option value = "<?php echo $topic_id; ?>"> <?php echo $topic_title; ?></option>

					<?php
							}

							} else {

							    ?>

							<option>No topics available</option>

						<?php

						  }

					  ?>	

				</select>
</div>
</div>
</div>
</div>

		
<div class="text-center">
	<div class="col-md-6 offset-md-3">
		<input class="btn btn-info" type="submit" name="addbook" value="Add Book">
	</div>
</div>
</div>
</div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

<script type="text/javascript">
		
$("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});

</script>

<script type="text/javascript">

//Add Jquery to disable and enable fields(disable add new)

    var inpt1 = document.getElementById("exist");
inpt1.oninput= function () {
	document.getElementById("addnew0").disabled = this.value != "";
    document.getElementById("addnew").disabled = this.value != "";
    document.getElementById("addnew1").disabled = this.value != "";
    document.getElementById("datepicker").disabled = this.value != "";
    document.getElementById("imageupload").disabled = this.value != "";
	document.getElementById("addnew3").setAttribute("disabled", "disabled");

   if( !$(this).val() ) {

   	document.getElementById("addnew3").removeAttribute("disabled");

   }

};

//enable add new

    var inpt2 = document.getElementById("addnew0");
inpt2.oninput= function () {
     document.getElementById("exist").setAttribute("disabled", "disabled");

   if( !$(this).val() ) {

   	document.getElementById("exist").removeAttribute("disabled");

   }
};

</script>