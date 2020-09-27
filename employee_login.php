<?php
session_start();
include 'templates/db_conn.php';
$msg='';
if(isset($_SESSION['employee']))
{
    header("Location: employee_dashboard.php");
}
if (isset($_POST['submit']))
{
	$collections = new MongoDB\Driver\Query(["Email"=>$_POST['email'],"Password"=>$_POST['pass']],['limit'=>1]);
   	$cursor = $conn->executeQuery($db.'.'.'employee_document',$collections);
   	$cursor = $cursor->toArray()[0];
    if($cursor)
    {
    	$_SESSION['employee']=$cursor->Email;
    	header("Location: employee_dashboard.php");
    }
    else{
    	$msg = 'Incorrect Email / Password';
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Robic Rufarm - Login</title>
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
        <span style="display: inline; color: #fff; width: 200px;font-weight:bold;">Robic Rufarm <br> <p style="color: #66BB6A;font-size: 13px">Farming Reinvented</p></span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home
                
              </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
	<div class="limiter" >
		<?php
                  if(isset($_GET['status']))
                  {
			?>
			 <div class="alert alert-success"><b>You have successfully created account!</b> Login here.</div>
			 <?php
                  }
			 ?>
		<div class="container-login100" style="background-image: url('images/agri.jpg');">
			<div class="wrap-login100 p-t-0 p-b-30">
				<form class="login100-form validate-form" action="" method="POST">
					<div class="login100-form-avatar" style="display:inline; margin-left: 50px" >
						<img src="images/robic2.png" alt="AVATAR">
					</div>
                          <hr style="width: 3px; height: 100px; background: black; border: none;" />
                     
					<span class="login100-form-title p-t-20 p-b-30">
						Robic <br> Rufarm 
						<br>
						<p><font color="#F4511E" size="4" style="font-family:  sans-serif;">Farming Reinvented</font></p>
                            

					</span>
                        <span class="login100-form-title p-t-0 p-b-30" style="width: 500px;margin-left: 120px">
						<h4 style="color: grey">Employee Login</h4>
						
						
                            
                            
					</span>
                    
					<div class="wrap-input100 validate-input m-b-10" data-validate = "Email ID is required">
						<input class="input100" type="text" name="email" placeholder="Email ID">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>
					<div style="margin-left: 25px;"><font color="red"><?php echo $msg;?></font></div>

					<div class="container-login100-form-btn p-t-10">
						<button type="submit" class="login100-form-btn" name="submit">
							Login
						</button>
					</div>

					<div class="text-center w-full p-t-20 p-b-10">
						<a href="#" class="txt1">
							Forgot Email / Password?
						</a>
					</div>
                    
					<div class="text-center w-full" style="margin-top: 0px">
						<a class="txt1" href="employee-create-account.php">
							Create new account
							<i class="fa fa-long-arrow-right"></i>						
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