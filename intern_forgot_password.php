<?php
session_start();
//include 'templates/db_conn.php';
$msg='';
$flg = 0;
if(isset($_SESSION['intern']))
{
    header("Location: intern_dashboard.php");
}
$intern_fp ='';
if (isset($_POST['submit']))
{
$intern_coll = new MongoDB\Driver\Query(['Email'=>$_POST['email']],['limit'=1]);
$intern_fp = $_POST['email'];
$cur = $conn->executeQuery($db.'.'.'intern_document',$intern_coll);
$cur = $cur->toArray()[0];
if(empty($cur))
{
	$msg = 'Email ID not found';
}
else{
require '/home/ec2-user/composer/vendor/autoload.php';
$sender = 'myrufarm@gmail.com';
$senderName = 'Robic Rufarm';
$recipient = $_POST['email'];
$usernameSmtp = 'AKIAXIWO5UJJ5LQ3WU62';

// Replace smtp_password with your Amazon SES SMTP password.
$passwordSmtp = 'BLxqdkuzYiIuwSjkBHVvBphywABNmD5EvU+ybOAp/8gK';
//
// // Specify a configuration set. If you do not want to use a configuration
// // set, comment or remove the next line.
//$configurationSet = 'ConfigSet';
$host = 'email-smtp.ap-south-1.amazonaws.com';
$port = 587;

// The subject line of the email
$subject = 'Amazon SES test (SMTP interface accessed using PHP)';

// The plain-text body of the email
$bodyText =  "Email Test\r\nThis email was sent through the
     Amazon SES SMTP interface.";
$bodyHtml = '<h1>Intern Management System (Forgot Password)</h1>
            <p>Good Evening, <br>This message is sent to recover your password that is - '.$cur->password.'. Login again into <a href="http://3.7.242.18/intern_login.php">ims-robicrufarm</a> .</p>';
$mail = new PHPMailer(true);
try {
            $mail->isSMTP();
            $mail->setFrom($sender, $senderName);
            $mail->Username   = $usernameSmtp;
                    $mail->Password   = $passwordSmtp;
                    $mail->Host       = $host;
                        $mail->Port       = $port;
                        $mail->SMTPAuth   = true;
                            $mail->SMTPSecure = 'tls';
                           // $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);
                                // Specify the message recipients.
                            $mail->addAddress($recipient);
                            $mail->isHTML(true);
                                $mail->Subject    = $subject;
                            $mail->Body       = $bodyHtml;
                            $mail->MsgHTML = $bodyText;
                                    $mail->Send();
                                    $popupmsg = 'Email sent!';
                                    $flg = 1;
                                        echo "Email sent!" , PHP_EOL;
} catch (phpmailerException $e) {
	        $popupmsg = "An error occurred. {$e->errorMessage()}";
	        $flg = -1;
            echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
} catch (Exception $e) {
	        $popupmsg = "Email not sent. {$mail->ErrorInfo}";
	        $flg = -1;
            echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Robic Rufarm - Forgot password</title>
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
	<div class="limiter">
		<?php if($flg == 1)
                  {?>
                 <div class="alert alert-success"><b><?php echo $popupmsg;?></b></div>
               <?php }
               elseif ($flg==-1) {
                 ?>
                 <div class="alert alert-danger"><b><?php echo $popupmsg;?></b></div>
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
                        <span class="login100-form-title p-t-0 p-b-30" style="width: 500px;margin-left: 40px">
						<h4 style="color: grey">Recover your forgotten Password</h4>
						
						
                            
                            
					</span>
                    
					<div class="wrap-input100 validate-input m-b-10" data-validate = "Email ID is required">
						<input class="input100" type="text" name="email" placeholder="Email ID" value="<?php echo $intern_fp;?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope"></i>
						</span>
					</div>
					<div class="container-login100-form-btn p-t-10">
						<button type="submit" class="login100-form-btn" name="submit">
							Send Email
						</button>
					</div>

					<div class="text-center w-full" style="margin-top: 20px">
						<a class="txt1" href="intern_login.php">
							<i class="fa fa-long-arrow-left"></i>
							Back to Intern login page?
													
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