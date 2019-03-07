<?php

include 'connection.php';
include 'cipher.php';
include 'PHPMailer/message.php';
include 'PHPMailer/mail.php';

if (isset($_POST['Login'])) {
    $updatetrips = "UPDATE trips set stat=1 WHERE date_time < now()";
    $updatetripsresult = mysqli_query($conn,$updatetrips);

    $username =  $_POST['username'];    
    $password =  $_POST['password'];    
    $password = sha1($password);
    
    $result = mysqli_query($conn,"SELECT * FROM users WHERE username='" . $username . "' and password = '". $password."'");
    while($row1 = mysqli_fetch_array($result)){
        $email =  $row1['email_id'];
    }
	$count  = mysqli_num_rows($result);
	if($count==0) {
        $message = "Invalid Username or Password!";
        header('Location: login.php'); 
        } 
        else 
        {
                echo $email;
                $message = "You are successfully authenticated!";
                        // Starting session
                session_start();
                
                $_SESSION['toastr'] = array(
                        'type'      => 'success', // or 'success' or 'info' or 'warning'
                        'message' => 'Successfully Logged In!',
                        'title'     => "Let's go for a Trek."
                );

                // Storing session data
                $_SESSION["email"] = $email;
                header('Location: profilepage.php'); 
	}
}


