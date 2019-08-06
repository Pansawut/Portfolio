<?php 
require ('connection.php');

// values to insert
$user_fname = trim($_POST['user_fname']);
$user_lname = trim($_POST['user_lname']);
$user_username = trim($_POST['user_username']);
$user_email = trim($_POST['user_email']);
$user_password = trim($_POST['user_password']);
$user_role = $_POST['user_role'];
$user_comp = $_POST['user_comp_id'];
$user_share1 = $_POST['user_share1'];
$user_share2 = $_POST['user_share2'];
$user_share3 = $_POST['user_share3'];

$strSQL = "SELECT * FROM members WHERE username = '$user_username' AND fname = '$user_fname'";
$objQuery = mysqli_query($conn,$strSQL);
$objResult = mysqli_fetch_array($objQuery);
if($objResult){
	$output = json_encode(array('type'=>'error', 'This Username With This Name is Already Existed in Database.'));
}else{
	$strSQL1 = "INSERT INTO members (username, fname, lname, password, email, role, comp_id) VALUES ('$user_username', '$user_fname', '$user_lname','$user_password','$user_email','$user_role','$user_comp')";
	$objQuery1 = mysqli_query($conn,$strSQL1);

	$strSQL2 = "SELECT MAX(user_ids) FROM members";
	$objQuery = mysqli_query($conn,$strSQL2);
	$objResult = mysqli_fetch_array($objQuery);
	$lastId = $objResult[0];

	$strSQL3 = "INSERT INTO work_on (member_id, comp_workon_id) VALUES ('$lastId','$user_comp')";
	$objQuery3 = mysqli_query($conn,$strSQL3);

	if($user_share1 != ""){
		$strSQL4 = "INSERT INTO work_on (member_id, comp_workon_id) VALUES ('$lastId','$user_share1')";
		$objQuery4 = mysqli_query($conn,$strSQL4);
	}
	if($user_share2 != ""){
		$strSQL5 = "INSERT INTO work_on (member_id, comp_workon_id) VALUES ('$lastId','$user_share2')";
		$objQuery45 = mysqli_query($conn,$strSQL5);
	}
	if($user_share1 != ""){
		$strSQL6 = "INSERT INTO work_on (member_id, comp_workon_id) VALUES ('$lastId','$user_share3')";
		$objQuery6 = mysqli_query($conn,$strSQL6);
	}

	if ($objQuery1) {
		$output = json_encode(array('type'=>'success', 'message' => 'New Account is Created!'));
	}else{
		$output = json_encode(array('type'=>'error', 'message' => 'Oops!, Something is Wrong.'));
	}

	die($output);
}
mysqli_close($conn);

?>