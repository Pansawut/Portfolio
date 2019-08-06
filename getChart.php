<?php 
require "connection.php";

$type = $_POST["type"];
$date = $_POST["date"];
$firstDate = 1;
$month = $_POST["month"];
$year = $_POST["year"];
$rangeMonth = $_POST["range"];
$rangeYear = $year;

if($rangeMonth==0){
	$rangeMonth = 12;
	$rangeYear = $year-1;
}else if($rangeMonth<0){
	$rangeMonth = 12 + $rangeMonth;
	$rangeYear = $year-1;
}

$chartType = $_POST["chartType"];
$comp_id = $_POST["comp_id"];
$from_date = $_POST["from_date"];
$to_date = $_POST["to_date"];

if($chartType == "pie"){
	if($type == "monthYear"){
		$query = "SELECT distinct cat.cat_name, count(cat.cat_name) AS amount
		  FROM client_cases AS cc 
		  LEFT JOIN clients AS c on cc.case_client_id = c.client_ids
		  LEFT JOIN category as cat on cc.category_id = cat.cat_ids
		  -- from past to now
		  WHERE c.comp_number = '$comp_id' AND DATE(issued_date) BETWEEN CONCAT('$rangeYear','-','$rangeMonth','-','$firstDate') AND NOW()
		 AND status != 'DELETED' GROUP by cat.cat_name ORDER BY amount DESC LIMIT 5;";
	}else if($type == "daily"){
		$query = "SELECT distinct cat.cat_name, count(cat.cat_name) AS amount
		  FROM client_cases AS cc 
		  LEFT JOIN clients AS c on cc.case_client_id = c.client_ids
		  LEFT JOIN category as cat on cc.category_id = cat.cat_ids
		  -- from past to now
		  WHERE c.comp_number = '$comp_id' AND DATE(issued_date) = CONCAT('$year','-','$month','-','$date')
		 AND status != 'DELETED' GROUP by cat.cat_name ORDER BY amount DESC LIMIT 5;";
	}else if($type == "filter_btn"){
		$query = "SELECT distinct cat.cat_name, count(cat.cat_name) AS amount
		  FROM client_cases AS cc 
		  LEFT JOIN clients AS c on cc.case_client_id = c.client_ids
		  LEFT JOIN category as cat on cc.category_id = cat.cat_ids
		  -- from past to now
		  WHERE c.comp_number = '$comp_id' AND DATE(issued_date) BETWEEN '$from_date' AND '$to_date'
		 AND status != 'DELETED' GROUP by cat.cat_name ORDER BY amount DESC LIMIT 5;";
	}
}
if($chartType == "line"){
	if($type == "month"){
		$query = "SELECT DATE_FORMAT(issued_date,'%d %M %Y') as Label,
			SUM(CASE WHEN call_type='INBOUND' THEN 1 ELSE 0 END) AS INB, 
			SUM(CASE WHEN call_type='OUTBOUND' THEN 1 ELSE 0 END) AS OUTB,issued_date FROM client_cases 
			LEFT JOIN clients AS c on case_client_id = c.client_ids
			WHERE DATE(issued_date) BETWEEN CONCAT('$rangeYear','-','$rangeMonth','-','01') AND NOW()
			AND status != 'DELETED' AND c.comp_number ='$comp_id' GROUP BY Label ORDER BY issued_date;";
	}
	if($type == "year"){
		$query = "SELECT DATE_FORMAT(issued_date,'%M %Y') as Label,
			SUM(CASE WHEN call_type='INBOUND' THEN 1 ELSE 0 END) AS INB, 
			SUM(CASE WHEN call_type='OUTBOUND' THEN 1 ELSE 0 END) AS OUTB,issued_date FROM client_cases 
			LEFT JOIN clients AS c on case_client_id = c.client_ids
			WHERE DATE(issued_date) BETWEEN CONCAT('$year','-','01','-','01') AND NOW()
			AND status != 'DELETED' AND c.comp_number ='$comp_id' GROUP BY Label ORDER BY issued_date;";
	}
	if($type == "today"){
		$query = "SELECT DATE_FORMAT(issued_date,'%M %Y-%H:%i') as Label,
			SUM(CASE WHEN call_type='INBOUND' THEN 1 ELSE 0 END) AS INB, 
			SUM(CASE WHEN call_type='OUTBOUND' THEN 1 ELSE 0 END) AS OUTB,issued_date FROM client_cases 
			LEFT JOIN clients AS c on case_client_id = c.client_ids
			WHERE DATE(issued_date) = CONCAT('$year','-','$month','-','$date')
			AND status != 'DELETED' AND c.comp_number ='$comp_id' GROUP BY Label ORDER BY issued_date;";
	}
	if($type == "filter_btn1"){
		$query = "SELECT DATE_FORMAT(issued_date,'%d %M %Y') as Label,
			SUM(CASE WHEN call_type='INBOUND' THEN 1 ELSE 0 END) AS INB, 
			SUM(CASE WHEN call_type='OUTBOUND' THEN 1 ELSE 0 END) AS OUTB,issued_date FROM client_cases 
			LEFT JOIN clients AS c on case_client_id = c.client_ids
			WHERE DATE(issued_date) BETWEEN '$from_date' AND '$to_date'
			AND status != 'DELETED' AND c.comp_number ='$comp_id' GROUP BY Label ORDER BY issued_date;";
	}
	if($type == "filter_btn2"){
		$query = "SELECT DATE_FORMAT(issued_date,'%M %Y-%H:%i') as Label,
			SUM(CASE WHEN call_type='INBOUND' THEN 1 ELSE 0 END) AS INB, 
			SUM(CASE WHEN call_type='OUTBOUND' THEN 1 ELSE 0 END) AS OUTB,issued_date FROM client_cases 
			LEFT JOIN clients AS c on case_client_id = c.client_ids
			WHERE DATE(issued_date) BETWEEN '$from_date' AND '$to_date'
			AND status != 'DELETED' AND c.comp_number ='$comp_id' GROUP BY Label ORDER BY issued_date;";
	}
}
$result = $conn->query($query);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
// Return results as json encoded array
echo json_encode($data);

mysqli_close($conn);
?>