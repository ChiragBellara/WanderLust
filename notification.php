<?php 
session_start();
if (!isset($_SESSION["email"]))
	{
		header("location: index.php");
	}
else{
    
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
  $query5 = "SELECT * FROM users WHERE email_id = '".$email."'";
        $result5  = mysqli_query($conn,$query5);
        while($row5 = $result5->fetch_assoc()){
                $userid5 = $row5['userid'];
        }


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

  


  


}
  
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Notifications</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/normal_nav.css">
    <link rel="stylesheet" type="text/css" href="css/requests.css">
    <link rel="stylesheet" type="text/css" href="css/notification.css">
</head>
<body>
<?php
  include "normal_nav.php";
  ?><br><br><br><br><br>
<?php

$query1 = "select t.tripid,t.userid,t.date_time,t.trip_name,t.des_id, 
  u.userid, u.fname,u.contact,u.email_id,u.locality,u.lname,u.description,u.profile_pic,
  d.createTime,d.where_to_meet,d.time_to_meet,d.estimated_cost,d.how_to_reach,d.tripid,
  des.des_id,des.place,des.locality,des.Height_feet,des.Height_m,des.difficulty,des.season,des.picture,des.desc,
  r.userid,r.tripid,r.stat,r.requested_when,r.req_id
  
  from request r
    left outer join trips t
        on r.tripid = t.tripid
    left outer join users u
        on r.userid=u.userid
    left outer join destination des
        on t.des_id = des.des_id
    left outer join describ d
        on t.tripid = d.tripid

where r.userid='$userid5' and r.stat=2";

  $result1 = mysqli_query($conn,$query1);



while($row1 = $result1->fetch_assoc()){

    $query5 = "SELECT * FROM users WHERE email_id = '".$email."'";
        $result5  = mysqli_query($conn,$query5);
        while($row5 = $result5->fetch_assoc()){
                $userid5 = $row5['userid'];
        }


    $tripid = $row1['tripid'];
    $req_id = $row1['req_id'];
    $userid = $row1['userid'];

    $palce = $row1['place'];
    $image = $row1['picture'];
    $result_image = '<img class="photo" src="data:image/jpeg;base64,'.base64_encode( $image ).'" height="420" width="327"/>';

    $datetime = new DateTime($row1['date_time']);
    $month =  $datetime->format('F');
    $day =  $datetime->format('d');
    $year =  $datetime->format('Y');
    $day = ordinal($day);
    $date_display = $day.' '.$month.' '.$year;

$queryname = "SELECT * from users WHERE userid in(SELECT userid from trips WHERE tripid in(SELECT tripid from request WHERE req_id=$req_id))";
$resultname = mysqli_query($conn,$queryname);


while($row6 = $resultname->fetch_assoc()){
    $username = $row6['username'];
    $name = $row6['fname'].' '.$row6['lname'];
}


    echo("<form action='main.php' method='POST'>");
     echo("<div class='wrapper'>");
     echo("<div class='product-img'>");
       echo($result_image);
     echo("</div>");
     echo("<div class='product-info'>");
       echo("<div class='product-text'>");
         echo("<h1>$palce</h1>");
         echo("<h2>$date_display</h2>");
         echo("<hr style='border-width: 1px 1px 0;border-style: solid;border-color: #d9d9d9;width:250px'>");
         echo("<p>Your Request Has been Rejected By $name");echo("<br>Username - $username</p>");
       echo("</div>");
       echo("<div class='product-price-btn'><br>");
       echo("<input id='requesteduserid' name='requesteduserid' class='accept' type='hidden' value='$userid'/>");
            echo("<input id='requestedtripid' name='requestedtripid' class='accept' type='hidden' value='$tripid'/>");
            echo("<input id='userid' name='userid' class='accept' type='hidden' value='$userid5'/>");
            echo("<input id='req_id' name='req_id' class='accept' type='hidden' value='$req_id'/>");

         echo("<button name='request_again' type='submit'>Request Again</button>");
       echo("</div>");  
     echo("</div>");
   echo("</div>");
   


}



$query1 = "select t.tripid,t.userid,t.date_time,t.trip_name,t.des_id, 
  u.userid, u.fname,u.contact,u.email_id,u.locality,u.lname,u.description,u.profile_pic,
  d.createTime,d.where_to_meet,d.time_to_meet,d.estimated_cost,d.how_to_reach,d.tripid,
  des.des_id,des.place,des.locality,des.Height_feet,des.Height_m,des.difficulty,des.season,des.picture,des.desc,
  r.userid,r.tripid,r.stat,r.requested_when,r.req_id
  
  from request r
    left outer join trips t
        on r.tripid = t.tripid
    left outer join users u
        on r.userid=u.userid
    left outer join destination des
        on t.des_id = des.des_id
    left outer join describ d
        on t.tripid = d.tripid

