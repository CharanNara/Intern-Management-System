<?php
include 'templates/db_conn.php';
$collectionemp = new MongoDB\Driver\BulkWrite();
$month = date('m');
$day = date('d');
$year = date('Y');
$today = $year . '-' . $month . '-' . $day;
$target_dir = "intern_taskfiles_upload/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
   
   $collectionemp->update(
    ['intern_email' => $_GET['who'],'task_date'=>$today],
    ['$push' => ['task_file_path' => [$target_file]]],['multi' => false, 'upsert' => false]
);
   $updateResult = $conn->executeBulkWrite($db.'.'.'intern_task_details',$collectionemp);
   $status = 1;
}