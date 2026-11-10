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

$sql = "SELECT COUNT(*) as plithos from entry WHERE username = '$username'";

$result = $con->query($sql);

$row = $result->fetch_assoc();

echo "<table border = '2'>";

echo "<tr>";

echo "<th>";
echo "Count of Uploaded Entries";
echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<td>";
echo $row['plithos'];

echo "</td>";
echo "</tr>";
echo "</table>";




?>