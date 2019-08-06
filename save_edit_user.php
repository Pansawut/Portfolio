<?php 
require ('connection.php');

// values to insert
$user_id = $_POST['user_id'];
$user_fname = $_POST['user_fname'];
$user_lname = $_POST['user_lname'];
$user_username = $_POST['user_username'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];

if ($user_username != '') {
	$strSQL = "UPDATE members SET fname = '$user_fname', lname = '$user_lname', email = '$user_email', username = '$user_username', password = '$user_password' WHERE user_ids = '$user_id'";
	$objQuery = mysqli_query($conn,$strSQL);

	if ($objQuery) {
		$output = json_encode(array('type'=>'success', 'message' => 'Changes are saved!'));
	}else{
		$output = json_encode(array('type'=>'error', 'message' => 'Oops!, Something is Wrong.'));
	}
	die($output);
}
mysqli_close($conn);
?>