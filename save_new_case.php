<?php 
require ('connection.php');

// values to insert
$emp_num = $_POST['userId'];
$callType = $_POST['callType'];
$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
$pnumber = trim($_POST['pnumber']);
$case_topic = trim($_POST['case_topic']);
$caseCat = $_POST['caseCat'];
$caseInfo = trim($_POST['caseInfo']);
$orderNum = trim($_POST['orderNum']);
$priority = $_POST['priority'];
$email = trim($_POST['email']);
$callbackNum = trim($_POST['callbackNum']);
$remark = trim($_POST['remark']);
$caseStat = $_POST['caseStat'];
$caseNumber = $_POST['caseNumber'];
$company = $_POST['company'];

// insert into clients if not found existance
$strSQL = "SELECT * FROM clients WHERE client_phone1 = '$pnumber' AND client_fname = '$fname' AND comp_number='$company'";
$objQuery = mysqli_query($conn,$strSQL);
$objResult = mysqli_fetch_array($objQuery);
if($objResult){
	$output = json_encode(array('type'=>'error1', 'message' => 'This Client is Already Existed in Database.'));
	die($output);
}else{
	$strSQL1 = "INSERT INTO clients (client_fname, client_lname, client_phone1, client_email, client_remark, comp_number)
		VALUES ('$fname','$lname', '$pnumber', '$email', '$remark','$company')";
	$objQuery1 = mysqli_query($conn,$strSQL1);

	$strSQL = "SELECT client_ids FROM clients WHERE client_phone1 = '$pnumber' AND client_fname = '$fname'";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$clientId = $objResult[0];

	$strSQL3 = "SELECT MAX(case_id_ai) FROM client_cases";
	$objQuery = mysqli_query($conn,$strSQL3);
	$objResult = mysqli_fetch_array($objQuery);
	$lastId = intval($objResult[0]);
	$newId = $lastId + 1;

	if ($caseStat == "CLOSED") {
		$strSQL2 = "INSERT INTO client_cases (case_number ,call_type, case_client_id, case_topic, case_info, category_id, priority, raised_by, status, callback_number, order_num, closed_by, issued_date) 
		VALUES ('$caseNumber-$newId', '$callType', '$clientId' , '$case_topic', '$caseInfo', '$caseCat', '$priority', '$emp_num', '$caseStat', '$callbackNum', '$orderNum', '$emp_num', NOW())";
		$objQuery2 = mysqli_query($conn,$strSQL2);
	}else{
		$strSQL2 = "INSERT INTO client_cases (case_number ,call_type, case_client_id, case_topic, case_info, category_id, priority, raised_by, status, callback_number, order_num,issued_date) 
		VALUES ('$caseNumber-$newId', '$callType', '$clientId' , '$case_topic', '$caseInfo', '$caseCat', '$priority', '$emp_num', '$caseStat', '$callbackNum', '$orderNum', NOW())";
		$objQuery2 = mysqli_query($conn,$strSQL2);
	}


	if ($objQuery1 & $objQuery2) {
		$output = json_encode(array('type'=>'success', 'message' => 'Successfully Create New Client & Case.'));
	}else if($objQuery1 & !$objQuery2){
		$output = json_encode(array('type'=>'error2', 'message' => 'New Client Created but Case Error, Try again.'));
	}else{
		$output = json_encode(array('type'=>'error3', 'message' => 'Oops, Something Has Gone Wrong In Database.'));
	}
	die($output);
}
mysqli_close($conn);
?>