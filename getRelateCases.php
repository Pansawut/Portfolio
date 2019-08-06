<?php
require "connection.php";

$userId = $_POST['user_id'];   // user id

$type = $_POST['clickType'];

if ($type == "openedCase") {
    $sql = "SELECT com.comp_name,cl.comp_number ,ca.case_number, ca.call_type, ca.case_topic, ca.case_info, ca.priority, ca.issued_date, ca.status, ca.callback_number,ca.order_num,ca.update_time,
    ct.cat_name AS case_category, m1.fname AS raise_fname, m1.lname AS raise_lname, m2.fname AS assign_fname, m2.lname AS assign_lname, 
    cl.client_fname,cl.client_lname
    FROM client_cases AS ca 
    LEFT JOIN category AS ct ON ct.cat_ids = ca.category_id
    LEFT JOIN members AS m1 ON m1.user_ids = ca.raised_by
    LEFT JOIN members AS m2 ON m2.user_ids = ca.assigned_to
    LEFT JOIN clients AS cl ON cl.client_ids = ca.case_client_id
    LEFT JOIN company AS com ON cl.comp_number = com.comp_ids
    WHERE cl.comp_number in (SELECT comp_workon_id from work_on where member_id = '$userId') AND status='OPEN' ORDER BY issued_date DESC";    
}
if ($type == "openedCase_byme") {
    $sql = "SELECT com.comp_name,cl.comp_number ,ca.case_number, ca.call_type, ca.case_topic, ca.case_info, ca.priority, ca.issued_date, ca.status, ca.callback_number,ca.order_num,ca.update_time,
    ct.cat_name AS case_category, m1.fname AS raise_fname, m1.lname AS raise_lname, m2.fname AS assign_fname, m2.lname AS assign_lname, 
    cl.client_fname,cl.client_lname
    FROM client_cases AS ca 
    LEFT JOIN category AS ct ON ct.cat_ids = ca.category_id
    LEFT JOIN members AS m1 ON m1.user_ids = ca.raised_by
    LEFT JOIN members AS m2 ON m2.user_ids = ca.assigned_to
    LEFT JOIN clients AS cl ON cl.client_ids = ca.case_client_id
    LEFT JOIN company AS com ON cl.comp_number = com.comp_ids
    WHERE cl.comp_number in (SELECT comp_workon_id from work_on where member_id = '$userId') AND ca.raised_by='$userId' AND status='OPEN' ORDER BY issued_date DESC";    
}
if ($type == "pendingCase") {
    $sql = "SELECT com.comp_name,cl.comp_number,ca.case_number, ca.call_type, ca.case_topic, ca.case_info, ca.priority, ca.issued_date, ca.status, ca.callback_number,ca.order_num,ca.update_time,
    ct.cat_name AS case_category, m1.fname AS raise_fname, m1.lname AS raise_lname, m2.fname AS assign_fname, m2.lname AS assign_lname, 
    cl.client_fname,cl.client_lname
    FROM client_cases AS ca 
    LEFT JOIN category AS ct ON ct.cat_ids = ca.category_id
    LEFT JOIN members AS m1 ON m1.user_ids = ca.raised_by
    LEFT JOIN members AS m2 ON m2.user_ids = ca.assigned_to
    LEFT JOIN clients AS cl ON cl.client_ids = ca.case_client_id
    LEFT JOIN company AS com ON cl.comp_number = com.comp_ids
    WHERE cl.comp_number in (SELECT comp_workon_id from work_on where member_id = '$userId') AND status='PENDING' ORDER BY issued_date DESC";    
}
if ($type == "pendingCase_byme") {
    $sql = "SELECT com.comp_name,cl.comp_number,ca.case_number, ca.call_type, ca.case_topic, ca.case_info, ca.priority, ca.issued_date, ca.status, ca.callback_number,ca.order_num,ca.update_time,
    ct.cat_name AS case_category, m1.fname AS raise_fname, m1.lname AS raise_lname, m2.fname AS assign_fname, m2.lname AS assign_lname, 
    cl.client_fname,cl.client_lname
    FROM client_cases AS ca 
    LEFT JOIN category AS ct ON ct.cat_ids = ca.category_id
    LEFT JOIN members AS m1 ON m1.user_ids = ca.raised_by
    LEFT JOIN members AS m2 ON m2.user_ids = ca.assigned_to
    LEFT JOIN clients AS cl ON cl.client_ids = ca.case_client_id
    LEFT JOIN company AS com ON cl.comp_number = com.comp_ids
    WHERE cl.comp_number in (SELECT comp_workon_id from work_on where member_id = '$userId') AND ca.raised_by='$userId' AND status='PENDING' ORDER BY issued_date DESC";    
}
if ($type == "assignMe") {
    $sql = "SELECT com.comp_name,ca.case_number, ca.call_type, ca.case_topic, ca.case_info, ca.priority, ca.issued_date, ca.status, ca.callback_number,ca.order_num,ca.update_time,
    ct.cat_name AS case_category, m1.fname AS raise_fname, m1.lname AS raise_lname, m2.fname AS assign_fname, m2.lname AS assign_lname, 
    cl.client_fname,cl.client_lname
    FROM client_cases AS ca 
    LEFT JOIN category AS ct ON ct.cat_ids = ca.category_id
    LEFT JOIN members AS m1 ON m1.user_ids = ca.raised_by
    LEFT JOIN members AS m2 ON m2.user_ids = ca.assigned_to
    LEFT JOIN clients AS cl ON cl.client_ids = ca.case_client_id
    LEFT JOIN company AS com ON cl.comp_number = com.comp_ids
    WHERE assigned_to=".$userId." AND (status='PENDING' OR status='OPEN') ORDER BY issued_date DESC";    
}
if ($type == "closedCase") {
    $sql = "SELECT com.comp_name,cl.comp_number,ca.case_number, ca.call_type, ca.case_topic, ca.case_info, ca.priority, ca.issued_date, ca.status, ca.callback_number,ca.order_num,ca.update_time,
    ct.cat_name AS case_category, m1.fname AS raise_fname, m1.lname AS raise_lname, m2.fname AS assign_fname, m2.lname AS assign_lname, 
    cl.client_fname,cl.client_lname
    FROM client_cases AS ca 
    LEFT JOIN category AS ct ON ct.cat_ids = ca.category_id
    LEFT JOIN members AS m1 ON m1.user_ids = ca.raised_by
    LEFT JOIN members AS m2 ON m2.user_ids = ca.assigned_to
    LEFT JOIN clients AS cl ON cl.client_ids = ca.case_client_id
    LEFT JOIN company AS com ON cl.comp_number = com.comp_ids
    WHERE cl.comp_number in (SELECT comp_workon_id from work_on where member_id = '$userId') AND status='CLOSED' ORDER BY issued_date DESC";    
}
if ($type == "closedCase_byme") {
    $sql = "SELECT com.comp_name,cl.comp_number,ca.case_number, ca.call_type, ca.case_topic, ca.case_info, ca.priority, ca.issued_date, ca.status, ca.callback_number,ca.order_num,ca.update_time,
    ct.cat_name AS case_category, m1.fname AS raise_fname, m1.lname AS raise_lname, m2.fname AS assign_fname, m2.lname AS assign_lname, 
    cl.client_fname,cl.client_lname
    FROM client_cases AS ca 
    LEFT JOIN category AS ct ON ct.cat_ids = ca.category_id
    LEFT JOIN members AS m1 ON m1.user_ids = ca.raised_by
    LEFT JOIN members AS m2 ON m2.user_ids = ca.assigned_to
    LEFT JOIN clients AS cl ON cl.client_ids = ca.case_client_id
    LEFT JOIN company AS com ON cl.comp_number = com.comp_ids
    WHERE cl.comp_number in (SELECT comp_workon_id from work_on where member_id = '$userId') AND ca.raised_by='$userId' AND status='CLOSED' ORDER BY issued_date DESC";    
}

