<?php



$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "web"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST["username"];

$sql = "SELECT last_upload from user WHERE username = '$username'";

$result = $con->query($sql);

$row = $result->fetch_assoc();

echo "<table border = '2'>";

echo "<tr>";

echo "<th>";
echo "Last Upload Date Time";
echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<td>";
echo $row['last_upload'];

echo "</td>";
echo "</tr>";
echo "</table>";




?>