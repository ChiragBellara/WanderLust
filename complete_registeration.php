<?php 
session_start();
if (!isset($_SESSION["email"]))
	{
		header("location: index.php");
	}
else{
	
  }
?>
<!DOCTYPE html>
<html>
<head>    
<title>Complete Signup</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
<!--css_files-->
	<link rel="stylesheet" href="css/jquery-ui.css"/>
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/><!--stylesheet-->
	<link rel="stylesheet" href="css/font-awesome.css"><!--font_wesome_icons-->
	<link href="//fonts.googleapis.com/css?family=PT+Sans+Caption" rel="stylesheet"><!--online_fonts-->
    <link href="//fonts.googleapis.com/css?family=Old+Standard+TT" rel="stylesheet"><!--online_fonts-->
    <!-- <link rel="stylesheet" type="text/css" href="css/normal_nav.css"> -->
<!--//css_files-->
</head>
<body style="background:url(../images/create_trips_background.jpg)no-repeat 0px 0px;background-size: cover; background-position: 50% 50%;">


<?php
include "normal_nav.php";
?>
<br><br><br><br><br>
<div class="w3ls-form">
	
<form action="main.php" method="post" enctype="multipart/form-data">
		<div class="w3l-last-grid1">
			<div class="w3l-grid1">
				<label class="text">First name</label>
				<div class="w3l-div">
					<i class="fa fa-user" aria-hidden="true"></i>
					<input type="text" name="fname" placeholder="first name" required="" value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : '' ?>"/>
				</div>
			</div> 
			<div class="w3l-grid2">
			<label class="text">Last name</label>
			<div class="w3l-div">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input type="text" name="lname" placeholder="last name" required="" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : '' ?>"/>
			</div>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="w3l-last-grid1">
			<div class="w3l-grid1">
				<label class="text" >gender</label>
				<div class="w3l-div">
					<i class="fa fa-users" aria-hidden="true"></i>
					<select name="gender" class="form-control" required="" value="<?php echo isset($_POST['gender']) ? $_POST['gender'] : '' ?>">
						<option value="male">Select Gender</option>
						<option value="male">Male</option>
						<option value="Female">Female</option>
						<option value="others">Others</option>
					</select>
				</div>
			</div>	
			<div class="w3l-grid2">
				<label class="text">date of birth</label>
				<div class="w3l-div">
					<i class="fa fa-calendar" aria-hidden="true"></i>
					<input type="date" class="date" name="dob" placeholder="dob" required=""/>
				</div>	
			</div>	
			<div class="clear"></div>
		</div>
		
		<div class="w3l-last-grid1">
			<div class="w3l-grid1">
				<label class="text">Your Profile Picture</label>
				<div class="w3l-div">
					<i class="fa fa-picture-o" aria-hidden="true"></i>
					<input type="file" name="profile" value="<?php echo isset($_POST['profile']) ? $_POST['profile'] : '' ?>"/>
				</div>
			</div>

			<div class="w3l-grid2">
				<label class="text">Description About You</label>
				<div class="w3l-div">
					<i class="fa fa-info" aria-hidden="true"></i>
					<input type="text" name="desc" placeholder="" value="<?php echo isset($_POST['desc']) ? $_POST['desc'] : '' ?>"/>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="w3l-last-grid1">
			<div class="w3l-grid1">
				<label class="text">Aadhaar Card Number</label>
				<div class="w3l-div">
					<i class="fa fa-id-card" aria-hidden="true"></i>
					<input type="text" name="ACN" required="" value="<?php echo isset($_POST['ACN']) ? $_POST['ACN'] : '' ?>"/>
				</div>
			</div>

			<div class="w3l-grid2">
				<label class="text">Aadhaar Card Picture</label>
				<div class="w3l-div">
					<i class="fa fa-picture-o" aria-hidden="true"></i>
					<input type="file" name="acp" placeholder="" value="<?php echo isset($_POST['acp']) ? $_POST['acp'] : '' ?>"/>
				</div>
			</div>
			<div class="clear"></div>
		</div>
  
		<div class="w3l-last-grid1">
			<div class="w3l-grid1">	
				<label class="text">address</label>
				<div class="w3l-div">
					<i class="fa fa-location-arrow" aria-hidden="true"></i>
					<input type="text" name="address" placeholder="current address" required="" value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>"/>
				</div>
			</div>
			<div class="w3l-grid2">	
				<label class="text">city</label>
				<div class="w3l-div">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
					<input type="text" name="city" placeholder="city" required="" value="<?php echo isset($_POST['city']) ? $_POST['city'] : '' ?>"/>
				</div>
			</div>
			<div class="clear"></div>
		</div>


		<div class="w3l-right-grid1">
			<div class="w3l-grid1">
				<label class="text">state</label>
				<div class="w3l-div">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
					<input type="text" name="state" placeholder="state/province" required="" value="<?php echo isset($_POST['state']) ? $_POST['state'] : '' ?>"/>
				</div>
			</div>
			<div class="w3l-grid2">
				<label class="text">zipcode</label>
				<div class="w3l-div">
					<i class="fa fa-address-card-o" aria-hidden="true"></i>
					<input type="text" name="zip" placeholder="postal" required="" value="<?php echo isset($_POST['zip']) ? $_POST['zip'] : '' ?>"/>
				</div>
			</div>

            <div class="clear"></div>
            <div class="w3l-grid2">
				<label class="text">Email Code</label>
				<div class="w3l-div">
					<i class="fa fa-key" aria-hidden="true"></i>
					<input type="text" id="code" name="code"  placeholder="code" required=""/>
				</div>
				<span id="avail1"></span>
			</div>
			 <div class="w3l-grid2">
				<label class="text">Mobile OTP</label>
				<div class="w3l-div">
					<i class="fa fa-mobile" aria-hidden="true"></i>
					<input type="text" id="contact" name="contact" placeholder="00000000" required=""/>
				</div>
				<span id="avail2"></span>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="w3ls-submit">
			<input type="hidden" name="email" value="<?php echo($_SESSION['email']);?>"/>
		</div>

		<div class="w3ls-submit">
			<input type="submit" name="complete" id="complete" value="Complete Registeration"/>
		</div>