if (isset($_POST['Signup'])) {
    $email =  $_POST['email'];    
    $username =  $_POST['username'];    
    $contact = $_POST['contact'];    
    $result5 = mysqli_query($conn,"SELECT email_id FROM users WHERE email_id='" . $email . "'");
    
    $count5 = mysqli_num_rows($result5);
    if($count5>0){
        echo "<script>
                alert('Already Registerd');
                window.location.href='login.php';
                </script>";
    }
    
    else{
        $password =  $_POST['password'];    
         $retyped_password = $_POST['retype_password'];    
        if(!($password===$retyped_password)){
                echo "<script>
                        alert('Please Enter Same Password');
                        window.location.href='login.php';
                        </script>";
        }
        else{
                $password = sha1($password);
                
                $otp = cipher($password);
                $otp1 = cipher1($password);
                
                $query1="INSERT INTO `users`(`userid`,`username`, `fname`, `lname`, `contact`, `email_id`, `password`, `gender`, `dob`, `last_active`, `adress`, `adhaar_card`, `stat`, `locality`, `profile_pic`, `sstate`, `zip`, `ADN`, `ADP`, `cover_pic`)
                 VALUES ('','$username','','','','$email','$password','','','','','','',0,'','','','','','')";
                $result1 = mysqli_query($conn,$query1);
                // echo $query1;
                
                $query = "SELECT * FROM users WHERE email_id='$email'";
                $result2 = mysqli_query($conn,$query);
                

                
                while($row1 = mysqli_fetch_array($result2)){
                        $userid = $row1['userid'];
                        $useridint = (int)$userid;

                        $result3 = mysqli_query($conn,"INSERT INTO `codes`(`code_id`, `where_to_contact`, `code_generated`, `userid`)VALUES ('','Email','$otp',$useridint)");
                        $result4 = mysqli_query($conn,"INSERT INTO `codes`(`code_id`, `where_to_contact`, `code_generated`, `userid`)VALUES ('','Phone','$otp1',$useridint)");
                        // echo 1;   
                        // // Storing session data
                        email($otp,$email);
                        message($otp1,$contact);
                        
                        echo '<script type="text/javascript">window.location = "complete_registeration.php"</script>';
                        // echo "<script>window.location.assign('complete_registeration.php')</script>";
                        
                }
        }
    }        
    
    
    
    
    
}
if (isset($_POST['complete'])) {
        $email = $_POST["email"];
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $gender =  htmlentities($_POST['gender'], ENT_QUOTES, "UTF-8");
        $gender = substr($gender,0,1);
        $contact = $_POST['contact'];
        $contact = (string)$contact;
        $dob = $_POST['dob'];
        $dob = (string)$dob;
        $desc = $_POST['desc'];
        // $dob = str_replace('/', '-', $dob);
        // $dob = date('Y-m-d', strtotime($dob));
        // $dob = str_replace('', '/', $dob);
        // echo $dob;
        $address = $_POST['address'];
        $address =(string)$address;
        $city = $_POST['city'];
        if(!empty($_FILES['profile']['tmp_name'])){
            
            $profile = addslashes(file_get_contents($_FILES['profile']['tmp_name'])); //SQL Injection defence!
        }
        $ADN = $_POST['ACN'];
        // if(!empty($_FILES['acp']['tmp_name'])){
            
        $ACP = addslashes(file_get_contents($_FILES['acp']['tmp_name'])); //SQL Injection defence!
        // }
        
        
        
        $state = $_POST['state'];
        $state =(string)$state;
        $zip = $_POST['zip'];
        $zip =(string)$zip;

        $code = $_POST['code'];

        $result2 = mysqli_query($conn,"SELECT * FROM users WHERE email_id='" . $email . "'");
        $query3 = "SELECT * FROM codes WHERE userid in (Select userid from users where email_id='$email')";
        $result4 = mysqli_query($conn,$query3);
        
        ECHO $query3;
        
        while($row = mysqli_fetch_array($result4)){     
        
                if($row['code_generated'] == $code){
                        
                              $result3 = mysqli_query($conn,"UPDATE users 
                                        SET fname = '$first_name',
                                         lname = '$last_name',
                                         gender = '$gender',
                                         contact = '$contact',
                                         dob = '$dob',
                                         adress = '$address',
                                         locality = '$city',
                                         profile_pic = '$profile',
                                         description = '$desc',
                                         ADN = '$ADN',
                                         sstate = '$state',
                                         zip = '$zip',
                                         ADP = '$ACP',
                                         stat = 1 
                                        WHERE email_id = '$email'
                                        ");
                $result7 = mysqli_query($conn,"DELETE FROM codes WHERE userid in(Select userid from users where email_id='$email')");
                        
                        header('Location: profilepage.php');                 
                }
                else {
                        echo "
                                <script>
                        alert('Wrong Email Code Entered');
                        window.location.href='complete_registeration.php';
                        </script>";
                }
        }
        

    }
 
if (isset($_POST['More_Info'])) {

        $id = $_POST['id'];
        $cipher1 = sha1($id);
        $cipher2 = sha1($id);
        $cipher3 = sha1($id);
        $cipher4 = sha1($id);
        header('Location: join_trip_actual.php?id='.$cipher1.$cipher2.$cipher3.$cipher4.$id);
}

if (isset($_POST['user_name'])) {
        $username = mysqli_real_escape_string($conn,$_POST["user_name"]);
        $query = "SELECT * FROM users WHERE username = '".$username."'";
        $result = mysqli_query($conn,$query);
        echo mysqli_num_rows($result);

}

if (isset($_POST['code_ajax'])) {
        session_start();
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email_id='$email'";
        $result1 = mysqli_query($conn,$query);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }

        $code = mysqli_real_escape_string($conn,$_POST["code_ajax"]);

        $query = "SELECT * FROM codes WHERE where_to_contact='Email' and userid = '".$useridint."'";
        $result = mysqli_query($conn,$query);

        while($row = mysqli_fetch_array($result)){
                $code_generated = $row['code_generated'];
                if($code_generated==$code){
                        echo(0);
                }
                else{
                        echo(1);
                }
        }
}

if (isset($_POST['contact_ajax'])) {
        session_start();
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email_id='$email'";
        $result1 = mysqli_query($conn,$query);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }

        $code = mysqli_real_escape_string($conn,$_POST["contact_ajax"]);

        $query = "SELECT * FROM codes WHERE where_to_contact='Phone' and userid = '".$useridint."'";
        $result = mysqli_query($conn,$query);

        while($row = mysqli_fetch_array($result)){
                $code_generated = $row['code_generated'];
                if($code_generated==$code){
                        echo(0);
                }
                else{
                        echo(1);
                }
        }
}

