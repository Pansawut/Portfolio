<?php
	if(!isset($_SESSION['user_ids']))
	{
	echo "<meta http-equiv='Refresh' content='0;url=login.php' />";
  	exit();
	}

	if($_SESSION['role'] != "SADMIN" && $_SESSION['role'] != "ADMIN" && $_SESSION['role'] != "USER" && $_SESSION['role'] != "SUPERVISOR" && $_SESSION['role'] != "MANAGER" && $_SESSION['role'] != "AGENT")
	{
	  echo "<p align='center'>This page is for members only!<br><a href='login.php'>Login Here</a></p>";
	  exit();
	}
?>