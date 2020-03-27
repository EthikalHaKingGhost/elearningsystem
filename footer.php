
<style type="text/css">

.banner{
    background-image: url('images/3.jpg');
}

#topofpage {
    overflow: hidden;
    display: none;
    cursor: pointer;
    position: fixed;
    bottom: 50px;
    right: 50px;
    background-color: transparent;
    color: #e84118;
    text-align: center;
    font-size: 30px;
    text-decoration: none;
    border-radius: 50px 50px;
}
#topofpage:hover {
    background-color:transparent;
    color: #e84118;
    border-radius: 50px 50px;
}

</style>



<!----------Scroll to the top of the page ---------->

<a id="topofpage" title="Top Of Page" href="index.php"><i class="fas fa-chevron-up"></i></a>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
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
	                       


	                     
