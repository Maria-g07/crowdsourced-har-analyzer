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


$edit_username = mysqli_real_escape_string($con,$_POST['username']);
$edit_password = mysqli_real_escape_string($con,$_POST['password']);



if ($edit_username != "" && $edit_password != ""){

    $sql_query = "select count(*) as plithos from user where username='$edit_username'";
    $result = mysqli_query($con,$sql_query);
    $row = mysqli_fetch_array($result);

    $count = $row['plithos'];

    if($count > 0){		
        
        echo 0;
    }else{
       
	   $old_username = $_SESSION["username"];
	   
	   $sql = "UPDATE user SET username='$edit_username',password='$edit_password' WHERE username='$old_username'";

	  $result_edit = mysqli_query($con,$sql);
      
	   echo 1;
	   
	   
    }

}