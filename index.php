
<?php 

session_start();

if(isset($_SESSION["first_name"])){

  $first_name = $_SESSION["first_name"];
   $last_name = $_SESSION["last_name"];

}

 include 'header.php';?> 

 
 <style>

.parallax {
  background-image: url("./images/ma.jpg");

  opacity: 0.9;
    filter: brightness(50%);
    height: 300px;

  background-attachment: fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-position: center;
  -o-background-size: cover;
  background-repeat: no-repeat;
  background-size: cover;

}

</style>
<?php include 'slider.php';?>

<div class="parallax"></div>

<h2>Courses</h2>
<p>For a remarkable about page, all you need to do is figure out
your company's unique identity, and then share it with the world. Easy, right? Of course not. Your "About Us" page is one of the most important pages on your website, and it needs to be well crafted. This profile also happens to be one of the most commonly overlooked pages, which is why you should make it stand out.The good news? It can be done. In fact, there are some companies out there with remarkable "About Us" pages, the elements of which you can emulate on your own website.</p>
</div>


<?php include'footer.php'; ?>

<!-- Container element -->
<div class="parallax"></div>


<?php include 'footer.php'; ?>