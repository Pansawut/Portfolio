<?php 
require "connection.php";

// Get search term
$searchTerm = $_POST['term'];
$userId = $_POST['userId'];
$role = $_POST["role"];
// Get matched data from clients table
if($role == "SADMIN"){
    $query = $conn->query("SELECT cl.* , c.comp_name FROM clients AS cl 
        LEFT JOIN company AS c ON cl.comp_number = c.comp_ids
        WHERE (client_phone1 LIKE concat('%".$searchTerm."%') OR client_fname LIKE concat('%".$searchTerm."%')) ORDER BY client_fname ASC LIMIT 10");
}else{
    $query = $conn->query("SELECT cl.* , c.comp_name FROM clients AS cl 
        LEFT JOIN work_on AS w ON w.comp_workon_id = cl.comp_number 
        LEFT JOIN company AS c ON cl.comp_number = c.comp_ids
    	WHERE (client_phone1 LIKE concat('%".$searchTerm."%') OR client_fname LIKE concat('%".$searchTerm."%')) AND member_id = '$userId' ORDER BY client_fname ASC LIMIT 10");
}

// Generate clients data array
$clientData = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
    	$data['id'] = $row['client_ids'];
        $data['value'] = $row['client_phone1'];
        $data['fname'] = $row['client_fname'];
        $data['lname'] = $row['client_lname'];
        $data['email'] = $row['client_email'];
        $data['remark'] = $row['client_remark'];
        $data['company'] = $row['comp_name'];
        $data['company_id'] = $row['comp_number'];
        array_push($clientData, $data);
    }
}

// Return results as json encoded array
echo json_encode($clientData);
mysqli_close($conn);
?>