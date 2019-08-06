<?php 
require ('connection.php');

// values to insert
$sessionName = $_POST['sessionName'];
$sessionId = $_POST['sessionId'];
$caseNum = $_POST['caseNum'];
$callType = $_POST['callType'];
$case_topic = $_POST['case_topic'];
$orderNum = $_POST['orderNum'];
$caseCat = $_POST['caseCat'];
$assignedTo = $_POST['assignedTo'];
$priority = $_POST['priority'];
$caseStat = $_POST['caseStat'];
$callbackNum = $_POST['callbackNum'];
$caseUpdateInfo = $_POST['caseUpdateInfo'];

if ($caseNum != '') {
	if($caseStat == "CLOSED"){
		$strSQL = "UPDATE client_cases SET call_type = '$callType', case_topic = '$case_topic', order_num = '$orderNum', 
		category_id = '$caseCat', assigned_to = '$assignedTo', priority = '$priority', status = '$caseStat', 
		callback_number = '$callbackNum', case_info = '$caseUpdateInfo', closed_by = '$sessionId', update_time = NOW()
		 WHERE case_number = '$caseNum'";
		$objQuery = mysqli_query($conn,$strSQL);
	}else{
		$strSQL = "UPDATE client_cases SET call_type = '$callType', case_topic = '$case_topic', order_num = '$orderNum', 
		category_id = '$caseCat', assigned_to = '$assignedTo', priority = '$priority', status = '$caseStat', 
		callback_number = '$callbackNum', case_info = '$caseUpdateInfo', update_time = NOW()
		 WHERE case_number = '$caseNum'";
		$objQuery = mysqli_query($conn,$strSQL);

		$checkNoti = "SELECT * FROM notifications WHERE member_num = '$assignedTo' AND case_num = '$caseNum'";
		$objQuery1 = mysqli_query($conn,$checkNoti);
		$objResult = mysqli_fetch_array($objQuery1);
		if(!$objResult){
			$pushNoti = "INSERT INTO notifications (member_num, msg_text, msg_time, case_num,noti_type) VALUES ('$assignedTo','You were assigned to case #$caseNum by $sessionName', NOW(), '$caseNum','assign')";
			$objQuery2 = mysqli_query($conn,$pushNoti);
		}
	}

	if ($objQuery) {
		$output = json_encode(array('type'=>'success','message' => 'Changes are saved!'));
	}else{
		$output = json_encode(array('type'=>'error', 'message' => 'Oops!, Something is Wrong.'));
	}
	die($output);
}
mysqli_close($conn);
?>