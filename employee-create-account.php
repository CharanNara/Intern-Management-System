<?php
include 'templates/db_conn.php';
$msg=$err ='';
$name = $em='';
$f=0;
$collections_in = new MongoDB\Driver\BulkWrite();
if (isset($_POST['submit']))
{
	$collections = new MongoDB\Driver\Query(["email"=>$_POST['email']],['limit'=>1]);
	$collection2 = new MongoDB\Driver\Query(["email"=>$_POST['email']],['limit'=>1]);
	$name = $_POST['name'];
	$em = $_POST['email'];
	if($_POST['pass'] == $_POST['repass']){
    $cursor = $conn->executeQuery($db.'.'.'employee_document',$collections);
    $cursor = $cursor->toArray()[0];
    if($cursor)
    {
    	$msg = 'Email ID already exists!';
    }
   else{
   	$cursor2 = $conn->executeQuery($db.'.'.'admin_document',$collection2);
   	$cursor2 = $cursor2->toArray()[0];
   	if($cursor2){
   $admin_emp = $conn->executeQuery($db.'.'.'admin_document',$collection2);
   
   	$collections_in->insert([
    'Name' => $_POST['name'],
    'Email' => $_POST['email'],
    'Password' => $_POST['pass'],
    'phone' => $admin_emp['phone'],
    'role' => $admin_emp['Role'],
    'img_dir_path' =>'',
    'linked_profile' => '',
    'insta_profile' => '',
    'facebook_profile' => '',
    'address' =>'',
    'city' => '',
    'country' => '',
    'pincode' =>'',
    'about' => ''

]);
   	$insertOneResult = $conn->executeBulkWrite($db.'.'.'employee_document',$collections_in);
   	header("Location: employee_login.php?status=success");
     }
     else{
     	$err = 'Sorry! You cannot create account without admin permission';
     	$f=1;
     }
}
  }else{
  	$msg = 'Password Mismatch! Please try again';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Robic Rufarm - Signup</title>
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
         <li class="nav-item">
          <a class="nav-link" href="HomePage.php">Home
                
              </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
	<div class="limiter" >
<?php
if($f==1)
{
?>
<div class="alert alert-danger"><?php echo $err;?></div>
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
                        <span class="login100-form-title p-t-0 p-b-30" style="width: 500px;margin-left: 80px">
						<h4 style="color: grey">Create Account as Employee</h4>
						
						
                            
                            
					</span>
                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Name is required">
						<input class="input100" type="text" name="name" placeholder="Name" value="<?php echo $name;?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Email ID is required">
						<input class="input100" type="text" name="email" placeholder="Email ID" value="<?php echo $em;?>">
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
					<div class="wrap-input100 validate-input m-b-10" data-validate = "Retype Password is required">
						<input class="input100" type="password" name="repass" placeholder="Re-type Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div style="margin-left: 25px;"><font color="red"><?php echo $msg;?></font></div>

					<div class="container-login100-form-btn p-t-10">
						<button type="submit" class="login100-form-btn" name="submit">
							Sign Up
						</button>
					</div>

					
                    
					<div class="text-center w-full" style="margin-top: 20px">
						<a class="txt1" href="employee_login.php">
							<i class="fa fa-long-arrow-left"></i>
							Back to Employee login page?
													
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