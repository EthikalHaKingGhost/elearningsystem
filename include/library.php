
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


if (isset($_POST["books"])){

  $topic_id = $_POST["topic_id"];
  $book_id = $_POST["books"];

include 'include/connection.php';

  $sql1 = "SELECT book_id, topic_id FROM books_assign WHERE topic_id = '$topic_id' AND book_id = '$book_id'";

$result = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {

$newbook_id = $row["book_id"];
$newtopic_id = $row["topic_id"];

}

        echo '<div class="alert alert-info alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>OOPS! </strong> This book is already assigned to topic
            </div>';

}else{

    include 'include/connection.php';

        $sqlupdate = "INSERT INTO `books_assign` (`bookassign_id`, `book_id`, `topic_id`) VALUES (NULL, '$book_id', '$topic_id')";

              if (mysqli_query($conn, $sqlupdate)) {

         echo '<div class="alert alert-success alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success! </strong>Book has been assigned successfully.
            </div>';

      }

}


}elseif(isset($_POST["addbook"])){


  include 'include/connection.php';

   $book_title = $_POST["book_title"];
   $book_details = $_POST["book_details"];
   $topic_id = $_POST["topic_id"];
   $author = $_POST["author"];
   $year = $_POST["year_publish"];
   $access = $_POST["access"];
   $book_path = "images/book.png";
   $size ="";
   $uploadOk = 1;


if ($_FILES['fileToUpload']['error'] == 0){

    echo '<div class="alert alert-info alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message! </strong> the file is ok to upload.
            </div>';
    
    include 'upload.php';

}else{

  
      echo '<div class="alert alert-warning alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>OOPS! </strong> No image was selected, Default image.
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

<form action="dashboard.php#!tab0=11" method="post" enctype="multipart/form-data">


	<div class="container bg-light mt-2 p-3 rounded-lg">


<div class="text-center font-weight-bold h5 pb-4">Add book to Library</div>


 <div class="form-group">
  	<div class="row pl-4 pr-4 text-justify">
		   <div class="col-md-3 pr-0 mt-2">
           <strong>Add existing book:</strong>
        	</div>
        	<div class="col-md-9 mb-4">
                <select title="Please select from books that have not been assigned" class="form-control form-control-sm exist" id="exist" name="books" required>
                	<option></option>
                	<?php 

					include 'include/connection.php';

					$sql = "SELECT * FROM library";

					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {

					    // output data of each row
					    while($row = mysqli_fetch_assoc($result)) {
					        $book_title = $row["book_title"];
					        $book_id = $row["book_id"];
                  $year_publish = $row["year_publish"];

					?>

							<option value="<?php echo $book_id ?>"> <?php echo $book_title ?> </option>

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

<div id="hideinputs">
	<div class="row pl-4 pr-4 pt-3 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Book Title:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input class="form-control form-control-sm"  type="text" id="addnew0" name="book_title" rows="3" maxlength="100" required>   
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

		
<div class="text-center">
	<div class="col-md-6 offset-md-3">
		<input class="btn btn-info" type="submit" name="addbook" value="Add Book">
	</div>
</div>
</div>
</form>
