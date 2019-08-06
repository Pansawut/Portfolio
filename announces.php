<?php
require("connection.php");

$type = $_POST["type"];
$txt_announce = $_POST["txt_announce"];
$version = $_POST["version"];

$getAllUsers = "SELECT user_ids FROM members;";
$result = mysqli_query($conn, $getAllUsers);
while($row = mysqli_fetch_array($result)){
	if($type == "update"){
		$pushNoti = "INSERT INTO notifications (member_num, msg_text, msg_time,case_num,noti_type) VALUES ('".$row['user_ids']."','$txt_announce', 
		NOW(),'$version','update')";
		$objQuery1 = mysqli_query($conn,$pushNoti);
	}
	if($type == "maintainance"){
		$pushNoti = "INSERT INTO notifications (member_num, msg_text, msg_time,case_num,noti_type) VALUES ('".$row['user_ids']."','$txt_announce', 
		NOW(), '$version','maintainance')";
		$objQuery1 = mysqli_query($conn,$pushNoti);
	}
	if($type = "work"){
		$pushNoti = "INSERT INTO notifications (member_num, msg_text, msg_time,case_num,noti_type) VALUES ('".$row['user_ids']."','$txt_announce',
		NOW(), '$version','work'";
		$objQuery1 = mysqli_query($conn,$pushNoti);
	}
}


if ($objQuery1) {
	$output = json_encode(array('type'=>'success','message' => 'Successfully Announced!'));
}else{
	$output = json_encode(array('type'=>'error', 'message' => 'Oops!, Something is Wrong.'));
}
die($output);
mysqli_close($conn);
?>