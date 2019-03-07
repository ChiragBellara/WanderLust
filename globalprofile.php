<?php
session_start();
if (!isset($_SESSION["email"]))
	{
		header("location: index.php");
	}
else{
    function ordinal($num)
  {
    $last=substr($num,-1);
    if( $last>3  or 
        $last==0 or 
        ( $num >= 11 and $num <= 19 ) )
    {
      $ext='th';
    }
    else if( $last==3 )
    {
      $ext='rd';
    }
    else if( $last==2 )
    {
      $ext='nd';
    }
    else 
    {
      $ext='st';
    }
    return $num.$ext;
  }

    $globaluserid = $_GET["id"];
    $globaluserid = substr($globaluserid, 160); 
    include("connection.php");
    $email = $_SESSION["email"];
    $query1 = "SELECT * FROM users WHERE email_id='$email'";
    $result1 = mysqli_query($conn,$query1);

    while($row1 = mysqli_fetch_array($result1)){
            $userid = $row1['userid'];
            $useridint = (int)$userid;
    }


    $result = mysqli_query($conn,"SELECT * FROM users WHERE userid='" . $globaluserid . "'");
    $globalcount = mysqli_num_rows($result);
    if($globalcount == 0){
        echo "<script>
                alert('No Such User');
                window.location.href='searchf.php';
                </script>";
    }
    $row = $result->fetch_assoc();
    
  $image = $row['profile_pic'];
  if (empty($image)){
    $image = "default_user.jpg";
    $result_image = '<img class="photo" src="images/'.$image.'" alt="not Avail">';
  } 
  else{
    $result_image = '<img class="photo" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
  }
  $query2 = "SELECT * FROM trips WHERE userid='$globaluserid'";
  $result2 = mysqli_query($conn,$query2);
  $rowcount = mysqli_num_rows($result2);

  $query3 = "SELECT * FROM people_going_to_trips WHERE userid=$globaluserid and initiated<>$globaluserid";
  $result3 = mysqli_query($conn,$query3);
  $rowcount1 = mysqli_num_rows($result3);
  $nooffriends = "SELECT * FROM friends WHERE userid1 = $globaluserid OR userid2 = $globaluserid AND stat=1";
  $nooffriendsresult = mysqli_query($conn,$nooffriends);
  $friends = mysqli_num_rows($nooffriendsresult);

  $checkrelation = "SELECT * FROM friends WHERE (userid1 = $globaluserid and userid2 = $useridint) OR(userid1 = $useridint and userid2 = $globaluserid)";
  $checkrelationresult = mysqli_query($conn,$checkrelation);
  $checkrelationresultcount = mysqli_num_rows($checkrelationresult);

    if($checkrelationresultcount >0){
        while($resultrow = mysqli_fetch_array($checkrelationresult)){
            
            $stat = $resultrow['stat'];
            
            if($stat ==0){
                $rel = 'awating';
            }
            else if($stat ==1){
                $rel = 'friend';
            }
            else if($stat ==2){
                $rel = 'rejected';
            }
            else if($stat ==3){
                $rel = 'blocked';
            }
            
        }
    }
    else{
        if($globaluserid == $useridint){
                $rel = 'self';
        }
        else{
            $name = $row['fname'];
            $rel = 'notfriend';
        }
        
    }
    
  }
?>



<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>WanderLust</title>
  
  
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600'>
    <link rel="stylesheet" href="profilepage_css.css">
    <link rel="stylesheet" type="text/css" href="css/normal_nav.css">
	  

  
</head>