where r.userid='$userid5' and r.stat=7";

  $result1 = mysqli_query($conn,$query1);


while($row1 = $result1->fetch_assoc()){

    $query5 = "SELECT * FROM users WHERE email_id = '".$email."'";
        $result5  = mysqli_query($conn,$query5);
        while($row5 = $result5->fetch_assoc()){
                $userid5 = $row5['userid'];
        }


    $tripid = $row1['tripid'];
    $req_id = $row1['req_id'];
    $userid = $row1['userid'];

    $palce = $row1['place'];
    
    $image = $row1['picture'];
    $result_image = '<img class="photo" src="data:image/jpeg;base64,'.base64_encode( $image ).'" height="420" width="327"/>';

    $datetime = new DateTime($row1['date_time']);
    $month =  $datetime->format('F');
    $day =  $datetime->format('d');
    $year =  $datetime->format('Y');
    $day = ordinal($day);
    $date_display = $day.' '.$month.' '.$year;
    $queryname = "SELECT * from users WHERE userid in(SELECT userid from trips WHERE tripid in(SELECT tripid from request WHERE req_id=$req_id))";
$resultname = mysqli_query($conn,$queryname);


while($row6 = $resultname->fetch_assoc()){
    $username = $row6['username'];
    $name = $row6['fname'].' '.$row6['lname'];
}

    echo("<form action='main.php' method='POST'>");
     echo("<div class='wrapper'>");
     echo("<div class='product-img'>");
       echo($result_image);
     echo("</div>");
     echo("<div class='product-info'>");
       echo("<div class='product-text'>");
         echo("<h1>$palce</h1>");
         echo("<h2>$date_display</h2>");
         echo("<hr style='border-width: 1px 1px 0;border-style: solid;border-color: #d9d9d9;width:250px'>");
         echo("<p>Your Request Has been Rejected Once Again By $name ");echo("<br>Username - $username</p>");
       echo("</div>");
       echo("<div class='product-price-btn'><br>");
       echo("<input id='requesteduserid' name='requesteduserid' class='accept' type='hidden' value='$userid'/>");
            echo("<input id='requestedtripid' name='requestedtripid' class='accept' type='hidden' value='$tripid'/>");
            echo("<input id='userid' name='userid' class='accept' type='hidden' value='$userid5'/>");
            echo("<input id='req_id' name='req_id' class='accept' type='hidden' value='$req_id'/>");

         echo("<button name='request_again' type='submit'>Request Again</button>");
       echo("</div>");  
     echo("</div>");
   echo("</div>");
   


}


$query1 = "select t.tripid,t.userid,t.date_time,t.trip_name,t.des_id, 
  u.userid, u.fname,u.contact,u.email_id,u.locality,u.lname,u.description,u.profile_pic,
  d.createTime,d.where_to_meet,d.time_to_meet,d.estimated_cost,d.how_to_reach,d.tripid,
  des.des_id,des.place,des.locality,des.Height_feet,des.Height_m,des.difficulty,des.season,des.picture,des.desc,
  r.userid,r.tripid,r.stat,r.requested_when,r.req_id
  
  from request r
    left outer join trips t
        on r.tripid = t.tripid
    left outer join users u
        on r.userid=u.userid
    left outer join destination des
        on t.des_id = des.des_id
    left outer join describ d
        on t.tripid = d.tripid

where r.userid='$userid5' and r.stat=3";

  $result1 = mysqli_query($conn,$query1);


