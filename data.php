<?php

$conn = mysqli_connect("localhost", "root", "", "jscmscom_cmsdb1");
$result = mysqli_query($conn, "SELECT COUNT(*)");

$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}
while ($row = mysqli_fetch_assoc($result))
{
	$data[] = $row;
}
echo json_encode($data);
?>