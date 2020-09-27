<?php
session_start();
if(isset($_GET['who']))
{
if($_GET['who']=='intern')
{
 if(isset($_SESSION['intern']))
        unset($_SESSION['intern']);

        header("Location: intern_login.php");  
}
elseif($_GET['who']=='employee')
{
	if(isset($_SESSION['employee']))
		unset($_SESSION['employee']);
    	header("Location: employee_login.php");
}
elseif($_GET['who']=='admin')
{
        if(isset($_SESSION['admin']))
        unset($_SESSION['admin']);
    	header("Location: admin_login.php");
}
}


?>