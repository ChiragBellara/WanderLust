<?php 
if (isset($_SESSION["email"]))
{	
        $x=1;
        
	
}
else{
	$x=0;
}


?>


<link href='https://fonts.googleapis.com/css?family=Montserrat|Cardo' rel='stylesheet' type='text/css'>
<link href='include_css_customized_for_profile.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>

  
<header class="main_h">

    <div class="rownav">
        <a class="increase" href="index.php">WanderLust</a>

        <div class="mobile-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <nav>
            <ul>
                <li><a href="join_trip.php">Join</a></li>
                <li><a href="create_trip.php">Create</a></li>
                <li><a href="friends.php">Friends</a></li>
                <li><a href="requests.php">Requests</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="logout.php">BYE</a></li>
                
            </ul>
        </nav>

    </div> <!-- / row -->

</header>




<?php if ($x==1)
    {	
        echo("<div style='background-image:url(images/trip_five_img.jpg)' class='hero' style =''><h1><br>WanderLust</h1></div>");
        // echo '<img class ="hero" src="data:image/jpeg;base64,'.base64_encode( $row['cover_pic'] ).'"/>';
    
    }
?>
                




<script>
// Sticky Header
$(window).scroll(function() {

    if ($(window).scrollTop() > 100) {
        $('.main_h').addClass('sticky');
    } else {
        $('.main_h').removeClass('sticky');
    }
});

// Mobile Navigation
$('.mobile-toggle').click(function() {
    if ($('.main_h').hasClass('open-nav')) {
        $('.main_h').removeClass('open-nav');
    } else {
        $('.main_h').addClass('open-nav');
    }
});

$('.main_h li a').click(function() {
    if ($('.main_h').hasClass('open-nav')) {
        $('.navigation').removeClass('open-nav');
        $('.main_h').removeClass('open-nav');
    }
});

// navigation scroll lijepo radi materem
$('nav a').click(function(event) {
    var id = $(this).attr("href");
    var offset = 70;
    var target = $(id).offset().top - offset;
    $('html, body').animate({
        scrollTop: target
    }, 500);
    event.preventDefault();
});


</script>