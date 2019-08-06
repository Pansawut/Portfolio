<?php
//-----for webhost-----
$servername='localhost';
$username='jscmscom_admin';
$password='123Qweasd';
$dbname='jscmscom_cmsdb1';

//---localhost connect my laptop---
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "jscmscom_cmsdb1";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 
$conn->set_charset("utf8");
?>