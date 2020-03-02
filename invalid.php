<!DOCTYPE html>
<html>
<head>
  <title>Alert !</title>
  <style type="text/css">
    .block
    {
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
      padding: 100px;
      color: white;
      border-radius: 20px;
      background-color: #f90404;
    }
    .blockbutton
    {
      background-color: white;
      color: black;
      border-radius: 10px;
      padding: 10px;
      font-size: 20px;
      border: none;
      cursor: pointer;
    }
    .blockbutton:hover
    {
      color: blue;
    }
  </style>
</head>
<body>
  <div class="block" align="center">
    <h2>This page is not accessable !</h2>
    <form method="POST">
      <button class="blockbutton" name="clear">Close</button>
    </form>
  </div>
</body>
</html>
<?php
if(isset($_POST['clear']))
{
      header("Location: index.php");
}
?>