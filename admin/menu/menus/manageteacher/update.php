<?php
if(!isset($_SESSION['usr']))
{
    header("Location: ../../../../invalid.php");
    exit();
}
?>

<?php
$serial=$sr;
if(isset($_POST['close']))
{
        echo "<script>
        window.location.href='ahome.php';
        </script>";
}
$qry="SELECT * from teacher where sr=$sr";
$retval=mysql_query(($qry));
if(mysql_num_rows($retval)>0)
{
while($row=mysql_fetch_assoc($retval))
{
  $s=$row['sr'];
  $fname=$row['fname'];
  $mname=$row['mname'];
  $lname=$row['lname'];
  $tid=$row['tid'];
  $semester1=$row['semester'];
  $subjects1=$row['subjects'];
  $tphone=$row['tphone'];
  $tpass=$row['tpass'];

  $mySub = explode('%&~', $subjects1);
  $con="";
  $semester1=substr($semester1,1);
  foreach($mySub as $val)
  {
    $con=$val.", ".$con;
  }
  $s=strlen($con);
  $exac=substr($con,0,$s-4);  
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Update !</title>
  <style type="text/css">
    .update
    {
          border-radius: 20px;
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
          border: none;
          font-size: 20px;
          max-width: 100%;
          padding: 20px;
    }
    .addteacher
    {
      line-height: 30px;
      padding: 12px 15px;
      margin: 5px 0;
      max-width: 75%;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      /*box-sizing: border-box;*/
      font-size: 18px;
    }
.sbutton
{
  background-color: #08ff77;
  padding: 12px 40px;
  cursor: pointer;
  /*margin: 8px 0;*/
  border-radius: 4px;
  border: none;
  font-size: 18px;
}

    .centers
    {
      padding: 20px;
    }
table {
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  border-bottom: 2px solid #ddd;
}
.column {
  float: left;
  width: 33.33%;
  border: 1px solid #ccc;
  border-radius: 10px;
  padding:5px;
}

.home
{
  border-radius: 10px;
  border: none;
  padding: 5px;
  font-size: 18px;
  cursor: pointer;
  background-color: #FF8800;
  color: black;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.home:hover
{
  background-color: #F4F4F4;
}
</style>
</head>
<body>
<br>
<br>
<form method="POST"><button class="home"><span>Home</span></button></form>
<br>
<div class="update">
  <h2>Update Detail</h2>
  <form method="POST">
      <table align="center">
        <tr>
          <td>
            <label>Enter Full Name: </label>    
          </td>
          <td>
            <input class="addteacher" type="name" placeholder="First Name" name="fname" value="<?php echo "$fname" ?>">
            <input class="addteacher" type="name" placeholder="Middle Name(Optional)" name="mname" value="<?php echo "$mname" ?>">
            <input class="addteacher" type="name" placeholder="Last Name" name="lname" value="<?php echo "$lname" ?>">
          </td>
        </tr>
        <tr>
          <td>
            <label>Teacher ID: </label>
          </td>
          <td>
            <input type="text" class="addteacher" placeholder="Teacher ID" name="tid" value="<?php echo "$tid" ?>">  
          </td>
        </tr>
        <tr>
          <td>

            <label style="margin-bottom: 0px;padding-bottom: 0px;">Select New<br> Semester &<br> Subject:</label><br>
            <!-- <p style="font-size: 12px;">(Semester Automatically picked)</p>     -->
          </td>
          <td>
            <label style="font-weight: bold;">Previous Semesters: </label><?php echo $semester1 ?><br>
            <label style="font-weight: bold;">Previous Subjects:</label><?php echo $exac ?>
            <div class="row">
                  <?php
                    $conn=mysql_connect("localhost","root","");
                    $db=mysql_select_db("e-learning",$conn);
                    $subarray=array();
                    $qry="SELECT * from semsub";
                    $retval=mysql_query($qry);
                    if(mysql_num_rows($retval)>0)
                    {
                      $repeat="0";
                      while($row = mysql_fetch_assoc($retval))
                      {
                      $sr=$row['sr'];
                      $semester=$row['semester'];
                      $subject=$row['subject'];
                      $myArray = explode('@#$', $subject);
                      ?>

                      <div class="column">
                        <input type="checkbox" name="semester[]" id="<?php echo "mySubs".$sr ?>"  onclick="<?php echo "mySemester".$sr ?>()" value="<?php echo "$semester" ?>"><?php echo "$semester" ?><br>
                      <div id="<?php echo "text".$sr ?>" style="display:none">
                      <?php
                      foreach($myArray as $sub){
                        if(!empty($sub))
                        {
                        ?>
                        <input type="checkbox" name="subjects[]" value="<?php echo $sub ?>"><?php echo $sub ?><br>
                        <?php
                        }
                      }
                      ?>
                      </div>
                      </div>
                          <script>
                          function <?php echo "mySemester".$sr ?>() {
                            var checkBox = document.getElementById("<?php echo "mySubs".$sr ?>");
                            var <?php echo "text".$sr ?> = document.getElementById("<?php echo "text".$sr ?>");
                            if (checkBox.checked == true){
                              <?php echo "text".$sr ?>.style.display = "block";
                            } else {
                               <?php echo "text".$sr ?>.style.display = "none";
                            }
                          }
                          </script>
                      <?php
                      }
                    }
                  ?>
                </div>
          </td>
        </tr>
        <tr>
          <td><label>Mobile No.:</label></td>
          <td>
            <input class="addteacher" type="name" minlength="10" maxlength="10" name="tphone" value="<?php echo "$tphone" ?>">
          </td>
        </tr>
        <tr>
          <td><label>Password:</label></td>
          <td>
            <input type="password" class="addteacher" name="tpass" minlength="8"  id="myInput" value="<?php echo $tpass ?>">
             <!-- <label>(Increpted Password is shown)</label><br> -->
          </td>
        </tr>
        <tr>
          <td></td><td><button value="<?php echo $serial ?>" class="sbutton" name="uteacher"><span>Update</span></button>
            <?php echo " "; ?><button name="close" class="sbutton"><span>Cancle</span></button></td>
        </tr>
      </table>
      <script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>
</form>
<!-- </div> -->
</div>
</body>
</html>