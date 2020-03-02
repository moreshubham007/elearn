<?php include("/../../connect/connect.php") ?>
<?php

session_start();
if(!isset($_SESSION['sr'])) 
{
    header("Location: ../../index.php");
    exit();
}
$sr=$_SESSION['sr'];
if(isset($_POST['logout']))
{
    session_destroy();
    unset($_SESSION['sr']);
    header("Location: ../../index.php");
    clear();
}

$qry="SELECT * from teacher where sr=$sr";
$retval=mysql_query(($qry));
if(mysql_num_rows($retval)>0)
{
while($row=mysql_fetch_assoc($retval))
{
	$fname=$row['fname'];
  $lname=$row['lname'];
  $semester=$row['semester'];
  $subject=$row['subjects'];
  $status=$row['status'];
  $sr=$row['sr'];
  $tid=$row['tid'];
  $op=$row['tpass'];
  $status=$row['status'];
}
$semester2=$semester;
$subject2=$subject;
$sr2=$sr;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="teacher.css">

</head>
<body>
<div class="header" style="background-color: #f78800">
  <form method="POST">
  <a style="cursor: pointer; color: white;" href="index.php">
  <label style="cursor: pointer; color: white;">Welcome</label><br>
  <label style="font-size: 30px; color: white; cursor: pointer;"><?php echo $fname." ".$lname; ?></label>
  </a>
  <button class="logout" name="logout">Logout</button>
  <br>
  </form>
  <button id="myBtn" style="border-radius: 10px; border: none; background-color: #fabcff; font-size: 16px; cursor: pointer; padding: 5px;">Change Password</button>

  <div id="myModal" class="modal">
    <div class="modal-content">
      <div class="modal-body">
        <span class="close">&times;</span>
        <form method="POST">
          <table class="cp">
            <tr>
              <td>Old Password:</td>
              <td><input class="cpin" type="password" name="oldpass" placeholder="Old Password" required></td>
            </tr>
            <tr>
              <td>New Password*:</td>
              <td><input class="cpin" type="password" name="newpass" placeholder="New Password" required></td>
            </tr>
            <tr>
              <td>Re-Type Password:</td>
              <td><input class="cpin" type="password" name="newpass2" placeholder="Re-Type Password" required></td>
            </tr>
          </table>
          <div style="align-items: center;text-align: center;">
            <br>
            <button name="change" class="npass">Confirm</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<?php
if(isset($_POST['go']))
{
  $sort=$_POST['sort'];
  include("menu/menus/control.php");
}
elseif(isset($_POST['view']))
{
    $count=1;
    $id=$_POST['view'];
    include("menu/menus/manageteacher/update.php");
}
else
{
?>

<div class="row">
    <?php 
    include("menu/menu.php") 
    ?>
</div>
<?php
}
?>
<script>
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<?php
$ok=0;
if(isset($_POST['change']))
{
  $oldpass=$_POST['oldpass'];
  $tpass=$_POST['newpass'];
  $newpass2=$_POST['newpass2'];
  if($oldpass==$op)
  {
    if($tpass==$newpass2)
    {
      $ok=1;
    }
    else
    {
    echo "<script>alert('New Passwords Not match');</script>";
    }
  }
  else
  {
    echo "<script>alert('Incorrect Old Password');</script>";
  }
}
if($ok==1)
{
      $qry1="UPDATE teacher SET tpass='$newpass2' where tid='$tid'";
      if(mysql_query($qry1))
      {
      echo "<script>alert('Password Updated');
        window.location.href='index.php';
      </script>";
      }
      else
      {
      echo "<script>alert('Password Not updated Sign out and try again');</script>";
      }
}
if(isset($_POST['action']))
{
  $sid=$_POST['action'];
  $qry="SELECT status from student where sid='$sid'";
  $ret=mysql_query($qry);
  $row=mysql_fetch_assoc($ret);
  $status=$row['status'];
  if($status=="active")
  {
    $qry="UPDATE student SET status='deactive' where sid='$sid'";
    if(mysql_query($qry))
    {
      echo "<script>alert('$sid is Deactivated !');</script>";
      echo "<script>window.location.href='index.php';</script>";
    }
  }
  else
  {
    $qry="UPDATE student SET status='active' where sid='$sid'";
    if(mysql_query($qry))
    {
      echo "<script>alert('$sid is Activated !');</script>";
      echo "<script>window.location.href='index.php';</script>";
    }
  }
}
?>
</body>
</html>