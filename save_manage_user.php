<?php 
require ('connection.php');

// values to insert
$user_id = $_POST['user_id'];
$saveType = $_POST['type'];

if($saveType == "delete"){
	$strSQL = "DELETE FROM members WHERE user_ids ='$user_id'";
	$objQuery = mysqli_query($conn,$strSQL);
	if ($objQuery) {
		$output = json_encode(array('type'=>'success', 'message' => 'User is Deleted!'));
	}else{
		$output = json_encode(array('type'=>'error', 'message' => 'Oops!, Something is Wrong.'));
	}
}

if($saveType == "update"){
	$Username = $_POST['Username'];
	$Password = $_POST['Password'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$Email = $_POST['Email'];
	$Role = $_POST['Role'];
	$comp1 = $_POST['comp1'];
	$comp2 = $_POST['comp2'];
	$comp3 = $_POST['comp3'];
	$comp4 = $_POST['comp4'];
	$comp5 = $_POST['comp5'];
	$comp6 = $_POST['comp6'];

	$strSQL1 = "UPDATE members SET username='$Username',fname='$firstName',lname='$lastName',email='$Email',role='$Role',password='$Password' WHERE user_ids='$user_id'";
	$objQuery1 = mysqli_query($conn,$strSQL1);

	$strSQL7 = "DELETE FROM work_on WHERE member_id='$user_id'";
	$objQuery7 = mysqli_query($conn,$strSQL7);

	// loop
	if($comp1 !=""){
		$strSQL2 = "INSERT INTO work_on (member_id,comp_workon_id) VALUES ('$user_id','$comp1')";
		$objQuery2 = mysqli_query($conn,$strSQL2);
	}
	if($comp2 !=""){
		$strSQL3 = "INSERT INTO work_on (member_id,comp_workon_id) VALUES ('$user_id','$comp2')";
		$objQuery3 = mysqli_query($conn,$strSQL3);
	}
	if($comp3 !=""){
		$strSQL3 = "INSERT INTO work_on (member_id,comp_workon_id) VALUES ('$user_id','$comp3')";
		$objQuery3 = mysqli_query($conn,$strSQL3);
	}
	if($comp4 !=""){
		$strSQL4 = "INSERT INTO work_on (member_id,comp_workon_id) VALUES ('$user_id','$comp4')";
		$objQuery4 = mysqli_query($conn,$strSQL4);
	}
	if($comp5 !=""){
		$strSQL5 = "INSERT INTO work_on (member_id,comp_workon_id) VALUES ('$user_id','$comp5')";
		$objQuery5 = mysqli_query($conn,$strSQL5);
	}
	if($comp6 !=""){
		$strSQL6 = "INSERT INTO work_on (member_id,comp_workon_id) VALUES ('$user_id','$comp6')";
		$objQuery6 = mysqli_query($conn,$strSQL6);
	}

	if ($objQuery1) {
		$output = json_encode(array('type'=>'success', 'message' => 'Save Successfully!'));
	}else{
		$output = json_encode(array('type'=>'error', 'message' => 'Oops!, Something is Wrong.'));
	}
}

die($output);	

mysqli_close($conn);
?>