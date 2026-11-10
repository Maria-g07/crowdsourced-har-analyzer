<html>

<head>

<link rel="stylesheet" href="mystyle.css">


</head>
    <script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> 
    </script> 

<?php

session_start();

if($_SESSION["valid"]!=2)
	
	{
			header("Location: admin_login.php");		
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

<br>

<br>

<input type="file" id="selectFiles" value="Import" /><br />
<button id="import">Filter Data</button>
<br>
<br>


<form id="write_to_file" method="post" action = "write_file.php">
<input type = "text" name ="filtered" id = "filtered" hidden>
<br>
<input type ="submit" value = "Write Filtered Data to File">
</form>

<br>
<br>


<form id = "upload_to_database" action ="upload_to_database.php" method = "post">

<input type = "text" name = "filtered" id = "filtered" hidden>

<input type = "text" name ="myip" id="myip" hidden>

<input type = "submit" value = "Upload Filtered Data to Database">
</form>



<script>


var x = document.getElementById('write_to_file');

x.style.display = 'none';

var y = document.getElementById('upload_to_database');

y.style.display = 'none';

document.getElementById('import').onclick = function() {
    var files = document.getElementById('selectFiles').files;
  if (files.length <= 0) {
    return false;
  }

  var fr = new FileReader();

  fr.onload = function(e) { 
  
  //anrtimetopizoume to arxeio san ena json arxeio
    var result = JSON.parse(e.target.result);
	
	  var mystr = "{";
	  mystr=mystr + "\"entries\": [";
	//var mydata = result['log']['entries'][0]['request']['headers'][0]['value'];
	
	var mydata = result['log']['entries'];
	for(var i=0;i<mydata.length;i++)
	{
		mystr = mystr + "{";
		
		mystr  = mystr + "\"startedDateTime\":";
		mystr = mystr + "\"";
		mystr = mystr + mydata[i]['startedDateTime'];
		mystr = mystr + "\"";
		mystr = mystr + ",";
		
		mystr = mystr + "\"serverIPAddress\":";
		mystr = mystr + "\"";
		mystr = mystr + mydata[i]['serverIPAddress'];
		mystr = mystr + "\"";
		mystr = mystr + ",";
		
		mystr = mystr + "\"timings\": {";
		mystr = mystr + "\"wait\":";
		mystr = mystr + mydata[i]['timings']['wait'];
		mystr = mystr + "}";
		mystr = mystr + ",";
		
		mystr = mystr + "\"request\": {";
		
		mystr = mystr + "\"method\": ";
		mystr = mystr + "\"";
		mystr=mystr + (mydata[i]['request']['method']);
		mystr = mystr + "\"";

		mystr = mystr + ",";
		
		mystr = mystr + "\"url\": ";
		mystr = mystr + "\"";
		
		var urlParts = mydata[i]['request']['url'].replace('http://','').replace('https://','').split(/[/?#]/);
		var domain = urlParts[0];

		mystr = mystr + domain;
		mystr = mystr + "\"";

		mystr = mystr + ",";
		
		mystr = mystr + "\"headers\":[";
		
	   var headers_request = mydata[i]['request']['headers'];
        
		var counter = 0;
		for(var j = 0;j<headers_request.length;j++)
		
		{
			
		   if(headers_request[j]['name']=='Content-Type' || headers_request[j]['name']=='content-type' )
		      
			  {
			   
			   if(counter>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter = counter + 1;
				   }
				
				  
			  mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  mystr = mystr + "\"";

			  mystr = mystr + headers_request[j]['name'];
			  mystr = mystr + "\"";

			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  mystr = mystr + "\"";

			  mystr=mystr + headers_request[j]['value'];
			  
			  mystr = mystr + "\"";

			  
			  mystr = mystr + "}";
			  
			    
				  
			  
		      }
			  
	      if(headers_request[j]['name']=='Cache-Control' || headers_request[j]['name']=='cache-control'  )
		      
			  {
				  
				  
				  if(counter>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter = counter + 1;
				   }
				
				  
			  mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  mystr = mystr + "\"";

			  mystr = mystr + headers_request[j]['name'];
			  mystr = mystr + "\"";

			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  
			  mystr = mystr + "\"";

			  mystr=mystr + headers_request[j]['value'];
			  
			  mystr = mystr + "\"";

			  mystr = mystr + "}";
				  
				  
				  
		      }
			  
		if(headers_request[j]['name']=='pragma'||headers_request[j]['name']=='Pragma' )
		      
			  {
				  if(counter>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter = counter + 1;
				   }
				
				  
			  mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  
			  mystr = mystr + "\"";

			  mystr = mystr + headers_request[j]['name'];
			  mystr = mystr + "\"";

			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  
			  mystr = mystr + "\"";

			  mystr= mystr + headers_request[j]['value'];
			  
			  mystr = mystr + "\"";

			  
			  mystr = mystr + "}";
				  
		      }	

        if(headers_request[j]['name']=='Expires'||headers_request[j]['name']=='expires' )
		      
			  {
				  if(counter>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter = counter + 1;
				   }
				
				  
			  mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  
			  mystr = mystr + "\"";

			  mystr = mystr + headers_request[j]['name'];
			  
			  mystr = mystr + "\"";

			  
			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  
			  mystr = mystr + "\"";

			  mystr=mystr + headers_request[j]['value'];
			  
			  mystr = mystr + "\"";

			  mystr = mystr + "}";
				  
		      }	

        if(headers_request[j]['name']=='age' || headers_request[j]['name']=='Age')
		      
			  {
		      
			  if(counter>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter = counter + 1;
				   }
				
				  
			  mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  	mystr = mystr + "\"";

			  mystr = mystr + headers_request[j]['name'];
			  		mystr = mystr + "\"";

			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  		mystr = mystr + "\"";

			  mystr=mystr + headers_request[j]['value'];
			  		mystr = mystr + "\"";

			  mystr = mystr + "}";
			  
			  
		      }


        if(headers_request[j]['name']=='last-modified'|| headers_request[j]['name']=='Last-Modified')
		      
			  {
				  if(counter>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter = counter + 1;
				   }
				
				  
			  mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  		mystr = mystr + "\"";

			  mystr = mystr + headers_request[j]['name'];
			  		mystr = mystr + "\"";

			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  		mystr = mystr + "\"";

			  mystr=mystr + headers_request[j]['value'];
		mystr = mystr + "\"";
			  
			  mystr = mystr + "}";
		      }


        if(headers_request[j]['name']=='Host'|| headers_request[j]['name']=='host')
		      
			  {
				  if(counter>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter = counter + 1;
				   }
				
				  
			  mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  
			  		mystr = mystr + "\"";

			  
			  mystr = mystr + headers_request[j]['name'];
			  
			  		mystr = mystr + "\"";

			  
			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  		mystr = mystr + "\"";

			  mystr=mystr + headers_request[j]['value'];
			  		mystr = mystr + "\"";

			  mystr = mystr + "}";
		      }			  
		
		}
		
		
     mystr = mystr + "]";		
		
		mystr = mystr + "},";
		
		
		mystr = mystr + "\"response\":{";
		mystr  = mystr + "\"status\":";
				mystr = mystr + "\"";

		mystr = mystr + mydata[i]['response']['status'];
				mystr = mystr + "\"";

		mystr = mystr + ",";
		
		mystr = mystr + "\"statusText\":";
				mystr = mystr + "\"";

		mystr = mystr + mydata[i]['response']['statusText'];
		
				mystr = mystr + "\"";

		
	    mystr = mystr + ",";

       mystr = mystr + "\"headers\":[";
	   
		   
	   var headers_response = mydata[i]['response']['headers'];
	   
        
	var counter2 = 0;
	
   for(var k = 0;k<headers_response.length;k++)
		
		{
		    if(headers_response[k]['name']=='content-type'||headers_response[k]['name']=='Content-Type')
		      
			  {
			   
			   if(counter2>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter2 = counter2 + 1;
				   }
				
				  
			  mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  
			  mystr = mystr + "\"";

			  mystr = mystr + headers_response[k]['name'];
			  
			  		mystr = mystr + "\"";

			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  
			  		mystr = mystr + "\"";

			  
			  mystr=mystr + headers_response[k]['value'];
			  
			  		mystr = mystr + "\"";

			  
			  mystr = mystr + "}";
			  
			    
				  
			  
		      }
			  
	      if(headers_response[k]['name']=='cache-control'|| headers_response[k]['name']=='Cache-Control')
		      
			  {
			   
			   if(counter2>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter2 = counter2 + 1;
				   }
				
				  
			   mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  
			  mystr = mystr + "\"";

			  mystr = mystr + headers_response[k]['name'];
			  
			  		mystr = mystr + "\"";

			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  
			  		mystr = mystr + "\"";

			  
			  mystr=mystr + headers_response[k]['value'];
			  
			  		mystr = mystr + "\"";

			  
			  mystr = mystr + "}";
			  
			    
				  
			  
		      }
			  
		if(headers_response[k]['name']=='pragma'||headers_response[k]['name']=='Pragma')
		      
			  {
			   
			   if(counter2>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter2 = counter2 + 1;
				   }
				
				  
			   mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  
			  mystr = mystr + "\"";

			  mystr = mystr + headers_response[k]['name'];
			  
			  		mystr = mystr + "\"";

			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  
			  		mystr = mystr + "\"";

			  
			  mystr=mystr + headers_response[k]['value'];
			  
			  		mystr = mystr + "\"";

			  
			  mystr = mystr + "}";
			  
			    
				  
			  
		      }

        if(headers_response[k]['name']=='expires'|| headers_response[k]['name']=='Expires')
		      
			  {
			   
			   if(counter2>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter2 = counter2 + 1;
				   }
				
				  
			   mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  
			  mystr = mystr + "\"";

			  mystr = mystr + headers_response[k]['name'];
			  
			  		mystr = mystr + "\"";

			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  
			  		mystr = mystr + "\"";

			  
			  mystr=mystr + headers_response[k]['value'];
			  
			  		mystr = mystr + "\"";

			  
			  mystr = mystr + "}";
			  
			    
				  
			  
		      }

        if(headers_response[k]['name']=='age'||headers_response[k]['name']=='Age')
		      
			  {
			   
			   if(counter2>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter2 = counter2 + 1;
				   }
				
				  
			   mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  
			  mystr = mystr + "\"";

			  mystr = mystr + headers_response[k]['name'];
			  
			  		mystr = mystr + "\"";

			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  
			  		mystr = mystr + "\"";

			  
			  mystr=mystr + headers_response[k]['value'];
			  
			  		mystr = mystr + "\"";

			  
			  mystr = mystr + "}";
			  
			    
				  
			  
		      }


        if(headers_response[k]['name']=='last-modified'||headers_response[k]['name']=='Last-Modified')
		      
			  {
			   
			   if(counter2>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter2 = counter2 + 1;
				   }
				
				  
			   mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  
			  mystr = mystr + "\"";

			  mystr = mystr + headers_response[k]['name'];
			  
			  		mystr = mystr + "\"";

			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  
			  		mystr = mystr + "\"";

			  
			  mystr=mystr + headers_response[k]['value'];
			  
			  		mystr = mystr + "\"";

			  
			  mystr = mystr + "}";
			  
			    
				  
			  
		      }

           
		   if(headers_response[k]['name']=='host'||headers_response[k]['name']=='Host')
		      
			  {
			   
			   if(counter2>=1)
			   {
				   mystr = mystr + ",";
				   
			   }
			   
			   else
				   
				   {
					   counter2 = counter2 + 1;
				   }
				
				  
			   mystr = mystr + "{";

		      mystr = mystr + "\"name\":";
			  
			  mystr = mystr + "\"";

			  mystr = mystr + headers_response[k]['name'];
			  
			  		mystr = mystr + "\"";

			  mystr = mystr + ",";
			  mystr = mystr + "\"value\":";
			  
			  		mystr = mystr + "\"";

			  
			  mystr=mystr + headers_response[k]['value'];
			  
			  		mystr = mystr + "\"";

			  
			  mystr = mystr + "}";
			  
			    
				  
			  
		      }
        	  
		
		}


	    mystr = mystr + "]";
		
		mystr = mystr  + "}";
		
		mystr = mystr + "}";
		
		if(i!=mydata.length-1)
			
			{
				mystr=mystr + ",";
			}
		
	}
	
	mystr = mystr + "]";
	
	  mystr = mystr + "}";
	
	console.log(mystr);
    
	  document.getElementById("epiloges").innerHTML = "Filtering Done with success";

	  var x = document.getElementById('write_to_file');
	  
	  x.style.display = 'block';
	  
	  var y = document.getElementById('upload_to_database');
	  
	  y.style.display = 'block';

	  	  document.getElementById("write_to_file").elements["filtered"].value = mystr;
		  
		  document.getElementById("upload_to_database").elements["filtered"].value = mystr;


	  

  }

  fr.readAsText(files.item(0));
  
};

$.getJSON("https://api.ipify.org?format=json", 
                                          function(data) { 
  
            // Setting text of element P with id gfg 
    document.getElementById("upload_to_database").elements["myip"].value = data.ip;
        }) 
</script>

<div id ="epiloges"> </div>
<br>
<br>


</html>