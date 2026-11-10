<?php
session_start();
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "web"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}


$log_username = mysqli_real_escape_string($con,$_POST['username']);
$log_password = mysqli_real_escape_string($con,$_POST['password']);



if ($log_username != "" && $log_password != ""){

    $sql_query = "select count(*) as plithos from user where username='".$log_username."' and password='".$log_password."'";
    $result = mysqli_query($con,$sql_query);
    $row = mysqli_fetch_array($result);

    $count = $row['plithos'];

    if($count > 0){		
		$_SESSION["valid"] = 2;
		
		$_SESSION["username"] = $log_username;
        
        echo 1;
    }else{
        echo 0;
    }

}