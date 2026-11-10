<html>

<head>
<link rel="stylesheet" href="mystyle.css">

</head>

<?php

error_reporting(E_ERROR | E_PARSE);


$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "web"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

session_start();

$filtered = $_POST["filtered"];

$myip = $_POST["myip"];




$ipinfoAPI = "http://ipinfo.io/{$myip}/json";
//get the APi requeted data
$load = file_get_contents($ipinfoAPI);
//Convert it to the readable format
$return = json_decode($load);

$latlng = $return->loc;

$isp  = $return->org;



$array = json_decode($filtered, true);

$server_latlng="unknown";

$array = $array['entries'];

$st_date_time="";

$server_ip_address="";

$wait="";

$method ="";

$url = "";

$username = $_SESSION["username"];

$status ="";

$status_text="";

$day_request="";


$mysql_max = "SELECT MAX(id) as mymax FROM entry";
$result = mysqli_query($con,$mysql_max);

$row = $result->fetch_assoc();

$entry_id = $row["mymax"];



for($i=0;$i<count($array);$i++)
	
	{
		$server_latlng="unknown";

		
		 $entry_id= $entry_id+1;
		
		$st_date_time =  $array[$i]['startedDateTime'];
		
		$myday = substr($st_date_time,0,10);
        
		$day_request=date('l', strtotime($myday));
		
		$server_ip_address = $array[$i]['serverIPAddress'];
		
		$ipinfoAPI_server = "http://ipinfo.io/{$server_ip_address}/json";

		$load_server = file_get_contents($ipinfoAPI_server);

		$return_server = json_decode($load_server);
        
		$server_latlng = $return_server->loc;
		
		
		$wait = $array[$i]['timings']['wait'];
		
		
		$sql_entry  = "INSERT INTO entry VALUES('$entry_id','$st_date_time','$wait','$server_ip_address','$username','$isp','$latlng','$server_latlng','$day_request')";
		  
		  if ($con->query($sql_entry) === TRUE) {
} else {
  echo "Error: " . $sql_entry . "<br>" . $con->error;
}

  $method = $array[$i]['request']['method'];
  
  $url = $array[$i]['request']['url'];
  
  $req_id = $entry_id;
    
   $sql_req  = "INSERT INTO request VALUES('$req_id','$entry_id','$method','$url')";
		  
		  if ($con->query($sql_req) === TRUE) {
		} else {
				echo "Error: " . $sql_req . "<br>" . $con->error;
				}
   
	$status = $array[$i]['response']['status'];

    $status_text = $array[$i]['response']['statusText'];

    $resp_id = $entry_id;
    
	$sql_resp  = "INSERT INTO response VALUES('$resp_id','$entry_id','$status','$status_text')";
		  
		  if ($con->query($sql_resp) === TRUE) {
		} else {
				echo "Error: " . $sql_resp . "<br>" . $con->error;
				}
	
	$headers_req = $array[$i]['request']['headers'];
	
	$headers_resp = $array[$i]['response']['headers'];
	
	$content_type_req="";
	
	$cache_control_req="";
	
	$pragma_req="";
	
	$expires_req="";
	
	$age_req="";
	$last_modified_req="";
    
	$host_req="";
	
	for($j=0;$j<count($headers_req);$j++)
		
		{
			if($headers_req[$j]['name']=="content-type"||$headers_req[$j]['name']=="Content-Type")
				
				{
					$content_type_req = $headers_req[$j]['value'];
				}
			
				if($headers_req[$j]['name']=="cache-control"||$headers_req[$j]['name']=="Cache-Control")
				
				{
				  $cache_control_req= $headers_req[$j]['value'];

				}
			
			if($headers_req[$j]['name']=="pragma"||$headers_req[$j]['name']=="Pragma")
				
				{
				$pragma_req = $headers_req[$j]['value'];

					
				}
				
			if($headers_req[$j]['name']=="expires"||$headers_req[$j]['name']=="Expires")
				
				{
				$expires_req = $headers_req[$j]['value'];

				}
				
			if($headers_req[$j]['name']=="age"|$headers_req[$j]['name']=="Age")
				
				{
				$age_req = $headers_req[$j]['value'];

				}
				
			if($headers_req[$j]['name']=="last-modified"|$headers_req[$j]['name']=="Last-Modified")
				
				{
				$last_modified_req = $headers_req[$j]['value'];

				}
				
			if($headers_req[$j]['name']=="host"||$headers_req[$j]['name']=="Host")
				
				{
				$host_req = $headers_req[$j]['value'];
				}
			
		}
	
	$header_req_id = $req_id;
	
	$sql_headers_req  = "INSERT INTO header_request VALUES('$header_req_id','$req_id','$entry_id','$content_type_req','$cache_control_req','$pragma_req','$expires_req','$age_req','$last_modified_req','$host_req')";
		  
		  if ($con->query($sql_headers_req) === TRUE) {
		} else {
				echo "Error: " . $sql_headers_req . "<br>" . $con->error;
				}
	
$content_type_resp="";
	
	$cache_control_resp="";
	
	$pragma_resp="";
	
	$expires_resp="";
	
	$age_resp="";
	$last_modified_resp="";
    
	$host_resp="";
	
	for($k=0;$k<count($headers_resp);$k++)
		
		{
			if($headers_resp[$k]['name']=="content-type"||$headers_resp[$k]['name']=="Content-Type")
				
				{
					$content_type_resp = $headers_resp[$k]['value'];
				}
			
				if($headers_resp[$k]['name']=="cache-control"||$headers_resp[$k]['name']=="Cache-Control")
				
				{
				  $cache_control_resp= $headers_resp[$k]['value'];

				}
			
			if($headers_resp[$k]['name']=="pragma"||$headers_resp[$k]['name']=="Pragma" )
				
				{
				$pragma_resp = $headers_resp[$k]['value'];

					
				}
				
			if($headers_resp[$k]['name']=="expires"||$headers_resp[$k]['name']=="Expires")
				
				{
				$expires_resp = $headers_resp[$k]['value'];

				}
				
			if($headers_resp[$k]['name']=="age"||$headers_resp[$k]['name']=="Age")
				
				{
				$age_resp= $headers_resp[$k]['value'];

				}
				
			if($headers_resp[$k]['name']=="last-modified"||$headers_resp[$k]['name']=="Last-Modified")
				
				{
				$last_modified_resp = $headers_resp[$k]['value'];

				}
				
			if($headers_resp[$k]['name']=="host"||$headers_resp[$k]['name']=="Host")
				
				{
				$host_resp = $headers_resp[$k]['value'];
				}
			
		}
	
	$header_resp_id = $resp_id;
	
	$sql_headers_resp  = "INSERT INTO header_response VALUES('$header_resp_id','$resp_id','$entry_id','$content_type_resp','$cache_control_resp','$pragma_resp','$expires_resp','$age_resp','$last_modified_resp','$host_resp')";
		  
		  if ($con->query($sql_headers_resp) === TRUE) {
		} else {
				echo "Error: " . $sql_headers_resp . "<br>" . $con->error;
				}



	
	}

date_default_timezone_set('Europe/Athens');
$last_upload = date('m/d/Y h:i:s a', time());

$sql_update = "UPDATE user SET last_upload='$last_upload' where username='$username'";

if ($con->query($sql_update) === TRUE) {
} else {
  echo "Error updating record: " . $con->error;
}



echo "Data uploaed successfully";

echo "<br>";
echo "<a href = 'user_index.php'>Go Back to Homepage </a>";

?>


</html>