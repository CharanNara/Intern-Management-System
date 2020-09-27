<?php
include 'templates/db_conn.php';
$collection_admin = new MongoDB\Driver\Query(['email'=>$_SESSION['employee']],['limit'=>1]);
$cur_auth = $conn->executeQuery($db.'.'.'admin_document',$collection_admin);
if(empty($cur_auth)){
	 if(isset($_SESSION['employee']))
        unset($_SESSION['employee']);

        header("Location: employee_login.php");  
}
?>