

<!----------Scroll to the top of the page ---------->

<a id="topofpage" title="Top Of Page" href="index.php"><i class="fas fa-chevron-up"></i></a>


<script type="text/javascript">

    $('#text').webSpeaker();


</script>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="notify/bootstrap-notify.js"></script>
<script src="https://code.responsivevoice.org/responsivevoice.js"></script>



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




<footer>    
<div class="footer">
        <div class="container">
             
            <b class="copyright">&copy; 2014 Edmin - EGrappler.com </b> All rights reserved.
        </div>
    </div>
</footer>
  </body>
</html>
