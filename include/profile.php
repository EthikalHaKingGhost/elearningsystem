<?php 
if(isset($_SESSION["user_id"])){

    $user_id = $_SESSION["user_id"];

}else{

  header("location: ../index.php?info=login");
  
  exit();
}


?>


<div id="txtUndoable">

  <div class="container bg-light mt-2 p-3 rounded-lg">
                <div class="row">
                <div class="col-md-12">

                    <h4 class="mb-3 border-bottom">Personal Info</h4>


        <form action="dashboard.php#!tab0=8" id="userupdate" method="post">

                    <div class="form-group row">
                        <label for="fname" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control text-capitalize" pattern="[a-zA-Z]+" id="fname" value="<?php echo $first_name; ?>" data-old-value="<?php echo $first_name; ?>"  name="first_name">
                        </div>
                    </div>

                      <div class="form-group row">
                        <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control text-capitalize" pattern="[a-zA-Z]+" id="lname" Value="<?php echo $last_name; ?>" data-old-value="<?php echo $last_name; ?>" name="last_name">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="country" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                          <select class="form-control input-sm" id="country" name="gender">
                            <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                            <option disabled>_________</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                  </div>

                      <div class="form-group row">
                        <label for="bio" class="col-sm-2 col-form-label">About You</label>
                        <div class="col-sm-10">
                          <textarea type="text" maxlength="350" minlength="20" rows="5" cols="45" class="form-control font-italic"  id="bio" data-old-value="<?php echo $new_date; ?>" name="bio"><?php echo $bio; ?></textarea>
                          <label  class="figure-caption">Maximum 350 characters long.</label>
                        </div>
                      </div>

                    <div class="form-group row">
                      <label for="birthday" class="col-sm-2 col-form-label">Date of Birth</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" id="birthday" name="date" value="<?php

                        $new_date = date("M jS, Y", strtotime("dateofbirth")); 

                         echo $new_date; 

                         ?>">

                      </div>
                    </div>

                <h4 class="mb-3 pt-5 border-bottom">Contact Info</h4>
               

                <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$" id="email" value="<?php echo $email; ?>" data-old-value="<?php echo $email; ?>" name="email">
                        </div>
                    </div>
                

                <div class="form-group row">
                          <label for="cellphone" class="col-sm-2 col-form-label">Cellphone</label>
                          <div class="col-sm-10">
                          <input type="tel" class="form-control" id="cellphone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="eg. 999-999-9999" name="cellphone" value="<?php echo $cellphone; ?>" data-old-value="<?php echo $cellphone; ?>">
                    </div>
                </div>


                <h4 class="mb-3 pt-5 border-bottom">Address</h4>

  
                  <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address 1</label>
                    <div class="col-sm-10">
                    <input type="text" pattern="([^\s][A-z0-9À-ž\s]+)" class="form-control" id="address" value="<?php echo $address; ?>"  data-old-value="<?php echo $address; ?>" name="address">
                  </div>
                  </div>

                    <div class="form-group row">
                      <label for="city" class="col-sm-2 col-form-label">City</label>
                      <div class="col-sm-10">
                      <input type="text" pattern="([^\s][A-z0-9À-ž\s]+)" class="form-control text-capitalize" id="city" name="city" value="<?php echo $city; ?>" data-old-value="<?php echo $city; ?>">
                    </div>
                </div>

                     <div class="form-group row">
                        <label for="country" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-10">
                          <select class="form-control input-sm" id="country" name="country">
                            <option><?php echo $country; ?></option>
                            <option disabled>_________</option>
                            <?php 

                                $query = "SELECT * FROM countries ;";
                                    $result = mysqli_query($conn, $query);

                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))

                                    { $country_name = $row["Countryname"];

                                ?>

                                     <option><?php echo $country_name; ?></option>

                                <?php 
                                    

                                    }  
                                ?>


                          </select>
                        </div>
                  </div>

                    <hr>

                    <div class="row text-center pb-5">
                      <div class="col-md-6 offset-md-3">
                            <input type="submit" class="btn btn-primary" value="Update Profile" name="update_profile">
                      
                            <button class="btn btn-danger btnUndo">Cancel</button>
                        </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

