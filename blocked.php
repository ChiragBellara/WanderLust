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
  $query = "SELECT * FROM users WHERE email_id='$email'";
        $result1 = mysqli_query($conn,$query);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }
    }
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Friends</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/normal_nav.css">
    <link rel="stylesheet" type="text/css" href="css/friend_card.css">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,500,700,200,300' rel='stylesheet' type='text/css'>
</head>
<body>
    <?php
  include "normal_nav.php";
  ?><br><br><br><br>

    <?php

    $query = "SELECT * FROM friends WHERE userid2=$useridint AND stat=3";
    // $query = "SELECT * FROM users WHERE userid in(SELECT userid1 from friends where userid1=$useridint OR userid2=$useridint AND stat=1)";
    $result = mysqli_query($conn,$query);
    while($row = $result->fetch_assoc()){
        $userid1 = $row['userid1'];
        $userid2 = $row['userid2'];
        if($userid1 == $useridint){
            $superuser = $userid2;
        }
        else{
            $superuser = $userid1;
        }
        if($useridint == $superuser){
            
        }
        $query1 = "SELECT * FROM users WHERE userid = $superuser";

        $nooffriends = "SELECT * FROM friends WHERE userid1 = $useridint OR userid2 = $useridint AND stat=1";
        $nooffriendsresult = mysqli_query($conn,$nooffriends);
        $friends = mysqli_num_rows($nooffriendsresult);

        $query2 = "SELECT * FROM trips WHERE userid='$useridint'";
        $result2 = mysqli_query($conn,$query2);
        $rowcount = mysqli_num_rows($result2);


        $result1 = mysqli_query($conn,$query1);
        while($row1 = $result1->fetch_assoc()){
                $globaluserid = $row1['userid'];
                $cipher1 = sha1($globaluserid);
                $cipher2 = sha1($cipher1);
                $cipher3 = sha1($cipher2);
                $cipher4 = sha1($cipher3);
                $globaluseridsend = $cipher1.$cipher2.$cipher3.$cipher4.$globaluserid;
                $image = $row1['profile_pic'];
                if (empty($image)){
                    $image = "default_user.jpg";
                    $result_image = '<img style = "height:100px; border-radius: 25px 1px 25px 1px;" class="photo" src="images/'.$image.'" alt="not Avail">';
                } 
                else{
                    $result_image =  '<img style = "height:100px; border-radius: 25px 1px 25px 1px;" class ="photo" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
                }
                        
                $name = $row1['fname'].' '.$row1['lname'];
            
                echo("<div id='dd' class='wrapper-dropdown-2' tabindex='1' style='background-color: #d9d9d9;width:800px; margin:0 auto; border-radius: 20px'>");
                echo("<div class='grids-left' style = 'height:100px; border-radius: 25px 1px 25px 1px;'>");
                        echo($result_image);
                    echo("</div>");	
                    
                    echo("<div class='grids-right'>");
                        echo("<a href='globalprofile.php?id=$globaluseridsend'><h2>$name</h2></a>");
                        echo("<!--<img src='images/heart.png' />-->");
                    echo("<ul class='grids-right-info'>");
                            echo("<li class='user'> $friends</li>");
                            echo("&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp");
                            echo("<li class='camera'> $rowcount</li>");
                        echo("<div class='clear'> </div>");
                    echo("</ul>");
                    echo("</div>");
                    echo("<div class='clear'> </div>");
                echo("</div>");
                echo("<br><br>");
                
        }

        
    }
    ?>


    
</body>
</html>