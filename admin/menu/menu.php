<?php
if(!isset($_SESSION['usr']))
{
    header("Location: ../../invalid.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="menu/menu.css">
</head>
<body>
<div class="tab">
  <button class="tablinks" onclick="openAdm(event, 'ManTeacher')" id="defaultOpen">Manage Teacher</button>
  <button class="tablinks" onclick="openAdm(event, 'AddTeach')">Add Teacher</button>
  <button class="tablinks" onclick="openAdm(event, 'SemSub')">Semester & Subject</button>
  <button class="tablinks" onclick="openAdm(event, 'ms')">Manage Student</button>
  <button class="tablinks" onclick="openAdm(event, 'wv')">Watch Video</button>

</div>

<div id="ManTeacher" class="tabcontent">
    <img src="menu/mantech.png" alt="Pineapple" style="width:300px;height:300px;margin-right:15px;">
    <div class="addteacher">
      <?php include("menus/manageteacher.php") ?>
    </div>
</div>

<div id="AddTeach" class="tabcontent">
    <img src="menu/addt.png" alt="Pineapple" style="width:300px;height:300px;margin-right:15px;">
    <div class="addteacher">
      <?php include("menus/addteacher.php") ?>
    </div>
</div>

<div id="SemSub" class="tabcontent">
    <img src="menu/addsem.png" alt="Pineapple" style="width:300px;height:300px;margin-right:15px;">
    <div class="addteacher">
      <?php include("menus/addsem.php") ?>
    </div>
</div>

<div id="ms" class="tabcontent">
    <img src="menu/student.png" alt="Pineapple" style="width:300px;height:300px;margin-right:15px;">
    <div class="addteacher">
      <?php include("menus/student.php") ?>
    </div>
</div>

<div id="wv" class="tabcontent">
    <img src="menu/video.png" alt="Pineapple" style="width:300px;height:300px;margin-right:15px;">
    <div class="addteacher">
      <?php include("menus/video.php") ?>
    </div>
</div>

<script>
function openAdm(evt, admName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(admName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
   
</body>
</html> 
