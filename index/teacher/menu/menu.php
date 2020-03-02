<?php
if(!isset($_SESSION['sr'])) 
{
    header("Location: ../../../invalid.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="menu/menu.css">
</head>
<body>
  <div id="show"></div>
<div class="tab">
  <button class="tablinks" onclick="openAdm(event, 'SemSub')"
  <?php
  // if($count==1)
  {
  ?> id="defaultOpen"
  <?php
  }
  ?>
  >View Video</button>

  <button class="tablinks" onclick="openAdm(event, 'ManTeacher')">Add Video</button>

  <button class="tablinks" onclick="openAdm(event, 'ms')">Student Control</button>

</div>

<div id="ManTeacher" class="tabcontent">
    <img src="menu/mantech.png" alt="Pineapple" style="width:300px;height:300px;margin-right:15px;">
    <div class="addteacher">
      <?php include("menus/addvideo.php") ?>
    </div>

</div>

<div id="SemSub" class="tabcontent">
    <img src="menu/vvideo.png" alt="Pineapple" style="width:300px;height:300px;margin-right:15px;">
    <div class="addteacher">
      <?php include("menus/vvideo.php") ?>
    </div>
</div>

<div id="ms" class="tabcontent">
    <img src="menu/student.png" alt="Pineapple" style="width:300px;height:300px;margin-right:15px;">
    <div class="addteacher">
      <?php include("menus/student.php") ?>
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
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      setInterval(function () {
        $('#show').load('index.php')
      }, 3000);
    });
  </script>