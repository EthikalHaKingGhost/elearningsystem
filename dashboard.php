
<link rel="stylesheet" href="Trumbowyg-master/dist/ui/trumbowyg.min.css">


<?php 

if(session_status() === PHP_SESSION_NONE) session_start();


if(isset($_SESSION["user_id"])){

    $user_id = $_SESSION["user_id"];

}else{

  header("location: ../index.php?info=login");
  
  exit();
}


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

                                $datereg = $row["regdate"];
                                $reg_date = date("Y-m-d h:i:s", strtotime("$datereg")); 

                                $new_date = date("M jS, Y h:i:s", strtotime("$datereg")); 

                                $birthdate = $row["birthdate"];
                                $dateofbirth = date("Y-m-d", strtotime("$birthdate"));  

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

if (!empty($_POST["username"])) { $new_username = $_POST["username"]; }else{$new_username = $username;}

if (!empty($_POST["bio"])){ $new_bio = $_POST["bio"]; }else{$new_bio = $_POST["bio"];}

if (!empty($_POST["cellphone"])) { $new_number = $_POST["cellphone"];}else{$new_number = $cellphone;}

if (!empty($_POST["email"])){ $new_email = $_POST["email"]; }else{$new_email = $email;}

if (!empty($_POST["gender"])){ $new_gender = $_POST["gender"]; }else{$new_gender = $gender;}

if (!empty($_POST["address"])) { $new_address = $_POST["address"]; }else{$new_address = $address;}

if (!empty($_POST["country"])) { $new_country = $_POST["country"];}else{$new_country = $country;}

if (!empty($_POST["date"])) { $date_birth = $_POST["date"];}else{$date_birth = $dateofbirth;}

if (!empty($_POST["city"])) { $new_city = $_POST["city"];}else{$new_city = $city;}


$update = "UPDATE `users` SET `email` = '$new_email', `first_name` = '$new_first_name', `last_name` = '$new_last_name', `regdate` = '$reg_date', `address` = '$new_address', `country` = '$new_country',`city` = '$new_city',`bio` = '$new_bio', `gender` = '$new_gender', `birthdate` = '$date_birth' WHERE `users`.`user_id` = '$user_id';";

 if (mysqli_query($conn, $update)) {

  echo "<meta http-equiv='refresh' content='1'>";

  $_SESSION["alerts-success"] = "Profile updated successfully";

} else {

  $_SESSION["alerts-danger"] = "Error code 1, unable to update, please contact Administration";
}

}

//Image Upload to server

if(isset($_POST["uploadimage"])) {

require 'alerts.php';

    require 'include/connection.php';

    $uploadOk = 1;

if ($_FILES['fileToUpload']['error'] == 0){
  
    require ('upload.php');

}else{

$_SESSION["alerts-danger"] = "error uploading file or no file selected.";

}

if ($uploadOk == 1){

        $sql = "UPDATE `users` SET `user_image` = '$user_image' WHERE `users`.`user_id` = '$user_id';";

        if(mysqli_query($conn, $sql)){

        $_SESSION["alerts-success"] = "User image changed Successfully";
    }
  }
}

if(isset($_POST["removeimg"])) {

    $sqlupdate = "UPDATE `users` SET `user_image` = 'images/placeholder.png' WHERE `users`.`user_id` = '$user_id';";

    echo "<meta http-equiv='refresh' content='2'>";

    if (mysqli_query($conn, $sqlupdate)) {

        $_SESSION["alerts_info"] = "Your profile image was removed.";

    }

}

$page_title = "Admin Dashboard";

require 'header.php'; ?>


<link rel="stylesheet" href="plugins/tabs/jquery.atAccordionOrTabs.min.css">
<script src="plugins/tabs/jquery.bbq.min.js" type="text/javascript"></script>
<script src="plugins/tabs/jquery.atAccordionOrTabs.min.js" type="text/javascript"></script>

<div class="banner" style="background-image: url(images/1.jpg);">
  
</div>

<!-------Last logged in ------->



<div class="container-fluid p-5">
  <div class="row">
