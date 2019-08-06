<?php 
require ('connection.php');

// values to insert
$client_id = $_POST['client_id'];
$emp_num = $_POST['userId'];
$callType = $_POST['callType'];
$case_topic = $_POST['case_topic'];
$caseCat = $_POST['caseCat'];
$caseInfo = $_POST['caseInfo'];
$orderNum = $_POST['orderNum'];
$priority = $_POST['priority'];
$callbackNum = $_POST['callbackNum'];
$caseStat = $_POST['caseStat'];
$caseNumber = $_POST['caseNumber'];

// get last id
$strSQL = "SELECT MAX(case_id_ai) FROM client_cases";
$objQuery = mysqli_query($conn,$strSQL);
$objResult = mysqli_fetch_array($objQuery);
$lastId = intval($objResult[0]);
$newId = $lastId + 1;

if($objQuery){
	// insert into case table
	if($caseStat == "CLOSED"){
		$strSQL = "INSERT INTO client_cases (case_number,call_type,case_client_id,case_topic,case_info,category_id,priority,raised_by,order_num,status,callback_number,closed_by,issued_date) VALUES ('$caseNumber-$newId','$callType','$client_id','$case_topic','$caseInfo','$caseCat','$priority','$emp_num','$orderNum','$caseStat','$callbackNum','$emp_num',NOW())";
		$objQuery = mysqli_query($conn,$strSQL);
	}else{
		$strSQL = "INSERT INTO client_cases (case_number,call_type,case_client_id,case_topic,case_info,category_id,priority,raised_by,order_num,status,callback_number,issued_date) VALUES ('$caseNumber-$newId','$callType','$client_id','$case_topic','$caseInfo','$caseCat','$priority','$emp_num','$orderNum','$caseStat','$callbackNum',NOW())";
		$objQuery = mysqli_query($conn,$strSQL);
	}

	if ($objQuery) {
		$output = json_encode(array(
			'type'=>'success', 
			'message' => 'Successfully Create New Case!'
		));
	}else{
		$output = json_encode(array('type'=>'error', 'message' => 'Oops!, Something Has Gone Wrong.'));
	}
	die($output);
}
mysqli_close($conn);
?>