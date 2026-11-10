<html> 
  
<head> 
   
    <script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> 
    </script> 
  
    <script> 
  
        $.getJSON("https://api.ipify.org?format=json", 
                                          function(data) { 
  
            // Setting text of element P with id gfg 
            $("#myip").html(data.ip); 
        }) 
    </script> 
</head> 
  
<body> 
        <p id="myip"></p> 
  
</body> 
  
<?php


$hostname = gethostbyaddr("94.64.111.152");

echo $hostname;

echo "<br>";

$myip = '94.64.111.152';

$ipinfoAPI = "http://ipinfo.io/{$myip}/json";
//get the APi requeted data
$load = file_get_contents($ipinfoAPI);
//Convert it to the readable format
$return = json_decode($load);

echo $return->loc;

echo "<br>";

echo $return->org;
 
?>  
  
</html> 