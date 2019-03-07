<?php 

if (isset($_SESSION["email"]))
{	
    $x=1;
    $y=0;
    $actual_link = "$_SERVER[REQUEST_URI]";
    
    if($actual_link === "/create_trip.php"){
        $y=1;
    }
    else if($actual_link === "/join_trip.php"){
        $y=2;
    }
    else if($actual_link === "/complete_registeration.php"){
        $y=3;
    }
    else if(substr($actual_link,0,21) === "/join_trip_actual.php"){
        $y=4;
    }
    else if(substr($actual_link,0,23) === "/create_trip_actual.php"){
        $y=5;
    }
    else if($actual_link === "/requests.php")
    {
        $y=6;
    }
    else if($actual_link === "/invites.php")
    {
        $y=7;
    }
    else if($actual_link === "/notification.php")
    {
        $y=8;
    }
    else if($actual_link === "/all_trips.php")
    {
        $y=9;
    }
    else if($actual_link === "/history_trips.php")
    {
        $y=10;
    }
    else if($actual_link === "/settings.php")
    {
        $y=11;
    }
    else if($actual_link === "/friends.php")
    {
        $y=12;
    }
    else if($actual_link === "/friend_request.php")
    {
        $y=13;
    }
    else if($actual_link === "/blocked.php")
    {
        $y=14;
    }
    else if($actual_link === "/searchf.php")
    {
        $y=15;
    }
    else if(substr($actual_link,0,21) === "/all_trips_global.php"){
        $y=16;
        $globaluserid = substr($actual_link,185);
          $cipher1 = sha1($globaluserid);
          $cipher2 = sha1($cipher1);
          $cipher3 = sha1($cipher2);
          $cipher4 = sha1($cipher3);
          $globaluseridsend = $cipher1.$cipher2.$cipher3.$cipher4.$globaluserid;

          $query = "SELECT * FROM users WHERE userid=$globaluserid";
            $result1 = mysqli_query($conn,$query);

            while($row1 = mysqli_fetch_array($result1)){
                    $name = $row1['fname'];
                    $username = $name."s' History Trek";
            }
    }
    else if(substr($actual_link,0,25) === "/history_trips_global.php"){
        $y=17;
        $globaluserid = substr($actual_link,189);
          $cipher1 = sha1($globaluserid);
          $cipher2 = sha1($cipher1);
          $cipher3 = sha1($cipher2);
          $cipher4 = sha1($cipher3);
          $globaluseridsend = $cipher1.$cipher2.$cipher3.$cipher4.$globaluserid;

          $query = "SELECT * FROM users WHERE userid=$globaluserid";
            $result1 = mysqli_query($conn,$query);

            while($row1 = mysqli_fetch_array($result1)){
                    $name = $row1['fname'];
                    $username = $name."s' Future Trek";
            }
    }
    
    
    
    
    
}
else{
	$x=0;
}

?>


