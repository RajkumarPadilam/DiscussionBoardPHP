<?php
		
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	
		try 
		{

			$dbname = dirname($_SERVER["SCRIPT_FILENAME"]) . "/mydb.sqlite";
			$dbh = new PDO("sqlite:$dbname");	
			
			if(isset($_POST["logout"]))
		{
			if(isset($_SESSION['login']))
			unset($_SESSION['login']);
			if(isset($_SESSION['username']))
			unset($_SESSION['username']);
			if(isset($_SESSION['error']))
			unset($_SESSION['error']);
			session_destroy();
			header('Location: board.php');
			
		}	
		else if(isset($_POST['message']))
		{
				$userName=$_SESSION['username'];
				$message= $_POST['message'];
				
				$id= uniqid();
				$dbh->beginTransaction();
				$dbh->exec("insert into posts(id,postedby,datetime,message) values('$id','$userName',datetime('now'),'$message')")
				   or die(print_r($dbh->errorInfo(), true));
				$dbh->commit();
				//echo "<br>Inserted";
				header("Location: page2.php");

		}
		else if(isset($_POST["submit"]))
		{
			$user=$_POST['username'];
			$paswd=md5($_POST['password']);
			$fullname=$_POST['fullname'];
			$email=$_POST['email'];
			
			//echo "fields :".$user." :".$paswd." :".$fullname." --".$email;
			if( (trim($user)==='') || (trim($_POST['password'])==='') || (trim($fullname)==='') || (trim($email)===''))
			{
				//echo "error";
				$_SESSION['error']="Field Cannot be blank";
				header("Location: newUser.php");
			}
			else
			{
				$stmt = $dbh->prepare("select * from users where username='$user'");
				$stmt->execute();
				$row = $stmt->fetch();
				
				if($row==null)
				{
				
				$dbh->beginTransaction();
				$dbh->exec("insert into users(username,password,fullname,email) values('$user','$paswd','$fullname','$email')");
					//or die(print_r($dbh->errorInfo(), true));
				$dbh->commit();
					$_SESSION['error']="New User has been registered";
					header("Location: board.php");
				}
				else
				{
					$_SESSION['error']="It seems Username already exists";
					header("Location: board.php");
				}
			}
		}
		else if(isset($_POST["NewUserLogin"]))
		{
			header("Location: newUser.php");
		}
		else if((isset($_POST["username"])) && (isset($_POST["login"])))
		{
			$user=$_POST["username"];
			$password=$_POST['password'];
			$password=md5($password);

			//echo "<br>The login button has been clicked $user : $password<br>";
			$stmt = $dbh->prepare("select * from users where username='$user' and password='$password'");
			$stmt->execute();
			$row = $stmt->fetch();
			if($row==null)
			{
				$_SESSION['error']="Invalid Login Credentials. Please try again";
				header("Location: board.php");
			}
			
			else
			{
				session_start(); 
				$_SESSION['username'] = $user; 
				$_SESSION['logged'] = TRUE;
				header("Location: page2.php");
			}
		}
		$dbh=null;
	}
	  catch (PDOException $e) 
	  {
	  print "Error!: " . $e->getMessage() . "<br/>";
	  die();
	  }
	//}
?>