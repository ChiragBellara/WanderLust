

<a id="header-menu-trigger" href="#0">
		 	<span class="header-menu-text">Menu</span>
		  	<span class="header-menu-icon"></span>
		</a> 

		<nav id="menu-nav-wrap">

			<a href="#0" class="close-button" title="close"><span>Close</span></a>	

	   	<h3>WanderLust.</h3>  

			<ul class="nav-list">


				<?php if ($x==1)
				{	
					echo("<li class=''><a class='' href='profilepage.php' title=''>Profile</a></li>");
					echo("<li><a class='smoothscroll' href='#portfolio' title=''>Latest treks</a></li>");
					echo("<li><a class='smoothscroll' href='#about' title=''>About</a></li>");
					echo("<li><a class='smoothscroll' href='#testimonials' title=''>Reviews</a></li>");
					echo("<li><a class='smoothscroll' href='#contact' title=''>Contact</a></li>");
					echo("<li><a class='' href='logout.php' title=''>Logout</a></li>");
				}
				else{
					// echo("<li class=''><a class='' href='#home' title=''>Home</a></li>");
					echo("<li><a class='' href='login.php' title=''>Login/Signup</a></li>");
					echo("<li><a class='smoothscroll' href='#portfolio' title=''>Latest treks</a></li>");
					echo("<li><a class='smoothscroll' href='#about' title=''>About</a></li>");
					echo("<li><a class='smoothscroll' href='#testimonials' title=''>Reviews</a></li>");
					echo("<li><a class='smoothscroll' href='#contact' title=''>Contact</a></li>");
				}
				?>

			</ul>	

						

			<ul class="header-social-list">
	         <li>
	         	<a href="#"><i class="fa fa-facebook-square"></i></a>
	         </li>
	         
	         <li>
	         	<a href="#"><i class="fa fa-instagram"></i></a>
	         </li>
	      </ul>		

		</nav>  <!-- end #menu-nav-wrap -->