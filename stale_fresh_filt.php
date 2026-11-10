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


if(isset($_POST['content_type']))
	
	{
$cont_type = $_POST['content_type'];
	}


if(isset($_POST['isp']))
{
$isp =  $_POST['isp'];
}

if(isset($cont_type))
{
$condition_con_type = "header_response.content_type in  (";

$flag_conditions=0;

       foreach($cont_type as $x)
	   
	   {
		   if($flag_conditions==0)
		   {   
		   $condition_con_type = $condition_con_type. "'".$x."'";
		   $flag_conditions=1;
		   
		   }
		   
		   else
			   
			   {
				
				$condition_con_type = $condition_con_type. ",'".$x."'";

				   
			   }
		   
	   }
	$condition_con_type = $condition_con_type. ")";			
	
}


if(isset($isp))
{
$condition_isp_type = "entry.isp in  (";

$flag_isps=0;

       foreach($isp as $x)
	   
	   {
		   if($flag_isps==0)
		   {   
		   $condition_isp_type = $condition_isp_type. "'".$x."'";
		   $flag_isps=1;
		   
		   }
		   
		   else
			   
			   {
				
				$condition_isp_type = $condition_isp_type. ",'".$x."'";

				   
			   }
		   
	   }
	$condition_isp_type = $condition_isp_type. ")";
}


if(isset($cont_type) && !isset($isp))

{

$sql = "SELECT COUNT(*) as plithos_stale FROM header_response INNER JOIN entry ON header_response.id_entry = entry.id WHERE header_response.cache_control LIKE '%max-stale%' and $condition_con_type";


$sql2 = "SELECT COUNT(*) as plithos_fresh FROM header_response INNER JOIN entry ON header_response.id_entry = entry.id WHERE cache_control LIKE '%min-fresh%' and $condition_con_type";


$sql3 = "SELECT COUNT(*) as plithos FROM header_response INNER JOIN entry ON header_response.id_entry = entry.id WHERE $condition_con_type";


}

else if(!isset($cont_type) && isset($isp))

{

$sql = "SELECT COUNT(*) as plithos_stale FROM header_response INNER JOIN entry ON header_response.id_entry = entry.id WHERE header_response.cache_control LIKE '%max-stale%' and $condition_isp_type";


$sql2 = "SELECT COUNT(*) as plithos_fresh FROM header_response INNER JOIN entry ON header_response.id_entry = entry.id WHERE cache_control LIKE '%min-fresh%' and $condition_isp_type";


$sql3 = "SELECT COUNT(*) as plithos FROM header_response INNER JOIN entry ON header_response.id_entry = entry.id WHERE $condition_isp_type";



}

else if(isset($cont_type) && isset($isp))

{

$sql = "SELECT COUNT(*) as plithos_stale FROM header_response INNER JOIN entry ON header_response.id_entry = entry.id WHERE header_response.cache_control LIKE '%max-stale%' and $condition_con_type and $condition_isp_type";


$sql2 = "SELECT COUNT(*) as plithos_fresh FROM header_response INNER JOIN entry ON header_response.id_entry = entry.id WHERE cache_control LIKE '%min-fresh%' and $condition_con_type and $condition_isp_type";


$sql3 = "SELECT COUNT(*) as plithos FROM header_response INNER JOIN entry ON header_response.id_entry = entry.id WHERE $condition_con_type and $condition_isp_type";


}

else
	
	{
	
	
	$sql = "SELECT COUNT(*) as plithos_stale FROM header_response INNER JOIN entry ON header_response.id_entry = entry.id WHERE header_response.cache_control LIKE '%max-stale%'";


$sql2 = "SELECT COUNT(*) as plithos_fresh FROM header_response INNER JOIN entry ON header_response.id_entry = entry.id WHERE cache_control LIKE '%min-fresh%'";


$sql3 = "SELECT COUNT(*) as plithos FROM header_response INNER JOIN entry ON header_response.id_entry = entry.id";


		
	}





$result = $con->query($sql);

$result2 = $con->query($sql2);

$result3 = $con->query($sql3);


$row = $result->fetch_assoc();
$stales = intval($row['plithos_stale']);

$row2 = $result2->fetch_assoc();

$freshes = intval($row2['plithos_fresh']);

$row3 = $result3->fetch_assoc();

$total = intval($row3['plithos']);


echo "<table border='2'>";

echo "<tr>";

echo "<th>";
echo "Percentage of Max-stale";
echo "</th>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo $stales/$total;
echo "</td>";
echo "</tr>";
echo "</table>";

echo "<br>";

echo "<table border='2'>";

echo "<tr>";

echo "<th>";
echo "Percentage of Min-Fresh";
echo "</th>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo $freshes/$total;
echo "</td>";
echo "</tr>";
echo "</table>";


?>