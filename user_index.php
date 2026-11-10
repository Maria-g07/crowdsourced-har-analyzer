<html>

<head>
<link rel="stylesheet" href="mystyle.css">

</head>

<?php

session_start();

if($_SESSION["valid"]!=2)
	
	{
			header("Location: user_login.php");		
	}


?>



<table border = "1">


	<tr>

		<td>
			<a href = "upload.php"> Upload your Http Data </a>
		</td>


		<td>
			<a href = "view_map.php"> View In Map </a>
		</td>


		<td>
			<a href = "edit_profile.php"> Edit Your Profile </a>
		</td>
		
		<td>
		<a href = "user_logout.php"> Logout </a>
		</td>

	</tr>

</table>



</html>