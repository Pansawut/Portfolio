<?php 
require ('connection.php');

// values to insert
$comp_name = trim($_POST['compName']);

$strSQL = "SELECT * FROM company WHERE comp_name = '".trim($comp_name)."' ";
$objQuery = mysqli_query($conn,$strSQL);
$objResult = mysqli_fetch_array($objQuery);
if(!$objResult)
{
	$strSQL = "INSERT INTO company (comp_name) VALUES ('$comp_name')";
	$objQuery = mysqli_query($conn,$strSQL);

	if ($objQuery) {
		$output = json_encode(array('type'=>'success', 'message' => 'New Company is Created!'));
	}else{
		$output = json_encode(array('type'=>'error', 'message' => 'Oops!, Something is Wrong.'));
	}
	die($output);	
}
mysqli_close($conn);
?>