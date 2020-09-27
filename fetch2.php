<?php
session_start();
	include 'templates/db_conn.php';
    if (isset($_POST["action"])) {
	$output='';
	if($_POST['action']=="toname"){
		if($_POST['query']=='employee')
		{

			$output = $_SESSION['employee'];	
		}
		else{
		$collection_intern = $db->intern_document;
		$collection_intern = new MongoDB\Driver\Query(['name'=>$_POST['query']],['limit'=>1]);
			$cursor2 = $conn->executeQuery($db.'.'.'intern_document',$collection_intern);
			$cursor2 = $cursor2->toArray()[0];
			$output = $cursor2->Email;	
		}
	}

	echo $output;
}
?>