if (isset($_POST['requestJoin'])) {
        $tripid = $_POST['tripid'];
        $email1 = $_POST['email'];
        $query = "SELECT * FROM users WHERE email_id = '".$email1."'";
        $result  = mysqli_query($conn,$query);
        $current = date('Y-m-d H:i:s');
        while($row = $result->fetch_assoc()){
                $userid = $row['userid'];
        }

        $query1 = "INSERT INTO `request`(`req_id`, `userid`, `tripid`, `stat`,`requested_when`,`latest_stat`) 
        VALUES ('',$userid,$tripid,0,'$current','$current')";
        $result1  = mysqli_query($conn,$query1);
        if($result1){
                 echo "<script>
                alert('Request For Trek Successfull');
                window.location.href='profilepage.php';
                </script>";
        }
        else{
                echo "<script>
                alert('Some Error Occured, Try Again Later');
                window.location.href='profilepage.php';
                </script>";
        }
        
}

if (isset($_POST['requestJoinagain'])) {
        
        $req_id = $_POST['req_id'];
        $current = date('Y-m-d H:i:s');
        $query = "UPDATE request SET stat=4,latest_stat='$current' WHERE req_id='$req_id'";
        $result = mysqli_query($conn,$query);
        
        if($result){
                 echo "<script>
                alert('Request For Trek Successfull');
                window.location.href='profilepage.php';
                </script>";
        }
        else{
                echo "<script>
                alert('Some Error Occured, Try Again Later');
                window.location.href='join_trip.php';
                </script>";
        }
        
}



if (isset($_POST['Create_Trek'])) {
        $des_id = $_POST['des_id'];
        $email1 = $_POST['email'];
        $cipher1 = sha1($des_id);
        $cipher2 = sha1($des_id);
        $cipher3 = sha1($des_id);
        $cipher4 = sha1($des_id);
        header('Location: create_trip_actual.php?id='.$cipher1.$cipher2.$cipher3.$cipher4.$des_id);
}

if (isset($_POST['createTrek'])) {
        session_start();
        $email = $_SESSION['email'];
        $where_to_meet = $_POST['whereToMeet'];
        $place = $_POST['place'];
        $estimated_cost = $_POST['estimatedCost'];
        $how_to_reach = $_POST['howToReach'];
        $date_of_trek    = $_POST['datepicker'];
        $time = $_POST['timepicker'];
        $time = str_replace(' ', '', $time);
        $time_in_format  = date("H:i:s", strtotime($time));
        $date_in_format = date("Y-m-d", strtotime($date_of_trek));
        $combinedDT = date('Y-m-d H:i:s', strtotime("$date_in_format $time_in_format"));
        $des_id = $_POST['desid'];
        $radio = $_POST['radio'];
        $query = "SELECT * FROM users WHERE email_id='$email'";
        $result1 = mysqli_query($conn,$query);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }
        
        $query1 = "INSERT INTO `trips`(`tripid`, `date_time`, `userid`, `trip_name`, `des_id`, `stat`) 
        VALUES ('','$combinedDT','$useridint','$place','$des_id','0')";
        $result2 = mysqli_query($conn,$query1);
        
        
        
        $current = date('Y-m-d H:i:s');
        
        
        if($result2){
                $query2 = "SELECT LAST_INSERT_ID()";
                $result3 = mysqli_query($conn,$query2);
                while($row2 = mysqli_fetch_array($result3)){
                        $tripid = $row2[0];       
                }
                if($result3){
                        $query3 = "INSERT INTO `describ`(`Desrib`, `tripid`, `createTime`, `where_to_meet`, `time_to_meet`, `estimated_cost`, `how_to_reach`) 
                        VALUES ('','$tripid','','$where_to_meet','$current','$estimated_cost','$how_to_reach')";
                        $result4 = mysqli_query($conn,$query3);
                        if($result4){
                                if($radio){
                                        $relation = "SELECT * FROM friends WHERE userid1 = $useridint or userid2 = $useridint and stat=1";
                                        $result1 = mysqli_query($conn,$relation);
                                        if(mysqli_num_rows($result1) > 0){
                                        while($row = mysqli_fetch_array($result1)){
                                                $userid1 = $row['userid1'];
                                                $userid2 = $row['userid2'];
                                                if($userid1 == $useridint){
                                                $superuser = $userid2;
                                                }
                                                else{
                                                $superuser = $userid1;
                                                }

                                                $invite = "INSERT INTO `request`(`req_id`, `userid`, `tripid`, `stat`,`requested_when`,`latest_stat`) 
                                                VALUES ('',$superuser,$tripid,5,'$current','$current')";
                                                $superresult = mysqli_query($conn,$invite);
                                                if($superresult){
                                                        echo "<script>
                                                        
                                                        alert('Trek Created Successfully');
                                                        window.location.href='profilepage.php';
                                                        </script>";

                                                }
                                                else{
                                                        echo "<script>
                                                        alert('Error Occured');
                                                        window.location.href='profilepage.php';
                                                        </script>";
                        
                                                }
                                        }
                                }
                        }
                        else{
                                echo "<script>
                                alert('Error Occured');
                                window.location.href='profilepage.php';
                                </script>";
                        }
                }
                else{
                        echo "<script>
                        alert('Error Occured');
                        window.location.href='profilepage.php';
                        </script>";
                }
        }
        else{
                echo "<script>
                alert('Error Occured');
                window.location.href='profilepage.php';
                </script>";
                
        }
}
}


