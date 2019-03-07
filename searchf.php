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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        
    <style type="text/css">
    body{
        font-family: Arail, sans-serif;
    }
    /* Formatting search box */
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
</style>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    function getStates(value) {
    $.post("ajax.php", {name:value},function(data){
        $("#results").html(data);
    }
    ); 
}
</script>


</head>
<body>
    <?php
  include "normal_nav.php";
  ?><br><br><br><br>
<div class="container">
			<br />
			<br />
			<br />
			<h2 align="center">Search User...</h2><br />
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Search</span>
					<input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
				</div>
			</div>
			<br />
			<div id="result"></div>
		</div>
		<div style="clear:both"></div>
		<br />
		
		<br />
		<br />
		<br />
	</body>
</html>


<script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"ajax.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	}
	
	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();			
		}
	});
});
</script>




