
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

<input class="form-control border-0" type="text" id="formInput2" placeholder="Search for book..."> 
<div class="table-responsive bg-shadow mb-5">
 <table class="table table-bordered small">
    <thead class="thead-light">
      <tr>
        <th>Book ID</th>
        <th>Book</th>
        <th>Book Details</th>
        <th>Author</th>
        <th>Year</th>
        <th>Size</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>

<?php 

include 'connection.php';

//code to show recent courses added

        $booksql = "SELECT * FROM `library` ORDER BY `library`.`book_id` ASC";

        $bookresults = mysqli_query($conn, $booksql);
        
        if (mysqli_num_rows($bookresults) > 0) {
            // output data of each row
            while($rows = mysqli_fetch_assoc($bookresults)) {
                $bookid = $rows["book_id"];
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


          $delbook = "dashboard_edit.php?bid=$bookid";

          $download = "download.php?bid=$bookid";

          ?>

  <tbody id="tableInput2">
      <tr>
        <td><?php echo $rows["book_id"]; ?></td>
        <td><?php echo $rows["book_title"]; ?></td>
        <td class="w-25"><?php echo $rows["book_details"]; ?></td>
        <td><?php echo $rows["author"]; ?></td>
        <td><?php echo $rows["year_publish"]; ?></td>
        <td><?php echo $bytes; ?></td>
        <td class="text-center">
      <a href="<?php echo $download; ?>" class="btn btn-warning btn-sm"><i class="fas fa-download"></i></a>

      <a href="<?php echo $delbook; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

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
  $("#formInput2").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tableInput2 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>