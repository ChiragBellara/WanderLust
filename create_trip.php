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
  
  $result = mysqli_query($conn,"SELECT * FROM destination ");
  $rowcount = mysqli_num_rows($result);
	// $row = $result->mysqli_fetch_all();

}

?>




<!DOCTYPE html>
<html>
<head>
	<title>Trips | WanderLust</title>
	
  <link rel="stylesheet" type="text/css" href="css/normal_nav.css">
  <link rel="stylesheet" type="text/css" href="card.css">
  
</head>
<body >
  <?php
  include "normal_nav.php";
  ?><br><br><br><br><br><br><br><br>
 <?php
 $i=1;
 while($row = $result->fetch_assoc()){
  $des_id = $row['des_id'];
  $image = $row['picture'];

    if($i%2===1){
      echo("<form action='main.php'  method='post'>");
       echo("<div class=blog-card>");
      echo("<div class='meta'>");
      echo '<img class ="photo" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
      // echo("<div class='photo' style='background-image: url($image)'></div>");
      echo("<input type=hidden value='$des_id' name=des_id>");
      echo("<input type='hidden' value='$email' name='email'/>");
      echo("<ul class='details'>");
        echo("<li class='author'>");echo($row['Height_feet']);echo("ft,");
        echo($row['Height_m']);echo("m");echo("</li>");
        echo("<li class='date'>");echo($row['difficulty']);echo("</li>");
        echo("<li class='tags'>");
          echo("<ul>");
            echo("<li>");echo($row['season']);echo("</li>");
          echo("</ul>");
        echo("</li>");
      echo("</ul>");
    echo("</div>");
    echo("<div class='description'>");
      echo("<h1>");echo($row['place']);echo("</h1>");
      echo("<h2>");echo($row['locality']);echo("</h2>");
      $desc = substr($row['desc'], 0, 100);
      echo('<p>');echo($desc);echo("....</p>");
      echo("<p class='read-more'>");
        echo("<input type='submit' style='border-radius:100px; color:#4CAF50; font-size:19px;background-color:white' name='Create_Trek' value='Create Trek'></button>");
        echo("</form>");
      echo("</p>");
    echo("</div>");
  echo("</div>");
      $i++;}
    else if($i%2===0){

      echo("<form action='main.php'  method='post'>");
        echo("<div class='blog-card alt'>");
    echo("<div class='meta'>");
    echo("<input type=hidden value='$des_id' name=des_id>");
    echo("<input type='hidden' value='$email' name='email'/>");
    echo '<img class ="photo" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';  
      // echo("<div class='photo' style='background-image: url(base64_encode( $image ))'></div>");
      echo("<ul class='details'>");
        echo("<li class='author'>");echo($row['Height_feet']);echo("ft,");
        echo($row['Height_m']);echo("m");echo("</li>");
        echo("<li class='date'> ");echo($row['difficulty']);echo("</li>");
        echo("<li class='tags'>");
          echo("<ul>");
            echo("<li>");echo($row['season']);echo("</li>");
          echo("</ul>");
        echo("</li>");
      echo("</ul>");
    echo("</div>");
    echo("<div class='description'>");
      echo("<h1>");echo($row['place']);echo("</h1>");
      echo("<h2>");echo($row['locality']);echo("</h2>");
      $desc = substr($row['desc'], 0, 100);
      echo('<p>');echo($desc);echo("....</p>");
      echo("<p class='read-more'>");
        echo("<input type='submit' style='border-radius:100px; color:#4CAF50; font-size:19px;background-color:white' name='Create_Trek' value='Create Trek'></button>");
        echo("</form>");
      echo("</p>");
    echo("</div>");
  echo("</div>");

      $i++;}




 }
 
 ?>

 


</body>
</html>



  