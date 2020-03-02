<?php 
include("/../connect/connect.php");

session_start();
if(!isset($_SESSION['usr']))
{
    header("Location: ../invalid.php");
    exit();
}
if(isset($_POST['clear']))
{
    session_destroy();
    unset($_SESSION['usr']);
    header("Location: index.php");
    clear();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="ahome.css">

</head>
<body>

<div class="header">
  <label style="font-size: 30px; ">Welcome to <a style="color: white;" href="ahome.php">Admin Panel</a></label>
  <div class="log">
        <?php include("menu/cp.php") ?>

  </div>

</div>

<?php
if(isset($_POST['go']))
{
  $sort=$_POST['sort'];
  include("menu/menus/control.php");
}
elseif(isset($_POST['update']))
{
    $sr=$_POST['update'];
    include("menu/menus/manageteacher/update.php");
}
elseif(isset($_POST['vview']))
{
    $sr=$_POST['vview'];
    include("menu/menus/manageteacher/vvideo.php");
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
if(isset($_POST['dstud']))
{
  $sid=$_POST['dstud'];
  $qry="SELECT fname from student where sr=$sid";
  $ret=mysql_query($qry);
  if($row=mysql_fetch_assoc($ret))
  {
    $fname=$row['fname'];
  }
  $qry="DELETE from student where sr=$sid";
  if(mysql_query($qry))
  {
      echo "<script>alert('$fname is Removed !');</script>";
      echo "<script>window.location.href='index.php';</script>";
  }
  else
  {
      echo "<script>alert('$sid is Not Removed !');</script>";
  }
}

if(isset($_POST['uteacher']))
{
  $ok=0;
  $sr=$_POST['uteacher'];

  $qry="DELETE from teacher where sr=$sr";
  if(mysql_query($qry))
  {
    $ok=1;
  }

    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $lname=$_POST['lname'];
    $tid=$_POST['tid'];
    $tphone=$_POST['tphone'];
    $tpass=$_POST['tpass'];
    $status="Active";

    $nosub=0;
  if(!empty($_POST['subjects']))
  {
    $subjects="";
    foreach($_POST['subjects'] as $selected)
    {
      // $qr="SELECT * from semsub where "
      $subjects=$subjects."%&~".$selected;
    }
  }
  else
  {
    $subjects="";
  }
  if(!empty($_POST['semester']))
  {
    $semester="";
    foreach($_POST['semester'] as $selected)
    {
      $semester=$semester.", ".$selected;
    }
  }
  else
  {
    $semester="";
    $nosub=1;
  }

  if($ok==1)
  {
  $qry="INSERT into teacher values('sr','$fname','$mname','$lname','$tid','$semester','$subjects','$tphone','$tpass','$status')";
      if(mysql_query($qry))
      { 
        echo "<script>
        alert('Teacher Account Updated');
        window.location.href='ahome.php';
        </script>";
      }
  }
  else
  {
    echo "Not Updated";
  }
}
?>
</body>
</html>
