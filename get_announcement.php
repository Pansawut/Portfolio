<?php 
require ("connection.php");

$type = $_POST["type"];
$version = $_POST["version"];
$user_id = $_POST["user_id"];

$strSQL = "SELECT msg_text FROM notifications WHERE case_num = '$version' AND member_num = '$user_id' ";
$result = $conn->query($strSQL);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
// Return results as json encoded array
echo json_encode($data);

mysqli_close($conn);

?>