<?php 
session_start();
if (isset($_SESSION["email"]))
{	
		$x=1;
		
}
else{
	$x=0;
}

?>

<!DOCTYPE html>

<html class="no-js" lang="en">
<head>

   <!--- basic page needs
   ================================================== -->
   <meta charset="utf-8">
	<title>WanderLust</title>
	<meta name="description" content="">  
	<meta name="author" content="">

   <!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

 	<!-- CSS
   ================================================== -->
     <?php include 'include_css.php';?>

   <!-- script
   ================================================== -->
   <?php include 'include_js.php';?>
	<link href="toastr/toastr.css" rel="stylesheet"/>

   <!-- favicons
	================================================== -->
	<?php include 'include_favicon.php';?>

</head>

<body id="top">

	<!-- header 
   ================================================== -->
   <header> 

		<div class="header-logo">
			<!-- <a href="index.html">Infinity</a> -->
		</div> 

		<!-- Extending Navbar  -->
		<?php include ('navbar.php');?>

	</header> <!-- end header -->  





   <!-- home
   ================================================== -->
   <section id="home">

   	<div class="overlay"></div>

   	<div class="home-content-table">	
		   <div class="home-content-tablecell">
		   	<div class="row">
		   		<div class="col-twelve">		   			
			  		
			  				<h3 class="animate-intro">Welcome To Your Travel Destination.</h3>
				  			<h1 class="animate-intro">
							WanderLust<br>
				  			</h1>	
				  			<div class="button_link">
					  			<div class="more animate-intro">
					  				<a class="button stroke" href="create_trip.php">
					  					Create Trip</a>
									  <a class="button stroke" href="join_trip.php">
					  					Join Trip</a>
					  			</div>
				  			</div>

			  		</div> <!-- end col-twelve --> 
		   	</div> <!-- end row --> 
		   </div> <!-- end home-content-tablecell --> 		   
		</div> <!-- end home-content-table -->

		<ul class="home-social-list">
	      <li class="animate-intro">
	        	<a href="#"><i class="fa fa-facebook-square"></i></a>
	      </li>
	      <li class="animate-intro">
	        	<a href="#"><i class="fa fa-instagram"></i></a>
	      </li>
	   </ul> 
	   <!-- end home-social-list--> 	
 
		<div class="scrolldown">
			<a href="#portfolio" class="scroll-icon smoothscroll">		
		   	Scroll Down		   	
		   	<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
			</a>
		</div>			
   
   </section> <!-- end home -->


   

   <!-- portfolio
   ================================================== -->
   <section id="portfolio">
   	
   	<div class="intro-wrap">

   		<div class="row narrow section-intro with-bottom-sep animate-this">
	   		<div class="col-twelve">
		   		<h1>Join Trek</h1>  			
		   				
	   		</div>   		
	   	</div> <!-- end row section-intro -->   		

   	</div> <!-- end intro-wrap -->   	

   	<div class="row portfolio-content">
   		<div class="col-twelve">
   			<div id="folio-wrap" class="bricks-wrapper">	
                
				<?php
				include 'connection.php';
				$query = "SELECT * FROM destination ORDER BY RAND() LIMIT 6";
				$result = mysqli_query($conn,$query);
				while($row = mysqli_fetch_array($result)){
					$place = $row['place'];
					$image = $row['picture'];
					$image1 = '<img alt="'.$place.'" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
					$desid = $row['des_id'];
					$cipher1 = sha1($desid);
					$cipher2 = sha1($cipher1);
					$cipher3 = sha1($cipher2);
					$cipher4 = sha1($cipher3);
					$des_id = $cipher1.$cipher2.$cipher3.$cipher4.$desid;
					
					
					$div = '<div class="item-wrap animate-this" data-src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';

					echo("<div class='brick folio-item'>");
	               echo($div);
	                  echo("<a href='$des_id' class='overlay'>");
	                  	echo($image1);
	                     echo("<div class='item-text'>");
	                     	echo("<span class='folio-types'>");
		     					   echo("</span>");
		     					   echo("<h3 class='folio-title'>$place</h3>");
		     					echo("</div>");   
	                  echo("</a>");
                        echo("<a href=$des_id class='details-link' title='details'>");
	                  	echo("<i class='icon-link'></i>");
	                  echo("</a>");
	                  
	               echo("</div>");
						
						echo("<div id='01' class='hide'>");
							echo("<h4>$place</h4>");
						echo("</div>");
	        		echo("</div>");
                
                
				}
				?>
                
                
   				
   			</div> <!-- end folio-wrap -->
   		</div> <!-- end twelve -->
   	</div> <!-- end portfolio-content -->   	

   </section>  <!-- end portfolio -->


    
    <!-- about
   ================================================== -->
   <section id="about">

   	<div class="row about-wrap">
   		<div class="col-full">

   			<div class="about-profile-bg"></div>

				<div class="intro">
					<h3 class="animate-this">About Us</h3>
	   			<p class="lead animate-this"><span>WanderLust</span> is a platform for solo trekkers, Travel enthusiast. Meet new people and Keep Travelling</p>	
				</div>   

   		</div> <!-- end col-full  -->
   	</div> <!-- end about-wrap  -->

   </section> <!-- end about -->


   <!-- about
   ================================================== -->
    
    
   <!-- Testimonials Section
   ================================================== -->
   <section id="testimonials">

   	<div class="row">
   		<div class="col-twelve">
   			<h2 class="animate-this">What They Say About Us.</h2>
   		</div>   		
   	</div>   	

      <div class="row flex-container">
    
         <div id="testimonial-slider" class="flex-slider animate-this">

            <ul class="slides">

               <li>
                  <p>
                    Best Travel Destination Every
                  </p> 

                  <div class="testimonial-author">
                    	<!-- <img src="images/avatars/user-02.jpg" alt="Author image"> -->
                    	<div class="author-info">
                    		Pooja Ma'am
                    	</div>
                  </div>                 
             	</li> <!-- end slide -->

               <li>
                  <p>
                  Met new friends, Was Awesome
                  </p>

               	<div class="testimonial-author">
                    	<!-- <img src="images/avatars/user-03.jpg" alt="Author image"> -->
                    	<div class="author-info">
                    		Chirag
                    	</div>
                  </div>                                         
               </li> <!-- end slide -->

            </ul> <!-- end slides -->

         </div> <!-- end testimonial-slider -->         
        
      </div> <!-- end flex-container -->

   </section> <!-- end testimonials -->


	<!-- stats
   ================================================== -->
  


	<!-- contact
   ================================================== -->
   <section id="contact">

      <div class="overlay"></div>

		<div class="row narrow section-intro with-bottom-sep animate-this">
   		<div class="col-twelve">
   			<h3>Contact</h3>
   			<h1>Get In Touch.</h1>
   		</div> 
   	</div> <!-- end section-intro -->

   	<div class="row contact-content">

   		

         <div class="col-four tab-full contact-info end animate-this">

         	<h5>Contact Information</h5>

         	<div class="cinfo" style="display: inline-block">
	   			<h6>Where to Find Us</h6>
	   			<p>
	            	<b>Rajpreet Singh</b><br>
	            	2016.rajpreetsingh.bhengura@ves.ac.in<br>
	   
                    <b>Chirag Bellara</b> <br>
				   	CB@gmail.com	<br>		     
				   
                    <b>Riya A</b><br>
				   	Riya@gmail.com<br>
				   </p>
	   		

         </div> <!-- end cinfo --> 

   	</div> <!-- end row contact-content -->
		
	</section> <!-- end contact -->


	<!-- footer
   ================================================== -->
	<?php include 'footer.php';?>

   <!--Bottom script
   ================================================== -->
   <?php include 'include_bottom_js.php';?>
	<script src="toastr/toastr.js"></script>
   <!-- <script type = "text/javascript" language = "javascript">

	$('#login').click(function(){
   		window.location.href='login_page.php';
})
</script> -->



</body>

</html>