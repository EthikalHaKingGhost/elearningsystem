
<?php include 'header.php'; ?>

<style>

.parallax {
  background-image: url("./images/ma.jpg");
  
    opacity: 0.9;
    filter: brightness(50%);
    height: 200px;

  background-attachment: fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-position: center;
  -o-background-size: cover;
  background-repeat: no-repeat;
  background-size: cover;

}


.w3-image{
	opacity: 0.9;
	filter: brightness(70%)
}
.w3-image:hover{
	opacity: 1;
	filter: brightness(100%);
}




</style>

<div class="parallax"></div>

<div class="w3-content w3-container w3-padding-64" id="about">
  <h3 class="w3-center"><b>ABOUT US</b></h3>
  <p class="w3-center"><em>Learn anything</em></p>
  <p align="justify"> We have created a fictional "personal" website/blog, and our fictional character is a hobby photographer. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
    qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

  <div class="w3-row">
    <div class="w3-col m6 w3-center w3-padding-32">
      <h4><b>Courses</b></h4>
      <img src="./images/ma.jpg" class="w3-round w3-image" alt="Photo of Me" width="380" height="200">
    </div>

    <!-- Hide this text on small devices -->
    <div class="w3-col m6 w3-hide-small w3-padding-32">
      <p align="justify">Welcome to my website. I am lorem ipsum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor
        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
  </div>
</div>


<!-- Container element -->
<div class="parallax"></div></div>


<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-ios.css">

<?php include 'footer.php'; ?>