<div class="col-md-3">
  <div class="card bg-light">
                    <div class="text-center">
                        <div class="img-fluid py-2">

                         <a href="<?php echo $user_image; ?>" target="_blank"><img src="<?php echo $user_image; ?>"

                          class="rounded-circle" alt="avatar" width="150" height="150" id="image"/></a>

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
                    <label><em><?php echo $email; ?></em></label><br>
                    <label><small>Last Logged in:</small><small class="text-muted"> <?php echo $login_date ?></small></label>
                <div>
                    <h5><span class="badge badge-danger rounded-0"><?php echo $user_type;?></span></h5>
                </div>  
            </div>
        </div>
</div>


<div class="col-md-9">
			<ul class="tabs-example m-0">
  <li class=""><a>Add Courses</a>
    <section>
      <?php include 'include/createcourses.php'; ?>
    </section>
  </li>
    <li><a>View Courses</a>
    <section>
         <?php include 'include/viewcourses.php'; ?>
    </section>
  </li>
  <li><a>Add Topics</a>
    <section>
         <?php include 'include/createtopics.php'; ?>
    </section>
  </li>
  <li><a>View Topics</a>
    <section>
         <?php include 'include/topicsedit.php'; ?>
    </section>
  </li>
  <li><a>Add Lessons</a>
    <section>
   <?php include 'include/createlessons.php'; ?>
     </section>
  </li>
  <li><a>View Lessons</a>
    <section>
   <?php include 'include/viewlessons.php'; ?>
     </section>
  </li>
  <li><a>Add Quizzes</a>
    <section>
         <?php include 'include/createquizzes.php'; ?>
         <?php include 'include/createquestions.php'; ?>
    </section>
  </li>
  <li><a>View Quizzes</a>
    <section>
         <?php include 'include/viewquizzes.php'; ?>
    </section>
  </li>
  <li><a>Add Assignments</a>
    <section>
         <?php include 'include/createassignment.php'; ?>
    </section>
  </li>
  <li><a>Reports</a>
    <section>
         <?php include 'include/studentreport.php'; ?>
    </section>
  </li>
  <li><a>Library</a>
    <section>
         <?php include 'include/library.php'; ?>
    </section>
  </li>
  <li><a>View Library</a>
    <section>
         <?php include 'include/viewlibrary.php'; ?>
    </section>
  </li>
    <li><a>Edit Profile</a>
    <section>
         <?php include 'include/profile.php'; ?>
    </section>
  </li>
</ul>
</div>
</div>

</div>






<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

<!----------Scroll to the top of the page ---------->


<script type="text/javascript">

    $(document).ready(function() {
    $(".submit").click(function(event) {
        if( !confirm('You are about to delete the Lessons, Quizzes, Assignments, and Books added to this topic. Are you sure you would like to delete this topic?') ) 
            event.preventDefault();
            });
        });

$(document).ready(function() {
     $(".delete").click(function(event) {
        if( !confirm('You are about to delete the topics added to this course. Are you sure you would like to delete this course?') ) 
            event.preventDefault();
            });
        });



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
  $('#hideinputs').hide();


   if( !$(this).val() ) {

    document.getElementById("addnew3").removeAttribute("disabled");
    $('#hideinputs').show();

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


//cancel button on user profile page
$('.btnUndo').click(function () {
  console.log("undo clicked.")

        $('#txtUndoable')[0].reset();
  });

$('#txtUndoable').trigger("reset");

</script>



<script src="Trumbowyg-master/dist/trumbowyg.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/colors/trumbowyg.colors.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/fontsize/trumbowyg.fontsize.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/emoji/trumbowyg.emoji.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/table/trumbowyg.table.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/base64/trumbowyg.base64.js"></script>
<script src="Trumbowyg-master/dist/plugins/noembed/trumbowyg.noembed.js"></script>
<script src="Trumbowyg-master/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js"></script>
<script src="Trumbowyg-master/dist/plugins/table/trumbowyg.table.min.js"></script>
     
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
        ['base64', 'noembed', 'insertImage'],
        ['emoji'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
    ],

      autogrow: true,

       plugins: {
        // Add imagur parameters to upload plugin for demo purposes
        upload: {
            serverPath: '/uploads',
            fileFieldName: 'image',
            headers: {
                'Authorization': 'Client-ID xxxxxxxxxxxx'
            },
            urlPropertyName: 'data.link'
        }
    }

});



//hide upload and embed field on page startup
$(function(){ 
       function doChangeThings() {
            $('#see-upload').hide();
            $('#see-embed').hide();
       }  
       doChangeThings(); 
    });  



