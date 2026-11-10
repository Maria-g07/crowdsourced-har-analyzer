<?php

session_start();

$username = $_SESSION["username"];

?>

<html>

<head>
<link rel="stylesheet" href="mystyle.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	
	var username = "<?php echo($username); ?>";
	
	console.log(username);
	
	$.ajax({
                url:'get_last_upload.php',
				
				data: {username:username},

                type:'post',
                
                success:function(response){
                   

                    $("#last_upload").html(response);
				   

                }
            });		
	
	
	$.ajax({
                url:'get_count_records.php',

                type:'post',
				
				data: {username:username},
                
                success:function(response){
                   

                    $("#count_records").html(response);
				   

                }
            });
	
	
	
    $("#edit_button").click(function(){
        var username = $("#edit_username").val().trim();
        var password = $("#edit_password").val().trim();

        if( username != "" && password != "" ){
            $.ajax({
                url:'check_edit.php',
                type:'post',
                data:{username:username,password:password},
                success:function(response){
                    var msg = "";
                    if(response==0){
                        msg = "User Exists";
                    }else{
                        msg = "Update done!!!!!";
						
						
                    }
                    $("#message").html(msg);
                }
            });
        }
    });
});
</script>


</head>






<?php


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

<table>
<tr>
<td>
<div id = "last_upload"> </div>
</td>

<td>
<div id = "count_records"> </div>
</td>

</tr>
</table>

<div id="div_edit">
        <div id="message"></div>
        <div>
		New Username:
            <input type="text"  id="edit_username" name="edit_username" />
			<br>
        </div>
        <div>
		New Password:
            <input type="password" id="edit_password" name="edit_password"/>
			<br>
        </div>
        <div>
            <input type="button" value="Edit Account Info" name="edit_button" id="edit_button" />
			<br>
        </div>
    </div>


</html>