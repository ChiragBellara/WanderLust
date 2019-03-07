<?php
session_start();
if (!isset($_SESSION["email"]))
	{
		header("location: index.php");
	}
else{
    include("connection.php");
    $email = $_SESSION["email"];
    $des_id = $_GET["id"];
    $des_id = substr($des_id,160); 
    $query="SELECT * FROM destination WHERE des_id='$des_id'";
    $result = mysqli_query($conn,$query);
    
    
  }




  





?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Create Trek</title>
	<!-- Meta tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
    </script>
   
	<link href="wickedpicker.css" rel="stylesheet" type='text/css' media="all" />
    <link rel="stylesheet" href="jquery-ui.css" />
    <link href="css/create_trip_actual.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="css/normal_nav.css">

	<link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700" rel="stylesheet">
    
</head>
<style>

</style>
<body style='    background: url(../images/signup_background.jpg)no-repeat center top;
    background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-attachment: fixed;
'>


<?php
  include "normal_nav.php";
echo("<br><br>");

while($row = $result->fetch_assoc()){
    $place = $row['place'];
    $desc = $row['desc'];
    $locality = $row['locality'];
    $height = $row['Height_feet'].'Ft, '.$row['Height_m'].'M.';
    $difficulty = $row['difficulty'];
    $season = $row['season'];
    $image = $row['picture'];
    $result_image = '<div style="background:url(data:image/jpeg;base64,'.base64_encode( $image ).')no-repeat center top; background-size: cover;" class="left-agileits-w3layouts-img" />';

    
	echo("<h1 style='color:#404040'> Create Trek To $place </h1>");
	echo("<div class='bg-agile'> ");
	echo("<div class='book-appointment'>");
			
			echo("<div class='book-agileinfo-form'>");

				echo("<form action='main.php' method='post' class='form-field' name='form1'>");
					echo("<h2 class='sub-head-w3ls'>Enter Details</h2>");
					
					echo("<div class='main-agile-sectns'>");
						echo("<div class='agileits-btm-spc form-text1'>");
							echo("<input type='text' id='whereToMeet' name='whereToMeet' placeholder='Where To Meet' required=''>");
						echo("</div>");
						echo("<div class='agileits-btm-spc form-text2'>");
							echo("<input type='text' id='estimatedCost' name='estimatedCost' placeholder='Estimated Cost' required=''>");
						echo("</div>");
					echo("</div>");
					echo("<div class='agileits-btm-spc form-text'>");
						echo("<input type='text' id='howToReach' name='howToReach' placeholder='How To Reach' required=''>");
					echo("</div>");
					
					echo("<div class='main-agile-sectns'>");
						echo("<div class='agileits-btm-spc form-text1'>");?>
                            <input style="" id='datepicker' autocomplete="off" name='datepicker' type='text' placeholder='Date of Trek' value='' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = 'mm/dd/yyyy';}' required=''>
                            
						</div>
						<div class='agileits-btm-spc form-text2'>
							<input type='text' autocomplete="off" id='timepicker' name='timepicker' class='timepicker form-control hasWickedpicker' placeholder='Time To Meet' value='' onkeypress='return false;' required=''>
						</div>
					</div>
                    <div class='clear'></div>
                    <?php
					echo("<h6 class='desc'> About $place </h6>");
					echo("<h6 class='desc'>$desc </h6>");
					echo("<div class='main-agile-sectns'>");
						echo("<div class='agileits-btm-spc form-text1'>");
							echo("<input type='text' name='Locality'  value=$locality placeholder='Locality' required='' disabled>");
						echo("</div>");
						echo("<div class='agileits-btm-spc form-text2'>");
							echo("<input type='text' name='height' placeholder='Height' value='$height' required='' disabled>");
						echo("</div>");
					echo("</div>");
					echo("<div class='main-agile-sectns'>");
						echo("<div class='agileits-btm-spc form-text1'>");
							echo("<input type='text' name='Difficulty' placeholder='Difficulty' value='Difficulty- $difficulty' required='' disabled>");
						echo("</div>");
						echo("<div class='agileits-btm-spc form-text2'>");
							echo("<input type='text' name='Season' placeholder='Season' value='Season- $season' required='' disabled>");
						echo("</div>");
					echo("</div>");
					echo("<br>");
					echo("<div class='wthree-text'>");
						echo("<h6>Invite Friends ?</h6>");
						echo("<ul class='radio-w3ls'>");
							echo("<li>");
								echo("<input name ='radio' type='radio' id='1' value='1' required>");
								echo("<label >Yes</label>");
								echo("<div class='check'></div>");
							echo("</li>");
							echo("<li>");
								echo("<input name ='radio' type='radio' id='0' value='0	' required>");
								echo("<label >No</label>");
								echo("<div class='check'>");
									echo("<div class='inside'></div>");
								echo("</div>");
							echo("</li>");
							
						echo("</ul>");
						echo("<div class='clear'></div>");
					echo("</div>");
                    echo("<input type='hidden' value='$des_id' name='desid' />");
                    echo("<input type='hidden' value='$place' name='place' />");
					echo("<input type='submit' name='createTrek'  value='Create Trek!' id='createTrek'>");
					
					echo("<div class='clear'></div>");

					
				echo("</form>");


echo("<br><br>");
			echo("</div>");

		echo("</div>");
		echo($result_image);
			echo("<h3></h3>");
			echo("<ul>");
				echo("<li><span></span></li>");

			echo("</ul>");
			
		echo("</div>");
		
	echo("</div>");
	echo("<br><br><br><br>");

    


}

?>
    <script type="text/javascript" src="js/js/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="js/js/wickedpicker.js"></script>
	
	<script type="text/javascript">
		$('.timepicker').wickedpicker({
			twentyFour: false
		});
	</script>
	
	<script>
		$(function () {
			$("#datepicker,#datepicker1,#datepicker2,#datepicker3").datepicker();
		});
    </script>
    <script src="js/js/jquery-ui.js"></script>
    <script>$( "#datepicker" ).datepicker({ minDate: 0});</script>
    <script>

        
        // $("#estimatedCost").blur(function(){
        //     var bla = $('#estimatedCost').val();
                       
        //         var numbers = /^[0-9]+$/;
        //         if(document.form1.estimatedCost.value.match(numbers))
        //         {
        //             document.form1.estimatedCost.focus();
        //         }
        //         else
        //         {
        //             alert('Please input numeric characters only');
        //             document.getElementById("#Height").onblur = function() {};
        //             document.form1.estimatedCost.focus();
        //         }
            

        // });

        
    </script>

</body>

</html>
