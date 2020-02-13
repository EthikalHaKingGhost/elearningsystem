
<?php 

session_start();

if(isset($_SESSION["first_name"])){

  $first_name = $_SESSION["first_name"];
   $last_name = $_SESSION["last_name"];
   echo "Welcome $first_name $last_name";

}

 include 'header.php';?> 
<?php include 'slider.php';?>

<br>
<div class="container">
  <h3>Collapsible Navbar</h3>
  <p>In this example, the navigation bar is hidden on small screens and replaced by a button in the top right corner (try to re-size this window).</p>
  <p>Only when the button is clicked, the navigation bar will be displayed.</p>
  <p>Tip: You can also remove the .navbar-expand-md class to ALWAYS hide navbar links and display the toggler button.</p>
</div>

<?php include 'footer.php'; ?>

