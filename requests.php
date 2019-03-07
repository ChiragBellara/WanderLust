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

  



    $query = "select t.tripid,t.userid,t.date_time,t.trip_name,t.des_id, 
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

where r.stat = 0 and t.userid='$userid5' and t.stat=0";

  $result = mysqli_query($conn,$query);


  $query3 = "select t.tripid,t.userid,t.date_time,t.trip_name,t.des_id, 
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

where r.stat = 4 and t.userid='$userid5' and t.stat=0";

  $result3 = mysqli_query($conn,$query3);


  $rowcount = mysqli_num_rows($result);

  


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


while($row = $result->fetch_assoc()){
    $tripid = $row['tripid'];
    $req_id = $row['req_id'];
    $name = $row['fname'].' '.$row['lname'];
    $trip_name = $row['trip_name'];
    $datetime = new DateTime($row['date_time']);
    $month =  $datetime->format('F');
    $day =  $datetime->format('d');
    $year =  $datetime->format('Y');
    $day = ordinal($day);
    $date_display = $day.' '.$month.' '.$year;
    $user_Description = $row['description'];
    $image = $row['picture'];
    $result_image = '<div style="max-width:100%;max-height:100%;background:url(data:image/jpeg;base64,'.base64_encode( $image ).')no-repeat center top; background-size: cover;" class="blog-cover" />';

    $image_pro = $row['profile_pic'];
    if (empty($image_pro)){    
        $result_user = 'background:url(images/default_user.jpg)" class="blog-author"';
    } 
    else{
        $result_user = 'background:url(data:image/jpeg;base64,'.base64_encode( $image_pro ).')';
    }

    $requested_date = new DateTime($row['requested_when']);
        $requested_month =  $requested_date->format('m');
        $requested_day =  $requested_date->format('d');
        $requested_year =  $requested_date->format('Y');
        $requested_date_string = $requested_year.'-'.$requested_month.'-'.$requested_day;

        $current = date('Y-m-d');
        $diff = abs(strtotime($requested_date_string) - strtotime($current));;
        $current_years = floor($diff / (365*60*60*24));
        $current_months = floor(($diff - $current_years * 365*60*60*24) / (30*60*60*24));
        $current_days = floor(($diff - $current_years * 365*60*60*24 - $current_months*30*60*60*24)/ (60*60*24));
    
        $userid = $row['userid'];

        $query1 = "SELECT * from trips WHERE userid=$userid";
        $result1 = mysqli_query($conn,$query1);
        $rowcount1 = mysqli_num_rows($result1);

        $query2 = "SELECT * from people_going_to_trips WHERE userid=$userid";
        $result2 = mysqli_query($conn,$query2);
        $rowcount2 = mysqli_num_rows($result2);


    echo("<div class='blog-container'>");
    
    echo("<div class='blog-header'>");
        echo($result_image);
        echo("<div class='blog-author' >");
            echo("<h3>$name</h3>");
        echo("</div>");
        echo("</div>");
    echo("</div>");

    echo("<div class='blog-body'>");
        echo("<div class='blog-title'>");
        echo("<h1><a href='#'>Requested You To Join You To $trip_name On $date_display</a></h1>");
        echo("</div>");
        echo("<hr style='border-width: 1px 1px 0;
            border-style: solid;
            border-color: #d9d9d9; 
            width: 100%;
            margin-left: auto;
            margin-right: auto;'>");
        echo("<div class='blog-summary'>");
        echo("<p>$user_Description</p>");
        echo("</div>");
    echo("<hr style='border-width: 1px 1px 0;
            border-style: solid;
            border-color: #d9d9d9; 
            width: 100%;
            margin-left: auto;
            margin-right: auto;'>");
        echo("<div class='blog-tags'>");
        echo("<ul>");
            echo("<form action='main.php' method='POST'>");
            echo("<input id='requesteduserid' name='requesteduserid' class='accept' type='hidden' value='$userid'/>");
            echo("<input id='requestedtripid' name='requestedtripid' class='accept' type='hidden' value='$tripid'/>");
            echo("<input id='userid' name='userid' class='accept' type='hidden' value='$userid5'/>");
            echo("<input id='req_id' name='req_id' class='accept' type='hidden' value='$req_id'/>");
            
            
            echo("<input name='view' class='view' style='width:150px;' type='submit' value='View His Profile'/>");
            echo("<input id='accept' name='accept' class='accept' type='submit' value='Accept'/>");
            echo("<input name='reject' class='reject' type='submit' value='Reject'/>");
            echo("<input name='block' class='block' type='submit' value='Block'/>");
            echo("</form>&nbsp&nbsp&nbsp");

        echo("</ul>");
        echo("</div>");
    echo("</div>");
    
    echo("<div class='blog-footer'>");
        echo("<ul>");
        echo("<li class='published-date'>Requested $current_days days ago</li>");
        echo("<li class='comments'><a href='#'>$rowcount1 Treks Created</li>");
        echo("<li class='shares'><a href='#'>$rowcount2 Treks Joined</li>");
        echo("</ul>");
    echo("</div>");

    echo("</div>");
   

}




while($row = $result3->fetch_assoc()){
   

    $tripid = $row['tripid'];
    $req_id = $row['req_id'];
    $name = $row['fname'].' '.$row['lname'];
    $trip_name = $row['trip_name'];
    $datetime = new DateTime($row['date_time']);
    $month =  $datetime->format('F');
    $day =  $datetime->format('d');
    $year =  $datetime->format('Y');
    $day = ordinal($day);
    $date_display = $day.' '.$month.' '.$year;
    $user_Description = $row['description'];
    $image = $row['picture'];
    $result_image = '<div style="max-width:100%;max-height:100%;background:url(data:image/jpeg;base64,'.base64_encode( $image ).')no-repeat center top; background-size: cover;" class="blog-cover" />';

    $image_pro = $row['profile_pic'];
    if (empty($image_pro)){    
        $result_user = 'background:url(images/default_user.jpg)" class="blog-author"';
    } 
    else{
        $result_user = 'background:url(data:image/jpeg;base64,'.base64_encode( $image_pro ).')';
    }

    $requested_date = new DateTime($row['requested_when']);
        $requested_month =  $requested_date->format('m');
        $requested_day =  $requested_date->format('d');
        $requested_year =  $requested_date->format('Y');
        $requested_date_string = $requested_year.'-'.$requested_month.'-'.$requested_day;

        $current = date('Y-m-d');
        $diff = abs(strtotime($requested_date_string) - strtotime($current));;
        $current_years = floor($diff / (365*60*60*24));
        $current_months = floor(($diff - $current_years * 365*60*60*24) / (30*60*60*24));
        $current_days = floor(($diff - $current_years * 365*60*60*24 - $current_months*30*60*60*24)/ (60*60*24));
    
        $userid = $row['userid'];

        $query1 = "SELECT * from trips WHERE userid=$userid";
        $result1 = mysqli_query($conn,$query1);
        $rowcount1 = mysqli_num_rows($result1);

        $query2 = "SELECT * from people_going_to_trips WHERE userid=$userid";
        $result2 = mysqli_query($conn,$query2);
        $rowcount2 = mysqli_num_rows($result2);


    echo("<div class='blog-container'>");
    
    echo("<div class='blog-header'>");
        echo($result_image);
        echo("<div class='blog-author' >");
            echo("<h3>$name</h3>");
        echo("</div>");
        echo("</div>");
    echo("</div>");

    echo("<div class='blog-body'>");
        echo("<div class='blog-title'>");
        echo("<h1><a href='#'>Has Requested Again To Join You To $trip_name On $date_display</a></h1>");
        echo("</div>");
        echo("<hr style='border-width: 1px 1px 0;
            border-style: solid;
            border-color: #d9d9d9; 
            width: 100%;
            margin-left: auto;
            margin-right: auto;'>");
        echo("<div class='blog-summary'>");
        echo("<p>$user_Description</p>");
        echo("</div>");
    echo("<hr style='border-width: 1px 1px 0;
            border-style: solid;
            border-color: #d9d9d9; 
            width: 100%;
            margin-left: auto;
            margin-right: auto;'>");
        echo("<div class='blog-tags'>");
        echo("<ul>");
            echo("<form action='main.php' method='POST'>");
            echo("<input id='requesteduserid' name='requesteduserid' class='accept' type='hidden' value='$userid'/>");
            echo("<input id='requestedtripid' name='requestedtripid' class='accept' type='hidden' value='$tripid'/>");
            echo("<input id='userid' name='userid' class='accept' type='hidden' value='$userid5'/>");
            echo("<input id='req_id' name='req_id' class='accept' type='hidden' value='$req_id'/>");
            
            
            echo("<input name='view' class='view' style='width:150px;' type='submit' value='View His Profile'/>");
            echo("<input id='accept' name='accept' class='accept' type='submit' value='Accept'/>");
            echo("<input name='rejectagain' class='reject' type='submit' value='Reject'/>");
            echo("<input name='block' class='block' type='submit' value='Block'/>");
            echo("</form>&nbsp&nbsp&nbsp");

        echo("</ul>");
        echo("</div>");
    echo("</div>");
    
    echo("<div class='blog-footer'>");
        echo("<ul>");
        echo("<li class='published-date'>Requested $current_days days ago</li>");
        echo("<li class='comments'><a href='#'>$rowcount1 Treks Created</li>");
        echo("<li class='shares'><a href='#'>$rowcount2 Treks Joined</li>");
        echo("</ul>");
    echo("</div>");

    echo("</div>");
   

}





?>
    
</body>
</html>