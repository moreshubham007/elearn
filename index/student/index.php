<?php include("/../../connect/connect.php") ?>

<?php include("update.php") ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="index.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<?php

if($status=="active")
{
?>
<div class="header" style="background-color: #f78800;">
  <form method="POST">
  <a style="cursor: pointer;color: white;" href="index.php">
  <label style="cursor: pointer;">Welcome</label><br>
  <label style="font-size: 30px; cursor: pointer;"><?php echo $row['fname']." ".$row['lname']; ?>
  </label>  
  </a>
  <button class="logout" name="clear">Logout</button>
  </form>
  <button id="myBtn" style="border-radius: 10px; border: none; background-color: #fabcff; font-size: 16px; cursor: pointer; padding: 5px;">Edit Profile</button>
 </div>

<div class="video">
	<?php
		if(isset($_POST['view']))
		{
		$sub=$_POST['view'];
		include("video/play.php") ;			
		}
		else
		{
		include("video/video.php") ;
		}
	?>
</div>


  <div id="myModal" class="modal">
    <div class="modal-content">
      <div class="modal-body">
        <span class="close">&times;</span>
        <form method="POST">
          <table class="cp">
            <tr>
              <td>Name:</td>
              <td>
              	<input class="cpin" type="text" name="fname" placeholder="First" value="<?php echo $fname ?>" required>
              	<input class="cpin" type="text" name="mname" placeholder="Middle" value="<?php echo $mname ?>" required>
              	<input class="cpin" type="text" name="lname" placeholder="Last" value="<?php echo $lname ?>" required>
              </td>
            </tr>
            <tr>
              <td>Student id:</td>
              <td><input style="cursor: not-allowed;" class="cpin" type="text" name="sid" placeholder="<?php echo $stud ?>" value="<?php echo $stud ?>" disabled></td>
            </tr>
            <tr>
              <td>Semester:</td>
              <td><input style="cursor: not-allowed;" class="cpin" type="text" name="semester" placeholder="<?php echo $semester ?>" value="<?php echo $semester ?>" disabled></td>
            </tr>
            <tr>
              <td>Phone:</td>
              <td><input class="cpin" type="text" name="sphone" minlength="10" maxlength="10" placeholder="phone" value="<?php echo $sphone ?>" required></td>
            </tr>
            <tr>
              <td>Date of Birth:</td>
              <td><input class="cpin" type="date" name="dob" value="<?php echo $dob ?>" placeholder="sid" required></td>
            </tr>
            <tr>
              <td>Old Password:</td>
              <td><input class="cpin" type="password" minlength="8" name="opass" placeholder="Old password" required></td>
            </tr>
            <tr>
              <td>New Password:</td>
              <td><input class="cpin" type="password" minlength="8" name="npass" placeholder="New Password" required></td>
            </tr>
            <tr>
            	<td></td>
            	<td><p>(If you dont wan't to change password then repeat type current password)</p></td>
            </tr>
          </table>
          <div style="align-items: center;text-align: center;">
            <br>
            <button name="change" class="npass">Update</button>
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
<?php
}
else
{
  ?>
  <div class="block" align="center">
    <h2>This Account is Blocked ! Please Contact Admin or Teacher...</h2>
    <form method="POST">
      <button class="blockbutton" name="clear">Close</button>
    </form>
  </div>
  <?php
}
?>
</body>
</html>