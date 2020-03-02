		<form method="POST" action="index.php">
			<h3><label>Username</label></h3>
			<input type="text" name="usr" placeholder="username" required><br>
			<h3><label>Password</label></h3>
			<input type="password" name="pass" placeholder="password" required><br>
			<button name="log"><span>Login</span></button>
		</form>
<?php include("/../connect/connect.php") ?>
<?php
session_start();
if(isset($_SESSION['usr']))
{
    header("Location: ahome.php");
    exit();
}
if(isset($_POST['log'])){
	$pass=$_POST['pass'];
	$pass=md5($pass);
	$logsql = 'SELECT * FROM administrator';
	$retval=mysql_query($logsql);
	while($row = mysql_fetch_assoc($retval))
	{  
		 	$admin=$row['username'];
			$apass=$row['password'];
	}
	if($admin=$_POST['usr'] && $apass==$pass)
	{
		$apass="0";
			if(isset($_SESSION['usr']))
			{
				$url="ahome.php";
				header("Location:".$url);
				exit();
			}
			else if(isset($_POST['usr']))
			{
				$usr=$_POST['usr'];
				$_SESSION['usr']=$usr;
				$url="ahome.php";
				header("Location:".$url);
				exit();
			}
	}
	else
	{
		echo "Invalid Username or Password";
	}
}
?>