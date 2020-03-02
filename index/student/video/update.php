<?php
if(!isset($_SESSION['sid']))
{
    header("Location: ../../../invalid.php");
    exit();
}
?>

<?php include("/../../connect/connect.php") ?>
<?php
session_start();
if(!isset($_SESSION['sid']))
{
    header("Location: ../../index.php");
    exit();
}
$stud=$_SESSION['sid'];
$sid=$stud;
if(isset($_POST['clear']))
{
    session_destroy();
    unset($_SESSION['sid']);
    header("Location: index.php");
    clear();
}
$qry="SELECT * from student where sid='$stud'";
$ret=mysql_query($qry);
if($row=mysql_fetch_assoc($ret))
{
	$semester=$row['semester'];
	$sphone=$row['sphone'];
	$fname=$row['fname'];
	$mname=$row['mname'];
	$lname=$row['lname'];
	$sid=$row['sid'];
	$dob=$row['dob'];
	$pass=$row['pass'];
}

if(isset($_POST['change']))
{
	$fname=$_POST['fname'];
	$mname=$_POST['mname'];
	$lname=$_POST['lname'];
	$sphone=$_POST['sphone'];
	$dob=$_POST['dob'];
	$opass=$_POST['opass'];
	$npass=$_POST['npass'];
	if($opass==$pass)
	{
			$qry="UPDATE student SET fname='$fname', mname='$mname', lname='$lname', sphone='$sphone', dob='$dob', pass='$npass' where sid='$sid'";
			if(mysql_query($qry))
			{
				echo "<script>alert('Profile Updated :)');
				window.location.href='index.php';
				</script>";
			}	
	}
	else
	{
		echo "<script>alert('Incorrect Password !');
		window.location.href='index.php';
		</script>";
	}
}
?>