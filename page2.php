<html>
<head><title>Message Board</title></head>
<body bgcolor="#E6E6FA">


<?php
	session_start(); 
	if(!$_SESSION['logged']){ 
		header("Location: board.php"); 
		exit; 
	}
	else{
			$dbname = dirname($_SERVER["SCRIPT_FILENAME"]) . "/mydb.sqlite";
			$dbh = new PDO("sqlite:$dbname");
			
			echo 'Welcome, '.$_SESSION['username']; 	
		
			$userName=$_SESSION['username'];
			echo" <br><br><fieldset><legend><h3>Insert a Message</h3></legend>
			<form name='messageBox' action='verify.php' method='POST'>
			<textarea rows='4' cols='50' name='message'></textarea><br><br>	    
			<input type='submit' value='POST'>
			<input type='hidden' value='$userName' name='user'>
			</form>
			</fieldset><br><br>";

			echo "<fieldset><legend><h3>Messages Posted</h3></legend>";	
			echo "<div class='top-div' id='result' style='border:2px solid black;width:600px;height:300px;overflow:auto'>";
			$stmt = $dbh->prepare("select users.username, users.fullname, posts.message, posts.datetime from users,posts where users.username=posts.postedby ORDER BY posts.datetime DESC");
			$stmt->execute();
			while ($row = $stmt->fetch()) {
			echo "<b>".$row['username']." : ".$row['fullname']." at ".$row['datetime']."<br>".$row['message']."</b><br><br>";
			} 
			echo "</div>";
			echo "</fieldset>";
			echo "<form name='messageBox' action='verify.php' method='POST'><br>
				<input type='submit' value='LOGOUT'>
				<input type='hidden' value='logout' name='logout'>
				</form>";
			
			$dbh=null;			
				
	}	
	
?>

</body>
</html>

