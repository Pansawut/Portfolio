<?php 
require "connection.php";
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
require_once 'vendor/phpoffice/phpspreadsheet/src/Bootstrap.php';

$month = isset($_POST['range']) ? $_POST['range'] : '';
$comp_id = isset($_POST['comp_id']) ? $_POST['comp_id'] : '';
$fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : '';
$toDate = isset($_POST['toDate']) ? $_POST['toDate'] : '';
$year = isset($_POST['year']) ? $_POST['year'] : '';

if($month==0){
	$month = 12;
}else if($month<0){
	$month = 12 + $month;
	$year = $year-1;
}

if ($fromDate == 0 && $toDate == 0) {
	$query = "SELECT case_number, call_type, CONCAT(cl.client_fname , ' ' ,cl.client_lname) AS client_name,case_topic,
	case_info, cat.cat_name, priority, issued_date, CONCAT(m.fname , ' ' ,m.lname) AS raised_by, status, order_num, 
	CONCAT(m1.fname , ' ' ,m1.lname) AS assigned_to , CONCAT(m2.fname , ' ' ,m2.lname) AS closed_by 
	from client_cases
	LEFT JOIN clients AS cl ON case_client_id = cl.client_ids
	LEFT JOIN category AS cat ON category_id = cat.cat_ids
	LEFT JOIN members AS m ON raised_by = m.user_ids
	LEFT JOIN members AS m1 ON assigned_to = m1.user_ids
	LEFT JOIN members AS m2 ON closed_by = m2.user_ids
	WHERE cl.comp_number = '$comp_id' AND DATE(issued_date) BETWEEN CONCAT('$year','-','$month','-','01') AND NOW();";
}else{
	$query = "SELECT case_number, call_type, CONCAT(cl.client_fname , ' ' ,cl.client_lname) AS client_name,case_topic,
	case_info, cat.cat_name, priority, issued_date, CONCAT(m.fname , ' ' ,m.lname) AS raised_by, status, order_num, 
	CONCAT(m1.fname , ' ' ,m1.lname) AS assigned_to , CONCAT(m2.fname , ' ' ,m2.lname) AS closed_by 
	from client_cases
	LEFT JOIN clients AS cl ON case_client_id = cl.client_ids
	LEFT JOIN category AS cat ON category_id = cat.cat_ids
	LEFT JOIN members AS m ON raised_by = m.user_ids
	LEFT JOIN members AS m1 ON assigned_to = m1.user_ids
	LEFT JOIN members AS m2 ON closed_by = m2.user_ids
	WHERE cl.comp_number = '$comp_id' AND DATE(issued_date) BETWEEN '$fromDate' AND '$toDate';";
}


$spreadsheet = new Spreadsheet();

$spreadsheet->setActiveSheetIndex(0)
				->setCellValue("A1",'Case Number')
				->setCellValue("B1",'Call Type')
				->setCellValue("C1",'Client Name')
				->setCellValue("D1",'Case Topic')
				->setCellValue("E1",'Case Info')
				->setCellValue("F1",'Category')
				->setCellValue("G1",'Priority')
				->setCellValue("H1",'Issued Date')
				->setCellValue("I1",'Raised By')
				->setCellValue("J1",'Status')
				->setCellValue("K1",'Order Number')
				->setCellValue("L1",'Assigned To')
				->setCellValue("M1",'Closed By');

$spreadsheet->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true);	

//run query and write cell values
$result = $conn->query($query);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
// cell value
$spreadsheet->getActiveSheet()->fromArray($data, null, 'A2');
			
$spreadsheet->getActiveSheet()->setTitle('Calls Report');
$spreadsheet->setActiveSheetIndex(0);

ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="calls_report.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
// ob_start();
$writer->save('php://output');
// $xlsxData = ob_get_contents();
// // ob_end_clean();
// $response =  array(
//         'op' => 'ok',
//         'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsxData)
// );
// die(json_encode($response));

exit;
// print_r($data);
// Return results as json encoded array
// echo json_encode($data);

mysqli_close($conn);
?>