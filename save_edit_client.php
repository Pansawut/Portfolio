<?php 
require ('connection.php');

// values to insert
$client_id = $_POST['client_id'];
$edit_fname = $_POST['edit_fname'];
$edit_lname = $_POST['edit_lname'];
$edit_email = $_POST['edit_email'];
$edit_pnum = $_POST['edit_pnum'];
$edit_remark = $_POST['edit_remark'];
$edit_company = $_POST['edit_company'];


if ($edit_fname != '') {
	$strSQL = "UPDATE clients SET client_fname = '$edit_fname', client_lname = '$edit_lname', client_phone1 = '$edit_pnum', client_email = '$edit_email', client_remark = '$edit_remark' , comp_number='$edit_company' WHERE client_ids = '$client_id'";
	$objQuery = mysqli_query($conn,$strSQL);

	$strSQL2 = "SELECT comp_name FROM company WHERE comp_ids='$edit_company'";
	$objQuery2 = mysqli_query($conn,$strSQL2);
	$objResult = mysqli_fetch_array($objQuery2);
	$edit_company_name = $objResult[0];


	if ($objQuery && $objQuery2) {
		$output = json_encode(array('type'=>'success',
		'message' => 'Changes are saved!', 
		'client_phone' => $edit_pnum,
		'client_fname' => $edit_fname,
		'client_lname' => $edit_lname,
		'client_email' => $edit_email,
		'client_remark' => $edit_remark,
		'client_id' => $client_id,
		'edit_company'=> $edit_company,
		'edit_company_name' => $edit_company_name
		));
	}else{
		$output = json_encode(array('type'=>'error', 'message' => 'Oops!, Something is Wrong.'));
	}
	die($output);
}
mysqli_close($conn);
?>