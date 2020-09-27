<?php
include 'templates/db_conn.php';
$collections = $db->users;

if (isset($_POST['submit']))
{
   	$cursor = $collections->findOne(["Email"=>$_POST['email'],"Password"=>$_POST['pass']]);
    if($cursor)
    {
    	header("Location: intern_dashboard.php");
    }
    else{
    	header("Location: 404.html");
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/robic2.png"/>
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
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
  <div class="container">
    <a class="navbar-brand" href="#">
          <img src="images/robic2.png" height="50" width="50" alt="logo">
        </a>
        <span style="display: inline; color: #fff; width: 250px;font-weight:bold;">Robic Rufarm <br> <p style="color: #66BB6A;font-size: 13px">Farming Reinvented</p></span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
	<div class="limiter" >
		<div class="container-login100" style="background-image: url('images/agri.jpg');">
			<div class="wrap-login100 p-t-10 p-b-30" style="margin-top:0px">
				<form class="login100-form validate-form" action="" method="POST">
					<div class="login100-form-avatar" style="display:inline; margin-left: 50px" >
						<img src="images/robic2.png" alt="AVATAR">
					</div>
                          <hr style="width: 3px; height: 100px; background: black; border: none;" />
                     
					<span class="login100-form-title p-t-20 p-b-45">
						Robic <br> Rufarm 
						<br>
						<p><font color="#F4511E" size="4" style="font-family:  sans-serif;">Farming Reinvented</font></p>
					</span>

					

					
                      <div class="courses pt-20">
						<a href="Director-log.php" data-wow-duration="1s" data-wow-delay=".3s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Director</a>
					             
						<a href="hod-log.php" data-wow-duration="1s" data-wow-delay=".6s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">HOD</a>
						<a href="faculty-log.php" data-wow-duration="1s" data-wow-delay=".9s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Staff</a>
						<a href="student-log.php" data-wow-duration="1s" data-wow-delay="1.2s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Student
						</a>
						
					</div>

					
                    
					
				</form>
			</div>
		</div>
	</div>
	
	

	
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