<?php
if(isset($_POST['submit_admin']))
{
	header("Location: admin_login.php");
}
elseif (isset($_POST['submit_emp'])) {
	header("Location: employee_login.php");
}
elseif (isset($_POST['submit_intern'])) {
	header("Location: intern_login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Robic Rufarm - Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/images/icons/robic2.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/mainupdated.css">
<!--===============================================================================================-->

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top" >
  <div class="container">
    <a class="navbar-brand" href="#">
          <img src="images/robic2.png" height="50" width="50">
        </a>
        <span style="display: inline; color: #fff; width: 200px;font-weight:bold;">Robic Rufarm <br> <p style="color: #66BB6A;font-size: 13px">Farming Reinvented</p></span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#home">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about" >About</a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
    </div>
  </div>

</nav>
<a name="home">

	<div class="limiter" >
		<div class="container-login100" style="background-image: url('images/agri.jpg');">
			<div class="wrap-login100 p-t-0 p-b-30">
				<form class="login100-form validate-form" action="" method="POST">
                          		<div class="login100-form-avatar" style="display:inline-block; text-align:center;" >
						<img src="images/robic2.png" alt="AVATAR">
					</div>
                     
					<span class="login100-form-title p-t-20 p-b-45">
						<p><font color="#FFF" size="6" style="font-family:  sans-serif;">Robic Rufarm</font></p>
						<p><font color="#F4511E" size="5" style="font-family:  sans-serif;">Login as</font></p>
					</span>

			

					
						<button type="submit" class="login100-form-btn" name="submit_admin">
							Admin
						</button>
					
					 
						<button type="submit" class="login100-form-btn" name="submit_intern">
							Intern
 						</button>
					 
						<button type="submit" class="login100-form-btn" name="submit_emp">
							Employee
						</button>
					
					
					
				</form>
			</div>
		</div>
	</div>
</a>
<a name="about">

	<div class="limiter" >
		<div class="container-login100" style="background-image: url('images/agri.jpg');">
<form class="login100-form validate-form" action="" method="POST">
<div class="login100-form-title p-t-50 p-b-0 p-r-50 p-l-50">
<h1><font color="#00008B" size="6" style="font-family:  sans-serif;">ABOUT US</br></font></h1>
</div>
<p style="text-align:justify;width:99%;"></br>
<font color="#FFF" size="4" style="font-family:  sans-serif;">
Lorem ipsum dolor sit amet et delectus accommodare his consul copiosae legendos at vix adputent 
delectus delicata usu.Vidit dissentiet eos cu eum an brute sfjghs
Lorem ipsum dolor sit amet et delectus accommodare his consul copiosae legendos at vix adputent 
delectus delicata usu.Vidit dissentiet eos cu eum an brute sfjghs
 dgidsio doifhdiof dihoidh djohiod jfbiodnnf djfidffijijf dfidhfihd fdhfidjf dfhidjf dhfidf
 dgidsio doifhdiof dihoidh djohiod jfbiodnnf djfidffijijf dfidhfihd fdhfidjf dfhidjf dhfidff i
</font>
</p></br>

</div>

</form>
		</div>

	</div>


</a>

<a name="contact">
	
	<div class="limiter" >
	<div class="container-login100" style="background-image: url('images/agri.jpg');">
	<div class="login100-form-title p-t-50 p-b-0 p-r-50 p-l-50">
		<h1>
		<font color="#00008B" size="6" style="font-family:  sans-serif;">
		CONTACTS US</font></h1>
		</div>


		<form class="login100-form validate-form" action="" method="POST">
                       	
                    <div class="contactcontainer">
		<div class="row">
	<div class="column">
		<span>
						<p><font color="#FFF" size="4" style="font-family:  sans-serif;">Follow us on :</font></p>
					
					</span>

					</br></br>
					<div>
					
						<img src="images/you.jpg" alt="AVATAR" height="35" width="35" shape="circular">

						<img src="images/OIP.jpg" alt="AVATAR" height="35" width="35">

						<img src="images/face.jpg" alt="AVATAR" height="35" width="35">

						<img src="images/link.png" alt="AVATAR" height="35" width="35">
						
						<img src="images/twitter.jpg" alt="AVATAR" height="35" width="35">
	
					</div>	
<span >
						<p><font color="#FFF" size="3" style="font-family:  sans-serif;"></br>Robic Rufarm India Pvt ltd.</font></p>
					
					</span>			
<p>@2020 All rights reserved.</p>
</div>		
<div class="column">
<span >
						<p><font color="#FFF" size="4" style="font-family:  sans-serif;">Follow us on :</font></p>
					
					</span>
<span >
						<p><font color="#FFF" size="3" style="font-family:  sans-serif;"></br></br>Email : info@robicrufarm.com</br>Phone : (+91)-9962938974</br>  (+91)-9642549416</br>  (+91)-9700460051</font></p>
					
					</span>

</div>		
<div class="column">
<span >
						<p><font color="#FFF" size="4" style="font-family:  sans-serif;">Address :</font></p>
					
					</span>
<span >
						<p><font color="#FFF" size="3" style="font-family:  sans-serif;"></br>Robic Rufarm India Pvt Ltd. Plot No. 91 &94,Rajya Lakshmi Nager,Road No.3,above SR Super Mart Hyderabad Telangana 500068 India</font></p>
					
					</span>
</div>		

</div>

</div>
					
					
					
				</form>
				
</div>
</div>
						
</a>


	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>