$result = mysqli_query($conn,$sql);

$case_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $caseNum = $row['case_number'];
    $callType = $row['call_type'];
    $caseTopic = $row['case_topic'];
    $caseInfo = $row['case_info'];
    $caseCat = $row['case_category'];
    $priority = $row['priority'];
    $issuedDate = $row['issued_date'];
    $issuedDateFormated = date( "d/m/Y H:i:s", strtotime($issuedDate));
    $raiseFname = $row['raise_fname'];
    $raiseLname = $row['raise_lname'];
    $assignFname = $row['assign_fname'];
    $assignLname = $row['assign_lname'];
    $status = $row['status'];
    $callbackNum = $row['callback_number'];
    $orderNum = $row['order_num'];
    $updateTime = $row['update_time'];
    $client_fname = $row['client_fname'];
    $client_lname = $row['client_lname'];
    $comp_name = $row['comp_name'];
    // $updateTime = date( "d/m/Y H:i:s", strtotime($updateTime));

    $case_arr[] = array(
    	"case_number" => $caseNum, 
    	"call_type" => $callType,
    	"case_topic" => $caseTopic,
    	"case_info" => $caseInfo,
    	"case_category" => $caseCat,
    	"priority" => $priority,
    	"issued_date" => $issuedDate,
    	"issued_date_format" => $issuedDateFormated,
    	"raise_fname" => $raiseFname,
    	"raise_lname" => $raiseLname,
    	"assign_fname" => $assignFname,
    	"assign_lname" => $assignLname,
    	"status" => $status,
    	"callback_number" => $callbackNum,
    	"order_num" => $orderNum,
    	"update_time" => $updateTime,
        "client_fname" => $client_fname,
        "client_lname" => $client_lname,
        "comp_name" => $comp_name
    );
}

// encoding array to json format
echo json_encode($case_arr);
mysqli_close($conn);
?>
