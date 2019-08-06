<?php 
session_start();
// ob_start();
?>
<title>Jump Starter Co.,Ltd || CS Management System.</title>
<link rel="shortcut icon" type="image/x-icon" href="vendor/images/LOGO-Jumpstarter-180.png">  
<?php
require ('connection.php');

if(isset($_POST['txtUsername'],$_POST['txtPassword'])){
	$strSQL = "SELECT * FROM members WHERE (username = '".mysqli_real_escape_string($conn,$_POST['txtUsername'])."' 
	or email = '".mysqli_real_escape_string($conn,$_POST['txtUsername'])."')
	and password = '".mysqli_real_escape_string($conn,$_POST['txtPassword'])."'";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "<script>
		alert('Username or Password Incorrect! Please try again.');
		window.location = document.referrer;
		</script>";
	}
	else
	{
		$_SESSION["user_ids"] = $objResult["user_ids"];
		$_SESSION["role"] = $objResult["role"];
		$_SESSION["company_number"] = $objResult["comp_id"];

		session_write_close();

	// header("location:index.php");
		echo "<meta http-equiv='Refresh' content='0;url=index.php' />";
	}
}else{
	echo "alert('Please Fill in Username and Password.');";
}	
mysqli_close($conn);

?>
