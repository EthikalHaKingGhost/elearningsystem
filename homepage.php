
<?php 

session_start();

if(isset($_SESSION["first_name"])){

  $first_name = $_SESSION["first_name"];
   $last_name = $_SESSION["last_name"];

}

 include 'header.php';?> 
 
 
<?php include 'slider1.php';?>

<br>
<div class="container">

<div class="row">
<div class="col-md-4">
 <div class="card bg-secondary text-white" style="height: 100px">
    <div class="card-body">Primary card</div>
  </div>
</div>

<div class="col-md-4">
 <div class="card bg-secondary text-white" style="height: 100px">
    <div class="card-body">Secondary card</div>
  </div>
</div>
</div>
</div>
  <br>
  <br>

<?php include 'footer.php'; ?>