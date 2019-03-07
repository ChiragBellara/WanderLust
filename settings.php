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
                $username = $row5['username'];
                $fname = $row5['fname'];
                $lname = $row5['lname'];
                $description = $row5['description'];
                $contact = $row5['contact'];
                $email_id = $row5['email_id'];
                $adress = $row5['adress'];
                $locality = $row5['locality'];
                $image = $row5['profile_pic'];
                $sstate = $row5['sstate'];
                $zip = $row5['zip'];


                if (empty($image)){
                    $image = "default_user.jpg";
                    $result_image = '<img class="avatar img-circle img-thumbnail" src="images/'.$image.'" alt="not Avail">';
                } 
                else{
                    $result_image =  '<img class = "avatar img-circle img-thumbnail" src="data:image/jpeg;base64,'.base64_encode( $image ).'" required/>';
                }


                
        }

          $query2 = "SELECT * FROM trips WHERE userid='$userid5'";
            $result2 = mysqli_query($conn,$query2);
            $rowcount = mysqli_num_rows($result2);

            $query3 = "SELECT * FROM people_going_to_trips WHERE userid=$userid5 and initiated<>$userid5";
            $result3 = mysqli_query($conn,$query3);
            $rowcount1 = mysqli_num_rows($result3);




    }

?>
    
<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>

<body>
    <?php
  include "normal_nav.php";
  ?><br><br><br><br><br><br>

<?php


?>


<div class="container bootstrap snippet">
    <div class="row">
  		<div class="col-sm-10"><h1><?php echo($username);?></h1></div>
    	
    </div>
    <br><br>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              

      <div class="text-center">
        <?php echo($result_image);?>
        


<form class="form" action="main.php" method="post" id="registrationForm" enctype="multipart/form-data">
        
      </div><br>

               
          <div class="panel panel-default">
            <div class="panel-heading">WanderLust<i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="#">Your Profile</a></div>
          </div>
          
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Activity<i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Friends</strong></span> 125</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Treks Created</strong></span> <?php echo($rowcount);?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Treks Joined</strong></span> <?php echo($rowcount1);?></li>
            <!-- <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li> -->
          </ul> 
               
          
          
        </div><!--/col-3-->
    	<div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Change Details</a></li>
              </ul>

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <br>
                  
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <br>
                              <label for="first_name"><h4>First name</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo($fname);?>" title="enter your first name if any." required>
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6"><br>
                            <label for="last_name"><h4>Last name</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo($lname);?>" title="enter your last name if any." required>
                          </div>
                      </div>

                      <div class="form-group">
                          
                          <div class="col-xs-6"><br>
                            <label for="last_name"><h4>Description</h4></label>
                              <input type="text" class="form-control" name="desc" id="desc" value="<?php echo($description);?>" title="enter your last name if any." required>
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6"><br>
                             <label for="mobile"><h4>Mobile</h4></label>
                              <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo($contact);?>" title="enter your mobile number if any." required>
                              <input type="hidden" class="form-control" name="email" id="email" value="<?php echo($userid5);?>" title="enter your mobile number if any." required>
                          </div>
                      </div>
            
                      <div class="form-group">
                          
                          <div class="col-xs-6"><br>
                              <label for="email"><h4>Address</h4></label>
                              <input type="text" class="form-control" name='address' id="address" value="<?php echo($adress);?>" title="enter a location" required>
                          </div>
                      </div>

                                  <div class="form-group">
                          
                          <div class="col-xs-6"><br>
                              <label for="phone"><h4>Locality</h4></label>
                              <input type="text" class="form-control" name="locality" id="locality" value="<?php echo($locality);?>" title="enter your phone number if any." required>
                          </div>
                      </div>
          

                                  <div class="form-group">
                          
                          <div class="col-xs-6"><br>
                              <label for="phone"><h4>State</h4></label>
                              <input type="text" class="form-control" name="state" id="state" value="<?php echo($sstate);?>" title="enter your phone number if any." required>
                          </div>
                      </div>
          

                                  <div class="form-group">
                          
                          <div class="col-xs-6"><br>
                              <label for="phone"><h4>Zip</h4></label>
                              <input type="text" class="form-control" name="zip" id="zip" value="<?php echo($zip);?>" title="enter your phone number if any." required>
                          </div>
                      </div>
          

                      <div class="form-group">
                          
                          <div class="col-xs-6"><br>
                              <label for="password"><h4>Password</h4></label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="password"  required>
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6"><br>
                            <label for="password2"><h4>Verify</h4></label>
                              <input type="password" class="form-control" name="password2" id="password2" placeholder="re type"  onChange="checkPasswordMatch();" required>
                          </div>
                      </div><br>
                      <div class="col-xs-6"><br>
                            <label for="password2"><h4>Choose Another Profile Picture</h4></label><br>
                              <input type="file" name="pro" placeholder="" value="<?php echo isset($_POST['pro']) ? $_POST['pro'] : '' ?>"/>
                          </div>
                      </div>
                      
                            <br>
                          <div class="registrationFormAlert" id="divCheckPasswordMatch"></div><br>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" id='saveupdate' type="submit" name="saveupdate" ><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                            </div>
                      </div>
                      
              	</form>
              
              <hr>
              
             </div><!--/tab-pane-->
             
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->


<script>
    $(function() {
    $("#password2").keyup(function() {
        var password = $("#password").val();
        if(password == $(this).val()){
            $("#divCheckPasswordMatch").html("Passwords match.");
            $('#saveupdate').attr("disabled",false);
            $("#saveupdate").fadeTo(1000, 1);
            
        }
        else{
            $("#divCheckPasswordMatch").html("Passwords do not match!");
            $('#saveupdate').attr("disabled",true);
            $("#saveupdate").fadeTo(1000, 0.4);
        }
        
    });

});

</script>

</body>
</html>