if (isset($_POST['accept'])) {
        $current = date('Y-m-d H:i:s');
        $requesteduserid =  $_POST['requesteduserid'];
        $requestedtripid = $_POST['requestedtripid'];
        $userid = $_POST['userid'];
        $req_id = $_POST['req_id'];

        $query = "UPDATE request SET stat=1,latest_stat='$current' WHERE req_id='$req_id'";
        $result = mysqli_query($conn,$query);

        $query1 = "INSERT INTO `people_going_to_trips`(`p_g_t`, `userid`, `tripid`, `initiated`)
         VALUES ('','$requesteduserid','$requestedtripid','$userid')";
        $result1 = mysqli_query($conn,$query1);

        echo "<script>
                alert('Request Accepted');
                window.location.href='requests.php';
                </script>";

}

if (isset($_POST['reject'])) {
        $current = date('Y-m-d H:i:s');
        $requesteduserid =  $_POST['requesteduserid'];
        $requestedtripid = $_POST['requestedtripid'];
        $userid = $_POST['userid'];
        $req_id = $_POST['req_id'];

        $query = "UPDATE request SET stat=2,latest_stat='$current' WHERE req_id='$req_id'";
        $result = mysqli_query($conn,$query);

        echo "<script>
                alert('Request Rejected');
                window.location.href='requests.php';
                </script>";
}

if (isset($_POST['block'])) {
        $current = date('Y-m-d H:i:s');
        $requesteduserid =  $_POST['requesteduserid'];
        $requestedtripid = $_POST['requestedtripid'];
        $userid = $_POST['userid'];
        $req_id = $_POST['req_id'];

        $query = "UPDATE request SET stat=3,latest_stat='$current' WHERE req_id='$req_id'";
        $result = mysqli_query($conn,$query);

        echo "<script>
                alert('User Blocked');
                window.location.href='requests.php';
                </script>";
}

if (isset($_POST['request_again'])) {
        $current = date('Y-m-d H:i:s');
        $requesteduserid =  $_POST['requesteduserid'];
        $requestedtripid = $_POST['requestedtripid'];
        $userid = $_POST['userid'];
        $req_id = $_POST['req_id'];

        $query = "UPDATE request SET stat=4,latest_stat='$current' WHERE req_id='$req_id'";
        $result = mysqli_query($conn,$query);

        echo "<script>
                alert('Requested Again');
                window.location.href='notification.php';
                </script>";
}


if (isset($_POST['invite_accept'])) {
        $current = date('Y-m-d H:i:s');
        $requesteduserid =  $_POST['requesteduserid'];
        $requestedtripid = $_POST['requestedtripid'];
        $userid = $_POST['userid'];
        $req_id = $_POST['req_id'];

        $query = "UPDATE request SET stat=1,latest_stat='$current' WHERE req_id='$req_id'";
        $result = mysqli_query($conn,$query);

        $query1 = "INSERT INTO `people_going_to_trips`(`p_g_t`, `userid`, `tripid`, `initiated`)
         VALUES ('','$requesteduserid','$requestedtripid','$userid')";
        $result1 = mysqli_query($conn,$query1);

        echo "<script>
                alert('Request Accpeted');
                window.location.href='notification.php';
                </script>";

}

