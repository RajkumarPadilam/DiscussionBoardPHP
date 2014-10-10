<html>
<head><title>Message Board</title></head>
<body bgcolor="#E6E6FA">
<?php

echo   "<form action='verify.php' method='POST'>
	   <fieldset><legend><h3>New User Signup </h3></legend>
	   <label>Username: <input type='text' name='username'/></label><br>
	   <label>Password: <input type='password' name='password'/></label><br>
	   <label>Fullname:&nbsp; <input type='text' name='fullname'/></label><br>
	   <label>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' name='email'/></label><br><br>
       <input type='Submit' name='submit' value='Submit'/>";
		
		session_start();
		if(isset($_SESSION['error']))
		{echo "<br><br><br>".$_SESSION['error'];unset($_SESSION['error']);}
		
?>

</body>
</html>
