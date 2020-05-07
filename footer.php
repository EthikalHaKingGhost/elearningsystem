


<footer>

    <!-- Footer -->
  <footer class="bg-dark text-white">
    <div class="container py-5" >
      <div class="row py-4">
        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 text-center"><img src="images/logo.png"  alt="" width="100" class="bg-light rounded-circle" class="mb-3">
            <div class="h1 font-italic">E-learning2020</div>
        </div>

        <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
          <h6 class="text-uppercase font-weight-bold mb-4">Home</h6>
          <ul class="list-unstyled mb-0">
            <li class="mb-2"><a href="#" class="text-muted text-light menu-link text-decoration-none">Courses</a></li>
            <li class="mb-2"><a href="#" class="text-muted text-light menu-link text-decoration-none">Contact</a></li>
            <li class="mb-2"><a href="#" class="text-muted text-light menu-link text-decoration-none">About Us</a></li>
            <li class="mb-2"><a href="#" class="text-muted text-light menu-link text-decoration-none">Location</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
          <h6 class="text-uppercase font-weight-bold mb-4">Company</h6>
          <ul class="list-unstyled mb-0">
            <li class="mb-2"><a href="login.php" class="text-muted text-light menu-link text-decoration-none">Login</a></li>
            <li class="mb-2"><a href="register.php" class="text-muted text-light menu-link text-decoration-none">Register</a></li>
            <li class="mb-2"><a href="dashboard.php" class="text-muted text-light menu-link text-decoration-none">Dashboard</a></li>
            <li class="mb-2"><a href="user-profile.php" class="text-muted text-light menu-link text-decoration-none">My Profile</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-6 mb-lg-0">
            <h6 class="text-uppercase font-weight-bold mb-4">Our Location</h6>
            <p class="font-italic text-muted">Trinidad, Montrose Chaguanas </p>
                <div class="google-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3922.8242171228403!2d-61.407206685201515!3d10.514507492499586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c35f9763a93f051%3A0x84197d083228f4e0!2sCTS%20College%20of%20Business%20and%20Computer%20Science%20Ltd!5e0!3m2!1sen!2stt!4v1587079213068!5m2!1sen!2stt" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                </div>
            </div>
        </div>
      </div>
    </div>

    <!-- Copyrights -->
    <div class=" py-1 bg-light">
      <div class="container text-center">
        <p class="text-dark mb-0">© 2019 Elearning2020 All rights reserved.</p>
      </div>
    </div>
  </footer>
  <!-- End -->


<!----------Scroll to the top of the page ---------->

<a id="topofpage" title="Top Of Page" href="index.php"><i class="fas fa-chevron-up"></i></a>


<script type="text/javascript">
/*Scroll to top when arrow up clicked BEGIN*/
$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('#topofpage').fadeIn();
    } else {
        $('#topofpage').fadeOut();
    }
});
$(document).ready(function() {
    $("#topofpage").click(function(event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

});

</script>

  </body>
</html>
