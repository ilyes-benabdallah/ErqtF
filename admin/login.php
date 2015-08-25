<?php


class myClassLogin {

	function checkLogin()
	{
		if (!isset($_SESSION["ID_ADMIN_VAL"]))
			{
				header("location: index.php");
				exit;
			}
	}
	
	function checkLoginIndex()
	{
		if (isset($_SESSION["ID_ADMIN_VAL"]))
			{
				header("location: dashboard.php");
				
			}
	}


}



?>