while($row1 = $result1->fetch_assoc()){

    $query5 = "SELECT * FROM users WHERE email_id = '".$email."'";
        $result5  = mysqli_query($conn,$query5);
        while($row5 = $result5->fetch_assoc()){
                $userid5 = $row5['userid'];
        }


    $tripid = $row1['tripid'];
    $req_id = $row1['req_id'];
    $userid = $row1['userid'];

    $palce = $row1['place'];
    
    $image = $row1['picture'];
    $result_image = '<img class="photo" src="data:image/jpeg;base64,'.base64_encode( $image ).'" height="420" width="327"/>';

    $datetime = new DateTime($row1['date_time']);
    $month =  $datetime->format('F');
    $day =  $datetime->format('d');
    $year =  $datetime->format('Y');
    $day = ordinal($day);
    $date_display = $day.' '.$month.' '.$year;
    $queryname = "SELECT * from users WHERE userid in(SELECT userid from trips WHERE tripid in(SELECT tripid from request WHERE req_id=$req_id))";
$resultname = mysqli_query($conn,$queryname);


while($row6 = $resultname->fetch_assoc()){
    $username = $row6['username'];
    $name = $row6['fname'].' '.$row6['lname'];
}

    echo("<form action='main.php' method='POST'>");
     echo("<div class='wrapper'>");
     echo("<div class='product-img'>");
       echo($result_image);
     echo("</div>");
     echo("<div class='product-info'>");
       echo("<div class='product-text'>");
         echo("<h1>$palce</h1>");
         echo("<h2>$date_display</h2>");
         echo("<hr style='border-width: 1px 1px 0;border-style: solid;border-color: #d9d9d9;width:250px'>");
         echo("<p>You cannot Request For The Following Trek Created by $name");echo("<br>Username - $username</p>");
       echo("</div>");
       echo("<div class='product-price-btn'><br>");
       echo("<input id='requesteduserid' name='requesteduserid' class='accept' type='hidden' value='$userid'/>");
            echo("<input id='requestedtripid' name='requestedtripid' class='accept' type='hidden' value='$tripid'/>");
            echo("<input id='userid' name='userid' class='accept' type='hidden' value='$userid5'/>");
            echo("<input id='req_id' name='req_id' class='accept' type='hidden' value='$req_id'/>");

         echo("<button style='opacity:0.5' name='request_again' type='submit' disabled=disabled>Blocked</button>");
       echo("</div>");  
     echo("</div>");
   echo("</div>");
   


}





$query1 = "select t.tripid,t.userid,t.date_time,t.trip_name,t.des_id, 
  u.userid, u.fname,u.contact,u.email_id,u.locality,u.lname,u.description,u.profile_pic,
  d.createTime,d.where_to_meet,d.time_to_meet,d.estimated_cost,d.how_to_reach,d.tripid,
  des.des_id,des.place,des.locality,des.Height_feet,des.Height_m,des.difficulty,des.season,des.picture,des.desc,
  r.userid,r.tripid,r.stat,r.requested_when,r.req_id
  
  from request r
    left outer join trips t
        on r.tripid = t.tripid
    left outer join users u
        on r.userid=u.userid
    left outer join destination des
        on t.des_id = des.des_id
    left outer join describ d
        on t.tripid = d.tripid

where r.userid='$userid5' and r.stat=1";

  $result1 = mysqli_query($conn,$query1);


while($row1 = $result1->fetch_assoc()){

    $query5 = "SELECT * FROM users WHERE email_id = '".$email."'";
        $result5  = mysqli_query($conn,$query5);
        while($row5 = $result5->fetch_assoc()){
                $userid5 = $row5['userid'];
        }


    $tripid = $row1['tripid'];
    $req_id = $row1['req_id'];
    $userid = $row1['userid'];

    $palce = $row1['place'];
    
    $image = $row1['picture'];
    $result_image = '<img class="photo" src="data:image/jpeg;base64,'.base64_encode( $image ).'" height="420" width="327"/>';

    $datetime = new DateTime($row1['date_time']);
    $month =  $datetime->format('F');
    $day =  $datetime->format('d');
    $year =  $datetime->format('Y');
    $day = ordinal($day);
    $date_display = $day.' '.$month.' '.$year;
    $queryname = "SELECT * from users WHERE userid in(SELECT userid from trips WHERE tripid in(SELECT tripid from request WHERE req_id=$req_id))";
$resultname = mysqli_query($conn,$queryname);


while($row6 = $resultname->fetch_assoc()){
    $username = $row6['username'];
    $name = $row6['fname'].' '.$row6['lname'];
}

    echo("<form action='main.php' method='POST'>");
     echo("<div class='wrapper'>");
     echo("<div class='product-img'>");
       echo($result_image);
     echo("</div>");
     echo("<div class='product-info'>");
       echo("<div class='product-text'>");
         echo("<h1>$palce</h1>");
         echo("<h2>$date_display</h2>");
         echo("<hr style='border-width: 1px 1px 0;border-style: solid;border-color: #d9d9d9;width:250px'>");
         echo("<p>Request Accepted By $name");echo("<br>Username - $username</p>");
       echo("</div>");
       echo("<div class='product-price-btn'><br>");
       echo("<input id='requesteduserid' name='requesteduserid' class='accept' type='hidden' value='$userid'/>");
            echo("<input id='requestedtripid' name='requestedtripid' class='accept' type='hidden' value='$tripid'/>");
            echo("<input id='userid' name='userid' class='accept' type='hidden' value='$userid5'/>");
            echo("<input id='req_id' name='req_id' class='accept' type='hidden' value='$req_id'/>");

         echo("<button style='opacity:0.8' name='request_again' type='submit' disabled=disabled>Happy Trekking</button>");
       echo("</div>");  
     echo("</div>");
   echo("</div>");
   


}




?>
    
</body>
</html>