$("#textlesson").change(function() {

  if ($(this).val() == 'noupload'){
    
    $("#content").prop( "disabled", true );
    $("#addcontent").prop( "disabled", true );
    $('#access').hide();
    $('#upload').hide();

}else{
    
    $("#content").prop( "disabled", false );
    $("#addcontent").prop( "disabled", false );
    $('#access').show();
    $('#upload').show();
}

});

$("#textlesson").trigger("change");



$(function(){ 
       function doChangeThings() {
            $('#see-upload').hide();
            $('#see-embed').hide();
       }  
       doChangeThings(); 
    });  

$("#addcontent").change(function() {

  if ($(this).val() == 'embed'){
    
    $('#embeded').attr('required', '');
    $('#embeded').attr('data-error', 'This field is required.');
    $("#uploadinput").prop( "disabled", true );
    $("#embeded").prop( "disabled", false );
    $('#uploadinput').removeAttr('required');
    $('#uploadinput').removeAttr('data-error');
    $('#see-embed').show();
    $('#see-upload').hide();

}else if ($(this).val() == 'upload'){
    
    $('#uploadinput').attr('required', '');
    $('#uploadinput').attr('data-error', 'This field is required.');
    $("#uploadinput").prop( "disabled", false );
    $("#embeded").prop( "disabled", true );
    $('#embeded').removeAttr('required');
    $('#embeded').removeAttr('data-error');
    $('#see-embed').hide();
    $('#see-upload').show();
}else if ($(this).val() == ''){

    $('#addcontent').attr('required', '');
    $('#addcontent').attr('data-error', 'This field is required.');
}

});

$("#content").trigger("change");




//tabs for changes
$('.tabs-example').accordionortabs({
  hashbangPrefix: "tab",
  tabsIfPossible: true,
  });

</script>


<script type="text/javascript">

  //Hide Form Fields Based Upon User Selection (https://www.solodev.com/blog/web-design/how-to-hide-form-fields-based-upon-user-selection.stml)

  $("#seeAnotherField").change(function() {
  if ($(this).val() == "yes") {
    $('#otherFieldDiv').show();
    $('#otherField').attr('required', '');
    $('#otherField').attr('data-error', 'This field is required.');
  } else {
    $('#otherFieldDiv').hide();
    $('#otherField').removeAttr('required');
    $('#otherField').removeAttr('data-error');
  }
});

$("#seeAnotherField").trigger("change");

$("#seeAnotherFieldGroup").change(function() {

  if ($(this).val() == "multiple choice") {

    $('#otherFieldGroupDiv').show();
    $('#otherFieldGroupDiv2').hide();
    $('#otherField6').removeAttr('required');
    $('#otherField6').removeAttr('data-error');
    $('#otherField1').attr('required', '');
    $('#otherField1').attr('data-error', 'This field is required.');
    $('#otherField2').attr('required', '');
    $('#otherField2').attr('data-error', 'This field is required.');
    $('#otherField3').attr('required', '');
    $('#otherField3').attr('data-error', 'This field is required.');
    $('#otherField4').attr('required', '');
    $('#otherField4').attr('data-error', 'This field is required.');
    $('#otherField5').attr('required', '');
    $('#otherField5').attr('data-error', 'This field is required.');
    $( "#otherField7" ).prop( "disabled", true );
    $( "#otherField8" ).prop( "disabled", true );
    $( "#otherField6" ).prop( "disabled", true );

    
  } else if ($(this).val() == "true or false"){

    $('#otherFieldGroupDiv').hide();
    $('#otherFieldGroupDiv2').show();
    $('#otherField6').attr('required', '');
    $('#otherField6').attr('data-error', 'This field is required.');
    $('#otherField1').removeAttr('required');
    $('#otherField1').removeAttr('data-error');
    $('#otherField2').removeAttr('required');
    $('#otherField2').removeAttr('data-error');
    $('#otherField3').removeAttr('required');
    $('#otherField3').removeAttr('data-error');
    $('#otherField4').removeAttr('required');
    $('#otherField4').removeAttr('data-error');
    $('#otherField5').removeAttr('required');
    $('#otherField5').removeAttr('data-error');
    $( "#otherField7" ).prop( "disabled", false );
    $( "#otherField8" ).prop( "disabled", false );
    $( "#otherField6" ).prop( "disabled", false );

    
  }

});

$("#seeAnotherFieldGroup").trigger("change");

</script>

<?php include 'footer.php'; ?>