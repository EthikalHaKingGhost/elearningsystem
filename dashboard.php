
<link rel="stylesheet" href="Trumbowyg-master/dist/ui/trumbowyg.min.css">


<?php 

session_start();

if(isset($_SESSION["user_id"])){

    $user_id = $_SESSION["user_id"];

}

require 'header.php'; ?>

<link rel="stylesheet" href="plugins/tabs/jquery.atAccordionOrTabs.min.css">
<script src="plugins/tabs/jquery.bbq.min.js" type="text/javascript"></script>
<script src="plugins/tabs/jquery.atAccordionOrTabs.min.js" type="text/javascript"></script>



<?php
include 'include/connection.php';

 $query = "SELECT * FROM users WHERE users.user_id = '$user_id'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {
				
                                $first_name = $row["first_name"];
                                $last_name = $row["last_name"];
                                $gender = $row["gender"];
                                $cellphone= $row["cellphone"];
                                $email = $row["email"];
                                $address = $row["address"];
                                $country = $row["country"];
                                $city = $row["city"];
                                $user_image = $row["user_image"];
                                $user_type = $row["user"];
                                $bio = $row["bio"];
                                $username = $row["uid_username"];

                                $reg_date = $row["regdate"];
                                $new_date = date("M jS, Y h:i:s", strtotime("regdate")); 

                                $birthdate = $row["birthdate"];
                                $dateofbirth = date("M jS, Y", strtotime("birthdate")); 

                                
                                //processing post date value
                                $now = strtotime(date("m/d/Y h:i:s a", time()));
                                $login_time = strtotime($row['last_login']);
                                
                                //difference in seconds
                                $newdate = ($now - $login_time) - 21600;
                                
                                if($newdate < 3600){
                                    //posted within one hour
                                    $datelogin = round($newdate/60);
                                    $login_date = $datelogin . " minute(s) ago.";
                                }
                                elseif($newdate < 86400){
                                    //posted within one day
                                    $datelogin = round($newdate/3600);
                                    $login_date = $datelogin . " hour(s) ago.";
                                }
                                else {
                                    //posted over a day ago
                                    $datelogin = round($newdate/86400);
                                    $login_date = $datelogin . " day(s) ago.";
                                }

                    }


            }else{

                $_SESSION["alerts-danger"] = "error no info to display";

            }



if (isset($_POST["update_profile"]))
{

if (!empty($_POST["first_name"])){ $new_first_name = $_POST["first_name"]; }else{ $new_first_name = $first_name; }

if (!empty($_POST["last_name"])) { $new_last_name = $_POST["last_name"]; }else{$new_last_name = $last_name;}

//if (!empty($_POST["username"])) { $new_username = $_POST["username"]; }else{$new_username = $username;}

if (!empty($_POST["bio"])){ $new_bio = $_POST["bio"]; }else{$new_bio = $bio;}

if (!empty($_POST["cellphone"])) { $new_number = $_POST["cellphone"];}else{$new_number = $cellphone;}

if (!empty($_POST["email"])){ $new_email = $_POST["email"]; }else{$new_email = $email;}

if (!empty($_POST["address"])) { $new_address = $_POST["address"]; }else{$new_address = $address;}

if (!empty($_POST["address2"])) { $new_address2 = $_POST["address2"]; }else{$new_address2 = $address2;}

if (!empty($_POST["country"])) { $new_country = $_POST["country"];}else{$new_country = $country;}

if (!empty($_POST["city"])) { $new_city = $_POST["city"];}else{$new_city = $city;}


$update = "UPDATE `users` SET `first_name` = '$new_first_name', `last_name` = '$new_last_name', `preferred_title` = '$new_title', `cellphone` = '$new_number', `email` = '$new_email', `address` = '$new_address', `address2` = '$new_address2', `countryname` = '$new_country', `city` = '$new_city', `bio` = '$new_bio' WHERE `users`.`user_id` = '$user_id'";

//updated profile activity

    $fullname = $first_name." ".$last_name;

    $activity = "INSERT INTO `user_activity` (`activity_id`, `user_id`, `fullname`, `user_image`, `activity_details`, `activity_log`, `activity_date`) VALUES (NULL, '{$_SESSION["user_id"]}', '$fullname', '{$_SESSION["user_image"]}', '{$_SESSION["user_id"]}', 'updatedprofile', current_timestamp());";

      $activity_qry = mysqli_query($conn, $activity);

    $_SESSION["alerts-success"] = "Image uploaded Updated Successfully";

echo "<meta http-equiv='refresh' content='3'>";

if (mysqli_query($conn, $update)) {

} else {

    $_SESSION["alerts-danger"] = "Error updating your image please see admin.";
}

}

//Image Upload to server

