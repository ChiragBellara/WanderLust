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

    $tripid = $_GET["id"];
    $tripid = substr($tripid, 160); 
    include("connection.php");
    $email = $_SESSION["email"];
    
    $query = "select t.tripid,t.userid,t.date_time,t.trip_name,t.des_id,
    u.userid, u.fname,u.contact,u.email_id,u.locality,u.lname,u.username,u.profile_pic,
    d.createTime,d.where_to_meet,d.time_to_meet,d.estimated_cost,d.how_to_reach,d.tripid,d.how_to_reach,
    des.des_id,des.place,des.locality,des.Height_feet,des.Height_m,des.difficulty,des.season,des.picture,des.desc
    
    from trips t 
    left outer join destination des 
    on t.des_id=des.des_id
    left outer join  describ d
    on t.tripid =d.tripid
    left outer join users u
    on t.userid=u.userid 
    
    where t.tripid = '$tripid'";
    
  $result = mysqli_query($conn,$query);

    $query1 = "SELECT * FROM users WHERE email_id='$email'";
    $result1 = mysqli_query($conn,$query1);

    while($row1 = mysqli_fetch_array($result1)){
            $userid = $row1['userid'];
            $useridint = (int)$userid;
    }
    $queryblock = "SELECT * FROM request WHERE tripid = $tripid AND userid = $useridint";
    $resultblock = mysqli_query($conn,$queryblock);
    
    $count = mysqli_num_rows($resultblock);
        if($count > 0){
                while($row2 = $resultblock->fetch_assoc()){
                $stat = $row2['stat'];
                $req_id = $row2['req_id'];
               }
               if($stat == 0){
                    $blocked = 0;
                }
                if($stat == 1){
                    $blocked = 1;
                }
                if($stat == 2){
                    $blocked = 2;
                }
                if($stat == 3){
                    $blocked = 3;
                }
                if($stat == 4){
                    $blocked = 4;
                }
                if($stat == 5){
                    $blocked = 5;
                }
                if($stat == 6){
                    $blocked = 6;
                }
                if($stat == 7){
                    $blocked = 7;
                }


                
        }
        else {
            $blocked = "notrequested";
        }

        $query3 = "SELECT * FROM people_going_to_trips WHERE userid=$useridint and initiated<>$useridint";
        $result3 = mysqli_query($conn,$query3);
        $rowcount1 = mysqli_num_rows($result3);
    
        $nooffriends = "SELECT * FROM friends WHERE userid1 = $useridint OR userid2 = $useridint AND stat=1";
        $nooffriendsresult = mysqli_query($conn,$nooffriends);
        $friends = mysqli_num_rows($nooffriendsresult);
        
          $query2 = "SELECT * FROM trips WHERE userid='$useridint'";
            $result2 = mysqli_query($conn,$query2);
            $rowcount = mysqli_num_rows($result2);

            $query3 = "SELECT * FROM people_going_to_trips WHERE userid=$useridint and initiated<>$useridint";
            $result3 = mysqli_query($conn,$query3);
            $rowcount1 = mysqli_num_rows($result3);
        
            $query8 = "SELECT * FROM people_going_to_trips WHERE tripid=$tripid ";
            $result8 = mysqli_query($conn,$query8);
            $ppl = mysqli_num_rows($result8);


  }
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Join Trip</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="join_trip_actual.css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/normal_nav.css">
</head>
<body>
    <?php
  include "normal_nav.php";
  ?><br><br><br>

