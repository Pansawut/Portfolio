<?php 
require "connection.php";

// Get search term
$user_id = $_POST['user_id'];
// Get matched data from clients table
$query = $conn->query("SELECT comp_workon_id, c.comp_name FROM work_on LEFT JOIN company AS c ON comp_workon_id = c.comp_ids
WHERE member_id ='$user_id'");	

// Generate clients data array
$userCompData = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
    	$data['comp_id'] = $row['comp_workon_id'];
    	$data['comp_name'] = $row['comp_name'];
        array_push($userCompData, $data);
    }
}

// Return results as json encoded array
echo json_encode($userCompData);
mysqli_close($conn);

?>