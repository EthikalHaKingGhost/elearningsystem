  <style type="text/css">
    /* The sidebar menu */
.sidenav {
  height: 100%; /* Full-height: remove this if you want "auto" height */
  width: 220px; /* Set the width of the sidebar */
  position: fixed; /* Fixed Sidebar (stay in place on scroll) */
  z-index: 1; /* Stay on top */
  top: 0; /* Stay at the top */
  left: 0;
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 90px;
}

/* The navigation menu links */
.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  display: block;
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: #f1f1f1;
}

/* Style page content */
.main {
  margin-left: 160px; /* Same as the width of the sidebar */
  padding: 0px 10px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidebar (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 16px;}
}
  </style>

  <div class="sidenav bg-light">
                    <div class="text-center">
                        <div class="img-fluid">

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
                    <label><em><?php echo $email; ?></em></label><br>
                    <label><small>Last Logged in:</small><small class="text-muted"> <?php echo $login_date ?></small></label>
                <div>
                    <h5><span class="badge badge-danger rounded-0"><?php echo $user_type;?></span></h5>
                </div>  
            </div>
            <hr>
                <div class="text-center pr-2">
                    <a href="coursedashboard.php" class="m-1 p-0 btn btn-block btn-warning rounded-0">Courses</a>
                    <a href="topicsdashboard.php" class="m-1 p-0 btn btn-block btn-warning rounded-0">Topics</a>
                    <a href="quizdashboard.php" class="m-1 p-0 btn btn-block btn-warning rounded-0">Quizzes</a>
                    <a href="librarydashboard.php" class="m-1 p-0 btn btn-block btn-warning rounded-0">Library</a>
                    <a href="assignmentdashboard.php" class="m-1 p-0 btn btn-block btn-warning rounded-0">Assignments</a>
                    <a href="submitdashboard.php" class="m-1 p-0 btn btn-block btn-warning rounded-0">Submissions</a>
                    <a href="resultdashboard.php" class="m-1 p-0 btn btn-block btn-warning rounded-0">Results</a>
                </div>
        </div>