<?php
    while($row = $result->fetch_assoc()){

        $image = $row['picture'];
        if (empty($image)){
            $image = "default_user.jpg";
            $result_image = '<img class="photo" src="images/'.$image.'" alt="not Avail">';
        } 
        else{
            $result_image = '<img class="photo" style="height:400px;width:300px" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
        }

        $name = $row['fname'].' '.$row['lname'];
        $globaluserid = $row['userid'];
        $username = $row['username'];
        $placename = $row['place'];
        $datetime = new DateTime($row['date_time']);
        $month =  $datetime->format('F');
        $day =  $datetime->format('d');
        $year =  $datetime->format('Y');
        $day = ordinal($day);
        $date_display = $day.' '.$month.' '.$year;
        $email = $_SESSION["email"];
        $time = $row['date_time'];
        date_default_timezone_set('Asia/Kolkata');
        $currenttime = date("Y-m-d H:i:s");
        if($time < $currenttime){
            $val = 1;
        }
        else{
            $val = 0;
        }

        $relation = "SELECT * FROM friends WHERE (userid1 = $useridint and userid2 = $globaluserid) OR (userid1 = $globaluserid and userid2 = $useridint)";
        $result1 = mysqli_query($conn,$relation);

        if(mysqli_num_rows($result1) > 0){
            while($row1 = mysqli_fetch_array($result1)){
                $stat = $row1['stat'];
                if($stat ==1){
                    $rel = 1;
                }
                else if($stat == 0){
                    $rel = 0;
                }
                else if($stat == 2){
                    $rel = 2;
                }
                else if($stat == 3){
                    $rel = 3;
                }
            }
        }
        else{
            $rel = 99;
        }
        
        echo("<div class='container emp-profile'>");
                echo("<form action='main.php' method='post'>");
                    echo("<div class='row'>");
                        echo("<div class='col-md-4'>");
                            echo("<div class='profile-img'>");
                            echo $result_image;
                                
                            echo("</div>");
                            
                        echo("</div>");
                        echo("<div class='col-md-6'>");
                            echo("<div class='profile-head'>");
                                        echo("<h5>");
                                            echo("$placename");
                                        echo("</h5>");
                                        echo("<h6>");
                                            echo($row['locality']);
                                        echo("</h6>");
                                        echo("<p class='proile-rating'>Difficulty : <span>");echo($row['difficulty']);echo("</span></p>");
                                echo("<ul class='nav nav-tabs' id='myTab' role='tablist'>");
                                    echo("<li class='nav-item'>");
                                        echo("<a class='nav-link active' id='home-tab' data-toggle='tab' href='#home' role='tab' aria-controls='home' aria-selected='true'>Details About Trek</a>");
                                    echo("</li>");
                                echo("</ul>");
                            echo("</div>");
                        echo("</div>");
                        echo("<div class='col-md-2'>");
                        echo("<input type='hidden' value='$tripid' name='tripid'/>");
                        echo("<input type='hidden' value='$email' name='email'/>");
                        if($val)
                        {
                            echo("<input type='submit' style='width:200px' class='profile-edit-btn' name='' value='Trek is Over' disabled=disabled/>");                            
                        }

                        else if($rel == 3){
                            
                            echo("<input type='submit' style='width:200px' class='profile-edit-btn' name='' value='You Are Blocked By User' disabled=disabled/>");
                        }
                        else if($useridint == $row['userid']){
                            
                            echo("<input type='submit' style='width:200px' class='profile-edit-btn' name='' value='It is Your Trek' disabled=disabled/>");
                        }
                        else if($blocked === 0){
                            echo("<input type='submit' style='width:200px' class='profile-edit-btn' name='' value='Requested' disabled=disabled/>");
                        }
                        else if($blocked === 1){
                            echo("<input type='submit' style='width:200px' class='profile-edit-btn' name='' value='You are Going' disabled=disabled/>");
                        }
                        else if($blocked === 2){
                            echo("<input type='hidden'  name='req_id' value='$req_id' />");
                            echo("<input type='submit' style='width:200px' class='profile-edit-btn' name='requestJoinagain' value='Rejected,Request Again' />");
                        }
                        else if($blocked === 3){
                            echo("<input type='submit' style='width:200px' class='profile-edit-btn' name='' value='Blocked for this Trek' disabled=disabled/>");
                        }
                        else if($blocked === 4){
                            echo("<input type='submit' style='width:200px' class='profile-edit-btn' name='' value='Requested Again' disabled=disabled/>");
                        }
                        else if($blocked === 5){
                            echo("<input type='submit' style='width:300px' class='profile-edit-btn' name='redirect_invites' value='You Are Invited, Check Invite Section' />");
                        }
                        else if($blocked === 6){
                            echo("<input type='submit' style='width:200px' class='profile-edit-btn' name='' value='You Rejected Invitation' disabled=disabled/>");
                        }
                        else if($blocked === 7){
                            echo("<input type='hidden'  name='req_id' value='$req_id' />");
                            echo("<input type='submit' style='width:250px' class='profile-edit-btn' name='requestJoinagain' value='Rejected For Second Time'/>");
                        }
                        else if($blocked === 'notrequested'){
                            echo("<input type='submit' style='width:200px' class='profile-edit-btn' name='requestJoin' value='Request Join' />");
                        }
                            
                        echo("</div>");
                    echo("</div>");
                    echo("<div class='row'>");
                        echo("<div class='col-md-4'>");
                            echo("<div class='profile-work'>");
                                
                                echo("<p>User Details</p>");
                                echo("Created By - $name<br/>");
                                echo("Username - $username<br/>");
                                echo("Number Of Friends - $friends<br/>");
                                echo("Number of Treks Initiated - $rowcount<br/>");
                                echo("Number of Treks Joined - $rowcount1<br/>");
                                
                            echo("</div>");
                        echo("</div>");
                        echo("<div class='col-md-8'>");
                            echo("<div class='tab-content profile-tab' id='myTabContent'>");
                                echo("<div class='tab-pane fade show active' id='home' role='tabpanel' aria-labelledby='home-tab'>");
                                            echo("<div class='row'>");
                                                echo("<div class='col-md-6'>");
                                                    echo("<label>Height</label>");
                                                echo("</div>");
                                                echo("<div class='col-md-6'>");
                                                    echo("<p>");
                                                    echo($row['Height_feet']);echo("FT, ");
                                                    echo($row['Height_m']);echo("M");
                                                    echo("</p>");
                                                echo("</div>");
                                            echo("</div>");
                                            echo("<hr>");

                                            echo("<div class='row'>");
                                                echo("<div class='col-md-6'>");
                                                    echo("<label>Season</label>");
                                                echo("</div>");
                                                echo("<div class='col-md-6'>");
                                                    echo("<p>");
                                                    echo($row['season']);
                                                    echo("</p>");
                                                echo("</div>");
                                            echo("</div>");echo("<hr>");




                                            echo("<div class='row'>");
                                                echo("<div class='col-md-6'>");
                                                    echo("<label>Date</label>");
                                                echo("</div>");
                                                
                                                echo("<div class='col-md-6'>");
                                                    echo("<p>");
                                                    echo($date_display);
                                                    echo("</p>");
                                                echo("</div>");
                                            echo("</div>");echo("<hr>");
                                            


                                            



                                            echo("<div class='row'>");
                                                echo("<div class='col-md-6'>");
                                                    echo("<label>Where To Meet</label>");
                                                echo("</div>");
                                                
                                                echo("<div class='col-md-6'>");
                                                    echo("<p>");
                                                    echo($row['where_to_meet']);
                                                    echo("</p>");
                                                echo("</div>");
                                            echo("</div>");echo("<hr>");



                                           echo("<div class='row'>");
                                                echo("<div class='col-md-6'>");
                                                    echo("<label>Time</label>");
                                                echo("</div>");
                                                
                                                echo("<div class='col-md-6'>");
                                                    echo("<p>");
                                                    echo($row['time_to_meet']);
                                                    echo("</p>");
                                                echo("</div>");
                                            echo("</div>");echo("<hr>");



                                            echo("<div class='row'>");
                                                echo("<div class='col-md-6'>");
                                                    echo("<label>How To Reach</label>");
                                                echo("</div>");
                                                
                                                echo("<div class='col-md-6'>");
                                                    echo("<p>");
                                                    echo($row['how_to_reach']);
                                                    echo("</p>");
                                                echo("</div>");
                                            echo("</div>");echo("<hr>");




                                            echo("<div class='row'>");
                                                echo("<div class='col-md-6'>");
                                                    echo("<label>Description About The Place</label>");
                                                echo("</div>");
                                                echo("<div class='col-md-6'>");
                                                    echo("<p>");
                                                    echo($row['desc']);
                                                    echo("</p>");
                                                echo("</div>");
                                            echo("</div>");echo("<hr>");



                                            echo("<div class='row'>");
                                                echo("<div class='col-md-6'>");
                                                echo("    <label>Number Of People Going</label>");
                                                echo("</div>");
                                                echo("<div class='col-md-6'>");
                                                    echo("<p>$ppl</p>");
                                                echo("</div>");
                                            echo("</div>");echo("<hr>");



                                            echo("<div class='row'>");
                                                echo("<div class='col-md-6'>");
                                                    echo("<label>Estimated Cost</label>");
                                                echo("</div>");
                                                echo("<div class='col-md-6'>");
                                                    echo("<p>");
                                                    echo($row['estimated_cost']);
                                                    echo(" Rs </p>");
                                                echo("</div>");
                                            echo("</div>");echo("<hr>");


                                echo("</div>");
                                
                            echo("</div>");
                        echo("</div>");
                    echo("</div>");
                echo("</form>");     
            echo("</div>");

    }



?>

    
</body>
</html>
