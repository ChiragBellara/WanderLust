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

	include("connection.php");
	$email = $_SESSION["email"];
	$name = "";
  $result1 = mysqli_query($conn,"SELECT stat FROM users WHERE email_id='" . $email . "'");
  
  while($row1 = $result1->fetch_assoc()){
    $stat = $row1['stat'];
    if($stat==0){
      header("location: complete_registeration.php");
    }
  }
  
  $result = mysqli_query($conn,"SELECT * FROM users WHERE email_id='" . $email . "'");
  $row = $result->fetch_assoc();
  
  $query1 = "SELECT * FROM users WHERE email_id='$email'";
  $result1 = mysqli_query($conn,$query1);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }
  $query2 = "SELECT * FROM trips WHERE userid='$useridint'";
  $result2 = mysqli_query($conn,$query2);
  $rowcount = mysqli_num_rows($result2);

  $query3 = "SELECT * FROM people_going_to_trips WHERE userid=$useridint and initiated<>$useridint";
  $result3 = mysqli_query($conn,$query3);
  $rowcount1 = mysqli_num_rows($result3);

  $nooffriends = "SELECT * FROM friends WHERE userid1 = $useridint OR userid2 = $useridint AND stat=1";
        $nooffriendsresult = mysqli_query($conn,$nooffriends);
        $friends = mysqli_num_rows($nooffriendsresult);

}


  $image = $row['profile_pic'];
  if (empty($image)){
    $image = "default_user.jpg";
    $result_image = '<img class="photo" src="images/'.$image.'" alt="not Avail">';
  } 
  else{
    $result_image = '<img class="photo" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
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
	  

  
</head>

<body>
  <?php include "navbarmain.php"; ?>
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
          <li><a style="text-decoration:none; color:#666;" href='all_trips.php'>Your Trips</a></li>
          <!-- <li>Collections</li>
          <li>Groups</li>
          <li>About</li> -->
        </ul>
    <?php

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

where p.userid='$useridint' limit 6";

echo("<div class='row gallery'>");
  $result = mysqli_query($conn,$query3);
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
	
  }
echo("</div>");
  
    ?>
  </main>
</div>
  
  
</body>
</html>
