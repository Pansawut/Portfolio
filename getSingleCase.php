<?php 

require "connection.php";

// case number from clicked card
$caseId = $_POST['caseId'];  

$sql = "SELECT cl.client_fname, cl.client_lname, ca.call_type,cl.comp_number, ca.case_topic, ca.case_info, ca.priority, ca.issued_date, 
ca.category_id, ca.assigned_to, ca.status, ca.callback_number,ca.order_num,ca.update_time, 
m1.fname AS raise_fname, m1.lname AS raise_lname,
m2.fname AS close_fname, m2.lname AS close_lname
FROM client_cases AS ca 
LEFT JOIN members AS m1 ON m1.user_ids = ca.raised_by
LEFT JOIN members AS m2 ON m2.user_ids = ca.closed_by
LEFT JOIN clients AS cl ON cl.client_ids = ca.case_client_id 
WHERE case_number = '$caseId'";

$result = mysqli_query($conn,$sql);

$case_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $clientFname = $row['client_fname'];
    $clientLname = $row['client_lname'];
    $callType = $row['call_type'];
    $comp_num = $row['comp_number'];
    $caseTopic = $row['case_topic'];
    $caseInfo = $row['case_info'];
    $caseCat = $row['category_id'];
    $priority = $row['priority'];
    $issuedDate = $row['issued_date'];
    $issuedDateFormated = date( "d/m/Y H:i:s", strtotime($issuedDate));
    $raiseFname = $row['raise_fname'];
    $raiseLname = $row['raise_lname'];
    $assignedTo = $row['assigned_to'];
    $status = $row['status'];
    $callbackNum = $row['callback_number'];
    $orderNum = $row['order_num'];
    $updateTime = $row['update_time'];
    $close_fname = $row['close_fname'];
    $close_lname = $row['close_lname'];
    // $updateTime = date( "d/m/Y H:i:s", strtotime($updateTime));

    $case_arr[] = array(
    	"clientFname" => $clientFname,
    	"clientLname" => $clientLname,
    	"call_type" => $callType,
        "comp_num" => $comp_num,
    	"case_topic" => $caseTopic,
    	"case_info" => $caseInfo,
    	"case_category" => $caseCat,
    	"priority" => $priority,
    	"issued_date" => $issuedDate,
    	"issued_date_format" => $issuedDateFormated,
    	"raise_fname" => $raiseFname,
    	"raise_lname" => $raiseLname,
    	"assigned_to" => $assignedTo,
    	"status" => $status,
    	"callback_number" => $callbackNum,
    	"order_num" => $orderNum,
    	"update_time" => $updateTime,
        "close_fname" => $close_fname,
        "close_lname" => $close_lname
    );
}

// encoding array to json format
echo json_encode($case_arr);
mysqli_close($conn);

?>