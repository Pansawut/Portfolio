<?php 
require "connection.php";

// Get search term
$type = $_POST['type'];
// Get matched data from clients table
if($type == "get1user"){
    $user_id = $_POST['user_id'];
	$query = $conn->query("SELECT * FROM members WHERE user_ids = '$user_id' ");
}
else if($type == "getalluser"){
	$query = $conn->query("SELECT * FROM members WHERE role = 'ADMIN' OR role='USER' OR role= 'SUPERVISOR' OR role= 'MANAGER' OR role= 'AGENT' ORDER BY fname");
}

// Generate clients data array
$userData = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
    	$data['user_ids'] = $row['user_ids'];
    	$data['user_fname'] = $row['fname'];
       	$data['user_lname'] = $row['lname'];
        $data['user_email'] = $row['email'];
        $data['user_username'] = $row['username'];
        $data['user_password'] = $row['password'];
        $data['user_role'] = $row['role'];
        array_push($userData, $data);
    }
}

// Return results as json encoded array
echo json_encode($userData);
mysqli_close($conn);
?>