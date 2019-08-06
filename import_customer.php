<?php
require ('connection.php');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$comp_id = $_POST["select_importTo_comp"];
$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if(isset($_FILES['import_file']['name']) && in_array($_FILES['import_file']['type'], $file_mimes)) {

    $arr_file = explode('.', $_FILES['import_file']['name']);
    $extension = end($arr_file);

    if('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($_FILES['import_file']['tmp_name']);
    $sheetData = $spreadsheet->getActiveSheet();
    $highestRow = $sheetData->getHighestRow();
    $dataRange = "A1:E$highestRow";
    $sheetData = $sheetData->rangeToArray(
        $dataRange,     // The worksheet range that we want to retrieve
        NULL,        // Value that should be returned for empty cells
        FALSE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
        TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
        FALSE         // Should the array be indexed by cell row and cell column
    );

    $fields = implode(', ', array_shift($sheetData));
    $values = array();
    $countErr = array();

    foreach ($sheetData as $rowValues) {
	    foreach ($rowValues as $key => $rowValue) {
        	$rowValues[$key] = "'".trim($rowValues[$key])."'";
	    }
	    if($rowValues[0] != "''" ||
			$rowValues[1] != "''" ||
			$rowValues[2] != "''" ||
			$rowValues[3] != "''" ||
			$rowValues[4] != "''"){

	    	$strSQL = "SELECT * FROM clients WHERE client_phone1 = ".$rowValues[2]." AND client_fname = ".$rowValues[0]." AND comp_number = '$comp_id'";
			$objQuery = mysqli_query($conn,$strSQL);
			$objResult = mysqli_fetch_array($objQuery);
			if($objResult){
				$countErr[] = "(" . implode(', ', $rowValues) . ")";
			}else{
			    $values[] = "(" . implode(', ', $rowValues) . ", '$comp_id')";
			}
	    }
	}

	$strSQL1 = "INSERT INTO clients (client_fname,client_lname,client_phone1,client_email,client_remark,comp_number) 
	VALUES ".implode (', ', $values) . ";";
	$objQuery1 = mysqli_query($conn,$strSQL1);

	$errorLen = count($countErr);

	if ($objQuery1) {
		if($errorLen == 0){
			$output = json_encode(array('type'=>'success', 'message' => 'Import Success!'));
		}else{
			$output = json_encode(array('type'=>'warning', 'message' => 'Import Success with '.$errorLen.' error(s).'));
		}
	}else{
		$output = json_encode(array('type'=>'error', 'message' => 'Import Failed! Please Check Your File.'));
	}

	die($output);
}

$spreadsheet->disconnectWorksheets();
unset($spreadsheet);

mysqli_close($conn);
?>