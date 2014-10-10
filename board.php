<!--
  Student Name: PADILAM RAJKUMAR	1001041479
  URL: http://omega.uta.edu/~rxp1479/project5/board.php
--> 

<html>
<head><title>Message Board</title></head>
<body bgcolor="#E6E6FA">
<h3 align="center"> MESSAGE BOARD </h3>

<?php

		
		session_start();
		if(isset($_SESSION['error']))
		{echo $_SESSION['error'];unset($_SESSION['error']);}
		
		echo"<br><br><br><form action='verify.php' method='POST'>
		<fieldset><legend><h3>User Login </h3></legend>
		<label>Username: <input type='text' name='username'/></label><br>
		<label>Password: <input type='password' name='password'/></label><br><br>
		<input type='submit' name='login' value='Login'/>
		<input type='submit' name='NewUserLogin' value='New User Login'/>
		</fieldset>   
		</form>
		<br><br>
		</div>";
?>
</body>
</html>