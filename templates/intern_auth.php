<?php
include 'templates/db_conn.php';
$collection_admin = new MongoDB\Driver\Query(['email'=>$_SESSION['intern']],['limit'=>1]);
$cur_auth = $conn->executeQuery($db.'.'.'admin_document',$collection_admin);
if(empty($cur_auth)){
	 if(isset($_SESSION['intern']))
        unset($_SESSION['intern']);

        header("Location: intern_login.php");  
}
?>