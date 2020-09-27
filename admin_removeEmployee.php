<?php
session_start();
if(!isset($_SESSION['admin']))
{
  header("Location: admin_login.php");
}
include 'templates/db_conn.php';
if(isset($_GET['emailid']))
{
$collections = new MongoDB\Driver\BulkWrite();
$collections->delete(['email' => $_GET['emailid']],['limit'=>1]);
$deleteResult = $conn->executeBulkWrite($db.'.'.'admin_document',$collections);
header("Location: admindash_employee.php");
}
?>