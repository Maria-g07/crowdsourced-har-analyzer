<html>


<?php

session_start();


$adm_username = $_POST["username"];


$adm_password = $_POST["password"];



if($adm_username =='admin' && $adm_password=='admin')
	

	{
		
		$_SESSION["valid"] = 1;
		
		header("Location: admin_index.php");	
		
	}
	
	else
		
		{
			
		header("Location: admin_login.php");	
	
			
		}



?>



</html>