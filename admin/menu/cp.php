<?php
if(!isset($_SESSION['usr']))
{
    header("Location: ../../invalid.php");
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
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
.modal {
  display: none;
  position: fixed;
  z-index: 1; 
  padding-top: 100px; 
  left: 0;
  top: 0;
  width: 100%;
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4);
}
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 10px;
  border-radius: 20px;
  width: 30%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

.close {
  color: white;
  float: right;
  color: black;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.npass
{
  background-color: #1df224;
  padding: 5px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  font-size: 16px;
}
.modal-body {padding: 2px 16px;}

.cp
{
  color: black;
}

.cpin
{
  padding: 5px;
  font-size: 16px;
  border-radius: 10px;
  border: none;
}
</style>
</head>
<body>
<button id="myBtn" class="change"><span>Change Password</span></button>
<form method="POST"><button class="logout" name="clear"><span>Logout</span></button></form>

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
          <button name="change" class="npass"><span>Confirm</span></button>
        </div>
      </form>
    </div>
  </div>
</div>

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

</body>
</html>
<?php
if(isset($_POST['change']))
{
  $ok=0;
  $oldpass=$_POST['oldpass'];
  $newpass=$_POST['newpass'];
  $newpass2=$_POST['newpass2'];

  $conn=mysql_connect("localhost","root","");
  $db=mysql_select_db("e-learning",$conn);
  $qry="SELECT password from administrator";
  $ret=mysql_query($qry);
  if($row=mysql_fetch_assoc($ret))
  {
    $p=$row['password'];
  if($p==md5($oldpass))
  {
    if($newpass==$newpass2)
    {
      $qry="TRUNCATE administrator";
      if(mysql_query($qry))
      {
        $ok=1;
      }
      if($ok==1)
      {
        $username="administrator";
        $password=md5($newpass);
        $qry="INSERT into administrator values('$username','$password')";
        if(mysql_query($qry))
        {
          echo "<script>alert('Password Changed');</script>";
        }
      }
    }
  }
  }
}
?>