<body>
  <?php include "navbarmainforglobalprofile.php"; ?>
  <main>
    <div class="row">
      <div class="left col-lg-4">
        <div class="photo-left">

          <?php echo $result_image ;?>
        </div>
        <h4 class="name"><?php echo($row['username']);?></h4>
        <p class="info"></p>
        <p class="info"><?php echo($row['fname'].' '.$row['lname']);?></p>
        <div class="stats row">
          <div class="stat col-xs-4" style="padding-right: 50px;">
            <p class="number-stat"><?php echo($friends); ?></p>
            <p class="desc-stat">Friends</p>
          </div>
          <div class="stat col-xs-4">
            <p class="number-stat"><?php echo($rowcount); ?></p>
            <p class="desc-stat">Created Treks</p>
          </div>
          <div class="stat col-xs-4" style="padding-left: 50px;">
            <p class="number-stat"><?php echo($rowcount1); ?></p>
            <p class="desc-stat">Joined Treks</p>
          </div>
        </div>
        <p class="desc"><?php echo($row['description']);?></p>
        <!-- <div class="social">
          <i class="fa fa-facebook-square" aria-hidden="true"></i>
          <i class="fa fa-twitter-square" aria-hidden="true"></i>
          <i class="fa fa-pinterest-square" aria-hidden="true"></i>
          <i class="fa fa-tumblr-square" aria-hidden="true"></i>
        </div> -->
      </div>
      <div class="right col-lg-8">
        <ul class="nav">
          <?php
          $name = $row['fname'];
          $displaythis = "$name's Trips";
        
          $cipher1 = sha1($globaluserid);
          $cipher2 = sha1($cipher1);
          $cipher3 = sha1($cipher2);
          $cipher4 = sha1($cipher3);
          $globaluseridsend = $cipher1.$cipher2.$cipher3.$cipher4.$globaluserid;
          if($rel ==='friend' or $rel==='self'){
            echo("<li><a style='text-decoration:none; color:#666;' href='all_trips_global.php?id=$globaluseridsend'>$displaythis</a></li>");    
          }
          else{
              echo("<li><a style='text-decoration:none; color:#666;' href='' disabled=disabled>$displaythis</a></li>");
          }
          
          ?>
        </ul>
    <?php
        if($rel ==='friend' or $rel==='self'){
            
                
  $query3 = "select t.tripid,t.userid,t.date_time,t.trip_name,t.des_id, 
  u.userid, u.fname,u.contact,u.email_id,u.locality,u.lname,u.description,u.profile_pic,
  d.createTime,d.where_to_meet,d.time_to_meet,d.estimated_cost,d.how_to_reach,d.tripid,
  des.des_id,des.place,des.locality,des.Height_feet,des.Height_m,des.difficulty,des.season,des.picture,des.desc,
  p.userid,p.tripid,p.p_g_t
  
  from people_going_to_trips p
    left outer join trips t
        on p.tripid = t.tripid
    left outer join users u
        on p.userid=u.userid
    left outer join destination des
        on t.des_id = des.des_id
    left outer join describ d
        on t.tripid = d.tripid

where p.userid='$globaluserid' limit 6";

  $result = mysqli_query($conn,$query3);
  echo("<div class='row gallery'>");
  while($row1 = $result->fetch_assoc()){
    $place = $row1['place'];
    $datetime = new DateTime($row1['date_time']);
    $month =  $datetime->format('F');
    $day =  $datetime->format('d');
    $year =  $datetime->format('Y');
    $day = ordinal($day);
    $date_display = $day.' '.$month.' '.$year;
    $tripid = $row1['tripid'];
    $querypeople = "SELECT * FROM people_going_to_trips Where tripid=$tripid";
    $result5 = mysqli_query($conn,$querypeople);
    $PeopleJoined = mysqli_num_rows($result5);
    $image = $row1['picture'];
    $image = '<img src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';

    
          echo("<div class='col-md-4'>");
              echo("<label>$place</label><br>");
              echo("<label>Was On - $date_display</label><br>");
              echo("<label>People Joined - $PeopleJoined</label><br>");
             echo($image);
		echo("</div>");
	
  }echo("</div>");

        }


        else if($rel === 'rejected'){

   
            echo("<div class='row gallery'>");
                echo("<div class='col-md-4'>");
                    echo("<label>Request Rejected.</label><br>");
                echo("</div>");
            echo("</div>");
        }


        
        else if($rel === 'blocked'){
            echo("<div class='row gallery'>");
                echo("<div class='col-md-4'>");
                    echo("<label>Blocked.</label><br>");
                echo("</div>");
            echo("</div>");
        }
        else if($rel === 'notfriend'){
            echo("<div class='row gallery'>");
                echo("<div class='col-md-4'>");
                    echo("<label>Do You Know $name, Send Friend Request</label><br>");
                echo("</div>");
            echo("</div>");
        }
        else if($rel === 'awating'){
            echo("<div class='row gallery'>");
                echo("<div class='col-md-4'>");
                    echo("<label>Awating For Response.</label><br>");
                echo("</div>");
            echo("</div>");
        }

  
    ?>
  </main>
</div>
  <br><br><br>
  
</body>
</html>