<link href='https://fonts.googleapis.com/css?family=Montserrat|Cardo' rel='stylesheet' type='text/css'>
<link href='include_css_customized_for_profile.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>

  
<header class="main_h sticky">

    <div class="rownav">
        <a class="increase" href="#">WanderLust</a>

        <div class="mobile-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <nav>
            <ul>
                <?php if ($y==1)
                {	
                    echo("<li class=''><a class='' href='index.php' title=''>Home</a></li>");
                    echo("<li><a class='smoothscroll' href='join_trip.php' title=''>Join Trek</a></li>");
                    echo("<li><a class='smoothscroll' href='friends.php' title=''>Your Friends</a></li>");    
					echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Profile</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
					
                
                }
                else if($y==2){
                    echo("<li class=''><a class='' href='index.php' title=''>Home</a></li>");
                    echo("<li><a class='smoothscroll' href='create_trip.php' title=''>Create Trip</a></li>");
                    echo("<li><a class='smoothscroll' href='friends.php' title=''>Your Friends</a></li>");
					echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Profile</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
					
                }
                else if($y==3){
                    echo("<li class=''><a class='' href='index.php' title=''>Home</a></li>");
                    echo("<li><a class='smoothscroll' href='create_trip.php' title=''>Create Trip</a></li>");
                    echo("<li><a class='smoothscroll' href='join_trip.php' title=''>Join Trip</a></li>");
                    
					echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Profile</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                else if($y==4){
                    echo("<li class=''><a class='' href='index.php' title=''>Home</a></li>");
                    echo("<li><a class='smoothscroll' href='create_trip.php' title=''>Create Trip</a></li>");
                    echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Profile</a></li>");
                    echo("<li><a class='smoothscroll' href='join_trip.php' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                else if($y==5){
                    echo("<li class=''><a class='' href='index.php' title=''>Home</a></li>");
                    echo("<li><a class='smoothscroll' href='join_trip.php' title=''>Join Trip</a></li>");
                    echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Profile</a></li>");
                    echo("<li><a class='smoothscroll' href='create_trip.php' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                else if($y==6){
                    echo("<li class=''><a class='' href='index.php' title=''>Home</a></li>");
                    echo("<li class=''><a class='' href='notification.php' title=''>Notification</a></li>");
                    echo("<li><a class='smoothscroll' href='invites.php' title=''>Invites</a></li>");
                    echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                else if($y==7){
                    echo("<li class=''><a class='' href='index.php' title=''>Home</a></li>");
                    echo("<li class=''><a class='' href='notification.php' title=''>Notification</a></li>");
                    echo("<li><a class='smoothscroll' href='requests.php' title=''>Join Request</a></li>");
                    echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                else if($y==8){
                    echo("<li class=''><a class='' href='index.php' title=''>Home</a></li>");
                    echo("<li><a class='smoothscroll' href='requests.php' title=''>Join Request</a></li>");
                    echo("<li><a class='smoothscroll' href='invites.php' title=''>Invites</a></li>");
                    echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                else if($y==9){
                    echo("<li><a class='smoothscroll' href='history_trips.php' title=''>History Treks</a></li>");
                    echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                else if($y==10){
                    echo("<li><a class='smoothscroll' href='all_trips.php' title=''>Future Treks</a></li>");
                    echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                else if($y==11){
                    echo("<li><a class='smoothscroll' href='index.php' title=''>Home</a></li>");
                    echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                else if($y==12){
                    
                    echo("<li><a class='smoothscroll' href='searchf.php' title=''>Search Friends</a></li>");
                    echo("<li><a class='smoothscroll' href='friend_request.php' title=''>Friends Requests</a></li>");
                    echo("<li><a class='smoothscroll' href='blocked.php' title=''>Blocked</a></li>");
                    echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                else if($y==13){   
                    echo("<li><a class='smoothscroll' href='searchf.php' title=''>Search Friends</a></li>");
                    echo("<li><a class='smoothscroll' href='friends.php' title=''>Your Friends</a></li>");
                    echo("<li><a class='smoothscroll' href='blocked.php' title=''>Blocked</a></li>");
                    echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                 else if($y==14){   
                    echo("<li><a class='smoothscroll' href='searchf.php' title=''>Search Friends</a></li>");
                    echo("<li><a class='smoothscroll' href='friends.php' title=''>Your Friends</a></li>");
                    echo("<li><a class='smoothscroll' href='friend_request.php' title=''>Friend Request</a></li>");
                    echo("<li><a class='smoothscroll' href='profilepage.php' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                else if($y==15){   
                    echo("<li><a class='smoothscroll' href='friends.php' title=''>Your Friends</a></li>");
                    echo("<li><a class='smoothscroll' href='friend_request.php' title=''>Friend Request</a></li>");
                    echo("<li><a class='smoothscroll' href='blocked.php' title=''>Blocked</a></li>");
                    echo("<li><a class='smoothscroll' href='friends.php' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                else if($y==16){
                    echo("<li><a class='smoothscroll' href='history_trips_global.php?id=$globaluseridsend' title=''>$username</a></li>");
                    echo("<li><a class='smoothscroll' href='globalprofile.php?id=$globaluseridsend' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                else if($y==17){
                    echo("<li><a class='smoothscroll' href='all_trips_global.php?id=$globaluseridsend' title=''>$username</a></li>");
                    echo("<li><a class='smoothscroll' href='globalprofile.php?id=$globaluseridsend' title=''>Back</a></li>");
					echo("<li><a class='smoothscroll' href='logout.php' title=''>Logout</a></li>");
                }
                ?>

                
                
            </ul>
        </nav>

    </div> <!-- / row -->

</header>


<script>
// Sticky Header

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