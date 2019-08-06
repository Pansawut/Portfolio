<?php 
require "connection.php";

// Get search term
$comp_id = $_POST['comp_id'];
$role = $_POST['role'];
// Get matched data from clients table
if ($role == "SADMIN") {
	$query = $conn->query("SELECT * FROM members WHERE role = 'ADMIN' OR role = 'USER'");	
}
else{
	$query = $conn->query("SELECT DISTINCT m.* FROM members AS m LEFT JOIN work_on AS w ON w.member_id = m.user_ids WHERE m.comp_id ='$comp_id'");
}

// Generate clients data array
$userData = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
    	$data['user_id'] = $row['user_ids'];
    	$data['user_fname'] = $row['fname'];
       	$data['user_lname'] = $row['lname'];
        $data['user_role'] = $row['role'];
        array_push($userData, $data);
    }
}

// Return results as json encoded array
echo json_encode($userData);
mysqli_close($conn);
?>