if (isset($_POST['invite_reject'])) {
        $current = date('Y-m-d H:i:s');
        $requesteduserid =  $_POST['requesteduserid'];
        $requestedtripid = $_POST['requestedtripid'];
        $userid = $_POST['userid'];
        $req_id = $_POST['req_id'];

        $query = "UPDATE request SET stat=6,latest_stat='$current' WHERE req_id='$req_id'";
        $result = mysqli_query($conn,$query);

        echo "<script>
                alert('Request Rejected');
                window.location.href='notification.php';
                </script>";
}


if (isset($_POST['rejectagain'])) {
        $current = date('Y-m-d H:i:s');
        $requesteduserid =  $_POST['requesteduserid'];
        $requestedtripid = $_POST['requestedtripid'];
        $userid = $_POST['userid'];
        $req_id = $_POST['req_id'];

        $query = "UPDATE request SET stat=7,latest_stat='$current' WHERE req_id='$req_id'";
        $result = mysqli_query($conn,$query);

        echo "<script>
                alert('Request Rejected');
                window.location.href='requests.php';
                </script>";
}

if (isset($_POST['redirect_invites'])) {
        
        echo "<script>
                window.location.href='invites.php';
                </script>";
}

if (isset($_POST['saveupdate'])) {
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact = $_POST['mobile'];
        $address = $_POST['address'];
        $locality = $_POST['locality'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $password = $_POST['password'];
        $password = sha1($password);
        $desc = $_POST['desc'];
        $profile = addslashes(file_get_contents($_FILES['pro']['tmp_name'])); //SQL Injection defence!
        $query = "UPDATE users 
                                        SET fname = '$first_name',
                                         lname = '$last_name',
                                         contact = '$contact',
                                         adress = '$address',
                                         locality = '$locality',
                                         profile_pic = '$profile',
                                         description = '$desc',
                                         sstate = '$state',
                                         zip = '$zip',
                                         password = '$password'
                                        WHERE userid = '$email'
                                        ";
        $result3 = mysqli_query($conn,$query);
        if($result3){
                echo "<script>
                alert('Profile Updated Successfully');
                window.location.href='profilepage.php';
                </script>";
                
        }
        else{
                echo "<script>
                alert('Some Error Occured. Try Again Later...');
                window.location.href='profilepage.php';
                </script>";
                
        }

       
        

}

 if (isset($_POST['acceptrequest'])) {
            $fid = $_POST['id'];
            $sentby = $_POST['sentby'];
            $sentto = $_POST['sentto'];

            $query = "UPDATE friends SET stat=1 where friendid=$fid";
                $result = mysqli_query($conn,$query);

                if($result){
                        echo "<script>
                        alert('Friends Request Accepted');
                        window.location.href='friend_request.php';
                        </script>";       
                }
                else{
                        echo "<script>
                alert('Error Occured');
                window.location.href='friend_request.php';
                </script>";
                }


            
}
 if (isset($_POST['rejectrequest'])) {
            $fid = $_POST['id'];
            $sentby = $_POST['sentby'];
            $sentto = $_POST['sentto'];

            $query = "UPDATE friends SET stat=2 where friendid=$fid";
                $result = mysqli_query($conn,$query);

                if($result){
                        echo "<script>
                        alert('Friends Request Accepted');
                        window.location.href='friend_request.php';
                        </script>";       
                }
                else{
                        echo "<script>
                alert('Error Occured');
                window.location.href='friend_request.php';
                </script>";
                }
            
}
 if (isset($_POST['blockrequest'])) {
            $fid = $_POST['id'];
            $sentby = $_POST['sentby'];
            $sentto = $_POST['sentto'];

            $query = "UPDATE friends SET stat=3 where friendid=$fid";
                $result = mysqli_query($conn,$query);

                if($result){
                        echo "<script>
                        alert('Friends Request Accepted');
                        window.location.href='friend_request.php';
                        </script>";       
                }
                else{
                        echo "<script>
                alert('Error Occured');
                window.location.href='friend_request.php';
                </script>";
                }
}





if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $name = $_REQUEST['term'];
    $sql = "SELECT * FROM users WHERE username LIKE $name ";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
            if($count > 0){
                // Fetch result rows as an associative array
                while($row = $result->fetch_assoc()){
                    echo "<p>" . $row["fname"] . "</p>";
                }
            } 
            else if($count == 0){
                echo "<p>No matches found</p>";
            }

}

