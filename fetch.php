<?php
session_start();
include 'templates/db_conn.php';
if (isset($_POST["action"])) {
	$output='';
	if($_POST['action']=="assignto"){
		if($_POST["query"] == "Intern"){
			$collection_intern = new MongoDB\Driver\Query([]);
			$cursor = $conn->executeQuery($db.'.'.'intern_document',$collection_intern);
			 foreach ($cursor as $doc)
                   {
                   	$output.="<option disabled='true' selected='true'>--SELECT--</option>";
                       $output.="<option value='".$doc->name."'>".$doc->name."</option>";
                   }
		}
		elseif ($_POST["query"]=="Yourself") {
            $collection_emp = new MongoDB\Driver\Query(['Email'=>$_SESSION['employee']],['limit'=>1]);
			$cursor3 = $conn->executeQuery($db.'.'.'employee_document',$collection_emp);
			$cursor3 = $cursor3->toArray()[0];
			$output.="<option disabled='true' selected='true'>--SELECT--</option>";
                       $output.="<option value='employee'>".$cursor3->Name."</option>";
		}
	}

	echo $output;
}
?>