</form>
</div>



	<script>
		
	
        $(document).ready(function(){
            $('#code').blur(function(){
                var code = $(this).val();

                $.ajax({
                    url:'main.php',
                    method:'POST',
                    data:{code_ajax:code},
                    success:function(data)
                    {
                        if(data != '0'){
                            $('#avail1').html("<span style='color:red;' class='text-danger'>Code Incorrect</span>");
                            $('#complete').attr("disabled",true);
							 $("#complete").fadeTo(1000, 0.4);
							 console.log(data);
                        }
                        else{
                            $('#avail1').html("<span style='color:green;' class='text-success'>Code Correct</span>");
                            $('#complete').attr("disabled",false);
                            $("#complete").fadeTo(1000, 1);
                        }
                    }
                })
            });
		});
		
		        $(document).ready(function(){
            $('#contact').blur(function(){
                var contact = $(this).val();

                $.ajax({
                    url:'main.php',
                    method:'POST',
                    data:{contact_ajax:contact},
                    success:function(data)
                    {
                        if(data != '0'){
                            $('#avail2').html("<span style='color:red;' class='text-danger'>Code Incorrect</span>");
                            $('#complete').attr("disabled",true);
							 $("#complete").fadeTo(1000, 0.4);
							 console.log(data);
                        }
                        else{
                            $('#avail2').html("<span style='color:green;' class='text-success'>Code Correct</span>");
                            $('#complete').attr("disabled",false);
                            $("#complete").fadeTo(1000, 1);
                        }
                    }
                })
            });
		});
		
		


    </script>


<!-- //Calendar -->
</body>
</html>