if(isset($_REQUEST["viewglobal"])){
    $globalid = $_POST['globalid'];
    $cipher1 = sha1($globalid);
    $cipher2 = sha1($cipher1);
    $cipher3 = sha1($cipher2);
    $cipher4 = sha1($cipher3);
    header('Location: globalprofile.php?id='.$cipher1.$cipher2.$cipher3.$cipher4.$globalid);

}

if(isset($_POST["acceptfriendrequest"]))
{
    $globalid = $_POST['globalid'];
    session_start();
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email_id='$email'";
        $result1 = mysqli_query($conn,$query);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }
        $cipher1 = sha1($globalid);
        $cipher2 = sha1($cipher1);
        $cipher3 = sha1($cipher2);
        $cipher4 = sha1($cipher3);
        $globaluseridsend = $cipher1.$cipher2.$cipher3.$cipher4.$globalid;

        $query1="UPDATE friends set stat=1 WHERE userid1=$globalid and userid2=$useridint";
        $result2 = mysqli_query($conn,$query1);
        if($result2){
                        echo "<script>
                        alert('Friends Request Accepted');
                        window.location.href='globalprofile.php?id=$globaluseridsend'
                        </script>";       
                }
                else{
                        echo "<script>
                alert('Error Occured');
                window.location.href='profilepage.php'
                </script>";
                }


}


if(isset($_POST["rejectfriendrequest"]))
{
    $globalid = $_POST['globalid'];
    session_start();
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email_id='$email'";
        $result1 = mysqli_query($conn,$query);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }
        $cipher1 = sha1($globalid);
        $cipher2 = sha1($cipher1);
        $cipher3 = sha1($cipher2);
        $cipher4 = sha1($cipher3);
        $globaluseridsend = $cipher1.$cipher2.$cipher3.$cipher4.$globalid;

        $query1="UPDATE friends set stat=2 WHERE userid1=$globalid and userid2=$useridint";
        $result2 = mysqli_query($conn,$query1);
        if($result2){
                        echo "<script>
                        alert('Friends Request Rejected');
                        window.location.href='globalprofile.php?id=$globaluseridsend'
                        </script>";       
                }
                else{
                        echo "<script>
                alert('Error Occured');
                window.location.href='profilepage.php'
                </script>";
                }


}

if(isset($_POST["resendfriendrequest"]))
{
    $globalid = $_POST['globalid'];
    session_start();
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email_id='$email'";
        $result1 = mysqli_query($conn,$query);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }
        $cipher1 = sha1($globalid);
        $cipher2 = sha1($cipher1);
        $cipher3 = sha1($cipher2);
        $cipher4 = sha1($cipher3);
        $globaluseridsend = $cipher1.$cipher2.$cipher3.$cipher4.$globalid;

        $query1="UPDATE friends set stat=0 WHERE userid1=$useridint and userid2=$globalid";
        $result2 = mysqli_query($conn,$query1);
        if($result2){
                        echo "<script>
                        alert('Friends Request Resent');
                        window.location.href='globalprofile.php?id=$globaluseridsend'
                        </script>";       
                }
                else{
                        echo "<script>
                alert('Error Occured');
                window.location.href='profilepage.php'
                </script>";
                }


}


if(isset($_POST["sendfirstfriendrequest"]))
{
    $globalid = $_POST['globalid'];
    session_start();
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email_id='$email'";
        $result1 = mysqli_query($conn,$query);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }
        $cipher1 = sha1($globalid);
        $cipher2 = sha1($cipher1);
        $cipher3 = sha1($cipher2);
        $cipher4 = sha1($cipher3);
        $globaluseridsend = $cipher1.$cipher2.$cipher3.$cipher4.$globalid;

        $query1="INSERT INTO friends values('','$useridint','$globalid',0,'$useridint')";
        $result2 = mysqli_query($conn,$query1);
        if($result2){
                        echo "<script>
                        alert('Friends Request sent');
                        window.location.href='globalprofile.php?id=$globaluseridsend'
                        </script>";       
                }
                else{
                        echo "<script>
                alert('Error Occured');
                window.location.href='profilepage.php'
                </script>";
                }


}

