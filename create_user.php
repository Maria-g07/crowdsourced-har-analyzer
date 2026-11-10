<html>

<head>

<link rel="stylesheet" href="mystyle.css">


</head>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

$reg_username = $_POST["username"];

$reg_password = $_POST["password"];

$reg_email = $_POST["email"];


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

else
	
	{
		

 $sql = "INSERT INTO user (username, password, email) VALUES ('$reg_username', '$reg_password', '$reg_email')";

		if ($conn->query($sql) === TRUE) {
			echo "Successfull Registration";
			
			echo "<br>";
			
			echo "<a href='index.php'>Back To HomePage </a>";
			} 

		else {
		echo "Error: " . $sql . "<br>" . $conn->error;
			}



	}






?>











</html>