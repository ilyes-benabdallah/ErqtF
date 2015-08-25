<?php


class myClassLogin {

	function checkLogin()
	{
		if (!isset($_SESSION["ID_ADMIN_VAL"]))
			{
				//header("location: index.php");
				echo "<script>window.location.replace('index.php');</script>";
				exit;
			}
	}
	
	function checkLoginIndex()
	{
		if (isset($_SESSION["ID_ADMIN_VAL"]))
			{
				//header("location: dashboard.php");
				echo "<script>window.location.replace('dashboard.php');</script>";
				
			}
	}


}



?>