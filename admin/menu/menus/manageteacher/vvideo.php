<?php
if(!isset($_SESSION['usr']))
{
    header("Location: ../../../invalid.php");
    exit();
}
?>

<?php

$qry="SELECT * from video where id='$sr'";
$ret=mysql_query($qry);
if($row=mysql_fetch_assoc($ret))
{
  $video=$row['video'];
  $docs=$row['docs'];
  $semester=$row['semester'];
  $subject=$row['subject'];
  $date=$row['date'];
  $title=$row['title'];
  $description=$row['description'];
  $tid=$row['tid'];
}

$qry="SELECT * from teacher where tid='$tid'";
$ret=mysql_query($qry);
if($row=mysql_fetch_assoc($ret))
{
  $fname=$row['fname'];
  $lname=$row['lname'];
}
else
{
  echo "Error !";
}
?>
<br>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}

video {
  width: 100%;
  height: auto;
}

.row:after {
  content: "";
  clear: both;
  display: table;
}

[class*="col-"] {
  float: left;
  padding: 15px;
  width: 100%;
}

@media only screen and (min-width: 600px) {
  .col-s-1 {width: 8.33%;}
  .col-s-2 {width: 16.66%;}
  .col-s-3 {width: 25%;}
  .col-s-4 {width: 33.33%;}
  .col-s-5 {width: 41.66%;}
  .col-s-6 {width: 50%;}
  .col-s-7 {width: 58.33%;}
  .col-s-8 {width: 66.66%;}
  .col-s-9 {width: 75%;}
  .col-s-10 {width: 83.33%;}
  .col-s-11 {width: 91.66%;}
  .col-s-12 {width: 100%;}
}

@media only screen and (min-width: 768px) {
  .col-1 {width: 8.33%;}
  .col-2 {width: 16.66%;}
  .col-3 {width: 25%;}
  .col-4 {width: 33.33%;}
  .col-5 {width: 41.66%;}
  .col-6 {width: 50%;}
  .col-7 {width: 58.33%;}
  .col-8 {width: 66.66%;}
  .col-9 {width: 75%;}
  .col-10 {width: 83.33%;}
  .col-11 {width: 91.66%;}
  .col-12 {width: 100%;}
}

html {
  font-family: "cambria";
}

.header {
  background-color: #9933cc;
  color: #ffffff;
  padding: 15px;
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  font-size: 18px;
  border-radius: 10px;
}

.menu li {
  border-radius: 10px;
  padding: 8px;
  font-size: 18px;
  margin-bottom: 7px;
  background-color: #33b5e5;
  color: #ffffff;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.menu li:hover {
  cursor: default;
  border-bottom-left-radius: 20px;
  background-color: #0099cc;
  font-size: 20px;
}

.aside {
  background-color: #33b5e5;
  padding: 15px;
  color: #ffffff;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  text-align: justify;
  text-justify: inter-word;
  border-radius: 20px;
}

.aside:hover
{
  font-size: 20px;
}

.desc
{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  border-bottom-left-radius: 20px;
  border-bottom-right-radius: 20px;
}
</style>
</head>
<body>

<div class="header">
  <h1><?php echo $subject ?></h1>
</div>

<div class="row">
  <div align="left" class="col-3 col-s-3 menu">
    <ul>
      <li>Teacher: <?php echo $fname." ".$lname ?></li>
      <li>Semester: <?php echo $semester ?></li>
      <li>Subject: <?php echo $subject ?></li>
      <li>Date: <?php echo $date ?></li>
    </ul>
  </div>

  <div class="col-6 col-s-9 desc">
    <h1><?php echo $title ?></h1>

    <video width="400" controls>
      <source src="../index/teacher/menu/menus/video/<?php echo $video ?>" type="video/mp4">
      Your browser does not support HTML5 video.
    </video>
    <h3>Documents:</h3>
    <?php
    if($docs!="")
    {
    ?>
      <label>Download available...! </label>
      <a href="../index/teacher/menu/menus/docs/<?php echo $docs ?>" download="<?php echo $docs ?>">Click Here</a>
    <?php
    }
    else
    {
      echo "No Document !";
    }
    ?>
  </div>

  <div class="col-3 col-s-12">
    <div class="aside">
      <h2>Description:</h2>
      <p style="font-size: 20px;"><?php echo $description ?></p>
    </div>
  </div>
</div>

</body>
</html>
