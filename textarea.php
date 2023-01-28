<?php require 'header.php';?>


<form class="p-3">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" placeholder="Joe Smith">
  </div>
  
  <div class="form-group">
    <label for="seeAnotherField">Do You Want To See Another Field?</label>
    <select class="form-control" id="seeAnotherField">
          <option value="no">No Way.</option>
          <option value="yes">Absolutely!</option>
    </select>
  </div>
  
  <div class="form-group" id="otherFieldDiv">
    <label for="otherField">Here you go!</label>
    <select class="form-control" id="otherField">
      <option>Yay</option>
      <option>Woo</option>
      <option>Hazah</option>
      <option>Yipee</option>
      <option>Hoorah</option>
    </select>
  </div>
  
  <div class="form-group">
    <label for="seeAnotherFieldGroup">Do You Want To See Another Group of Fields?</label>
    <select class="form-control" id="seeAnotherFieldGroup">
          <option value="no">Not Particularly.</option>
          <option value="yes">I Guess!</option>
    </select>
  </div>
  
  <div class="form-group" id="otherFieldGroupDiv">
    <div class="row">
      <div class="col-12">
        <label for="otherField1">Group: Heres One!</label>
        <input type="text" class="form-control w-100" id="otherField1">
      </div>
      <div class="col-12">
        <label for="otherField2">Group: Another One!</label>
        <input type="text" class="form-control w-100" id="otherField2">
      </div>
      <div class="col-12">
        <label for="otherField3">Group: Another One!</label>
        <input type="text" class="form-control w-100" id="otherField3">
      </div>
      <div class="col-12">
        <label for="otherField4">Group: Another One!</label>
        <input type="text" class="form-control w-100" id="otherField4">
      </div>
    </div>
  </div>
  
  <div class="form-group">
    <label for="comments">Comments/Questions</label>
    <textarea class="form-control" id="comments" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<style type="text/css">
    form {
  max-width: 900px;
  display: block;
  margin: 0 auto;
}

</style>


<?php require 'footer.php';?>



<script type="text/javascript">
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
  if ($(this).val() == "yes") {
    $('#otherFieldGroupDiv').show();
    $('#otherField1').attr('required', '');
    $('#otherField1').attr('data-error', 'This field is required.');
    $('#otherField2').attr('required', '');
    $('#otherField2').attr('data-error', 'This field is required.');
    $('#otherField3').attr('required', '');
    $('#otherField3').attr('data-error', 'This field is required.');
    $('#otherField4').attr('required', '');
    $('#otherField3').attr('data-error', 'This field is required.');
  } else {
    $('#otherFieldGroupDiv').hide();
    $('#otherField1').removeAttr('required');
    $('#otherField1').removeAttr('data-error');
    $('#otherField2').removeAttr('required');
    $('#otherField2').removeAttr('data-error');
  }
});
$("#seeAnotherFieldGroup").trigger("change");
</script>