if(isset($_POST["uploadimage"])) {

    require 'include/connection.php';

    $uploadOk = 1;

if ($_FILES['fileToUpload']['error'] == 0){
  
    require ('upload.php');

}else{

$_SESSION["alerts-danger"] = "error uploading file or no file selected.";

}

if ($uploadOk == 1){

        $sql = "UPDATE `users` SET `user_image` = '$user_image' WHERE `users`.`user_id` = '$user_id';";

        echo "<meta http-equiv='refresh' content='3'>";

        $queryresult = mysqli_query($conn, $sql);

        $_SESSION["alerts-success"] = "User image changed Successfully";

    }

}

if(isset($_POST["removeimg"])) {

    $sqlupdate = "UPDATE `users` SET `user_image` = 'images/placeholder.png' WHERE `users`.`user_id` = '$user_id';";

$_SESSION["alerts_info"] = "Your profile image was removed.";

    echo "<meta http-equiv='refresh' content='2'>";

    if (mysqli_query($conn, $sqlupdate)) {


    }

}

?>



<!-------Last logged in ------->

<div id="status"></div>
        <div class="container mt-5 text-dark">
            <div class="row">
                <div class="col-md-3">
                    <div class="card p-2 text-center">

                        <div class="img-fluid m-2">

                         <a href="<?php echo $user_image; ?>" target="_blank"><img src="<?php echo $user_image; ?>"

                          class="rounded-circle" alt="avatar" width="70" height="70" id="image"/></a>

                        </div>
                        <label> <strong><?php echo "$username" ?></strong></label>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#confirmImage">
                        Change photo
                        </button>  
                 

                    <!-- The Modal -->
                    <div class="modal" id="confirmImage">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Update profile photo</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                        <form action="dashboard.php" method="post" enctype="multipart/form-data">
                            <label class="font-italic">What would you like to do?</label>
                            <div>
                                <img src="<?php echo $user_image; ?>" class="rounded-circle" width="100" height="100"><br><br>
                                <input type="submit" value="Remove photo" name="removeimg" class="btn btn-warning"><hr>
                            </div>
                          <!-- Modal footer -->
                        
                            Select photo:<input type="file" name="fileToUpload" class="btn btn-light" id="fileToUpload"><hr>
                            <input type="submit" value="Change photo" name="uploadimage" class="btn btn-success">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </form>

                          </div>
                          </div>
                        </div>
                      </div>
                   


            <hr>
                    <label><em><?php echo $email; ?></em></label>
                    <label><small>Last Logged in:</small><small class="text-muted"> <?php echo $login_date ?></small></label>
                <div>
                    <h5><span class="badge badge-warning rounded-0"><?php echo $user_type;?></span></h5>
                </div>  
            </div>
        </div>
		
            <div class="col-md-9">
			<ul class="tabs-example">
  <li class=""><a>Courses</a>
    <section>
      <?php include 'include/createcourses.php'; ?>
    </section>
  </li>
  <li><a>Topics</a>
    <section>
         <?php include 'include/createtopics.php'; ?>
    </section>
  </li>
  <li><a>Lessons</a>
    <section>
   <?php include 'include/createlessons.php'; ?>
     </section>
  </li>
  <li><a>Quizzes</a>
    <section>
         <?php include 'include/createquizzes.php'; ?>
         <?php include 'include/createquestions.php'; ?>
    </section>
  </li>
  <li><a>Assignments</a>
    <section>
         <?php include 'include/createassignment.php'; ?>
    </section>
  </li>
  <li><a>Library</a>
    <section>
         <?php include 'include/library.php'; ?>
    </section>
  </li>
</ul>
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

<script src="Trumbowyg-master/dist/trumbowyg.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/colors/trumbowyg.colors.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/fontsize/trumbowyg.fontsize.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/emoji/trumbowyg.emoji.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/table/trumbowyg.table.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/specialchars/trumbowyg.specialchars.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/table/trumbowyg.table.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/upload/trumbowyg.cleanpaste.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/upload/trumbowyg.pasteimage.min.js"></script>
     
<script type="text/javascript">


    $('#trumbowyg').trumbowyg({
    btns: [
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['fontfamily', 'fontsize'],
        ['foreColor',],
        ['backColor'],
        ['link'],
        ['insertImage'],
        ['insertAudio'],
        ['emoji'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
    ],
 
    autogrow: true

});


    var inp1 = document.getElementById("embeded");
inp1.oninput= function () {
    document.getElementById("uploadinput").disabled = this.value != "";
};

    var inp2 = document.getElementById("uploadinput");
inp2.oninput= function () {
    document.getElementById("embeded").disabled = this.value != "";
};


$('.tabs-example').accordionortabs({
  hashbangPrefix: "tab",
  tabsIfPossible: true,
  });

</script>

<?php require 'footer.php'; ?>