if(isset($_POST["friendrequesttorejected"]))
{
    $globalid = $_POST['globalid'];
    session_start();
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email_id='$email'";
        $result1 = mysqli_query($conn,$query);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }
        $cipher1 = sha1($globalid);
        $cipher2 = sha1($cipher1);
        $cipher3 = sha1($cipher2);
        $cipher4 = sha1($cipher3);
        $globaluseridsend = $cipher1.$cipher2.$cipher3.$cipher4.$globalid;

        $query1="UPDATE friends set stat=0,userid1=$useridint,initiated=$useridint,userid2=$globalid WHERE userid1=$globalid and userid2=$useridint";
        $result2 = mysqli_query($conn,$query1);
        if($result2){
                        echo "<script>
                        alert('Friends Request sent');
                        window.location.href='globalprofile.php?id=$globaluseridsend'
                        </script>";       
                }
                else{
                        echo "<script>
                alert('Error Occured');
                window.location.href='profilepage.php'
                </script>";
                }


}

if(isset($_POST["unblock"]))
{
    $globalid = $_POST['globalid'];
    session_start();
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email_id='$email'";
        $result1 = mysqli_query($conn,$query);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }
        $cipher1 = sha1($globalid);
        $cipher2 = sha1($cipher1);
        $cipher3 = sha1($cipher2);
        $cipher4 = sha1($cipher3);
        $globaluseridsend = $cipher1.$cipher2.$cipher3.$cipher4.$globalid;

        $query1="UPDATE friends set stat=0 WHERE userid1=$globalid and userid2=$useridint";
        $result2 = mysqli_query($conn,$query1);
        if($result2){
                        echo "<script>
                        alert('User Unblocked');
                        window.location.href='globalprofile.php?id=$globaluseridsend'
                        </script>";       
                }
                else{
                        echo "<script>
                alert('Error Occured');
                window.location.href='profilepage.php'
                </script>";
                }


}

if(isset($_POST["blockuser"]))
{
    $globalid = $_POST['globalid'];
    session_start();
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email_id='$email'";
        $result1 = mysqli_query($conn,$query);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }
        $cipher1 = sha1($globalid);
        $cipher2 = sha1($cipher1);
        $cipher3 = sha1($cipher2);
        $cipher4 = sha1($cipher3);
        $globaluseridsend = $cipher1.$cipher2.$cipher3.$cipher4.$globalid;

        $query1="UPDATE friends set stat=3 WHERE userid1=$globalid and userid2=$useridint";
        $result2 = mysqli_query($conn,$query1);
        if($result2){
                        echo "<script>
                        alert('User Unblocked');
                        window.location.href='globalprofile.php?id=$globaluseridsend'
                        </script>";       
                }
                else{
                        echo "<script>
                alert('Error Occured');
                window.location.href='profilepage.php'
                </script>";
                }


}


if(isset($_POST["unblockandsendrequest"]))
{
    $globalid = $_POST['globalid'];
    session_start();
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email_id='$email'";
        $result1 = mysqli_query($conn,$query);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }
        $cipher1 = sha1($globalid);
        $cipher2 = sha1($cipher1);
        $cipher3 = sha1($cipher2);
        $cipher4 = sha1($cipher3);
        $globaluseridsend = $cipher1.$cipher2.$cipher3.$cipher4.$globalid;

        $query5="UPDATE friends set stat=0,userid1=$useridint,initiated=$useridint,userid2=$globalid WHERE userid1=$globalid and userid2=$useridint";
        $result2 = mysqli_query($conn,$query5);
        if($result2){
                        echo "<script>
                        alert('User Unblocked and Request Sent');
                        window.location.href='globalprofile.php?id=$globaluseridsend'
                        </script>";       
                }
                else{
                        echo "<script>
                alert('Error Occured');
                window.location.href='profilepage.php'
                </script>";
                }


}





?>