<?php
if(!isset($_SESSION['usr']))
{
    header("Location: ../../../invalid.php");
    exit();
}
?>
<form method="POST">
      <table>
        <tr>
          <td>
            <label>Enter Full Name: </label>    
          </td>
          <td>
            <input class="addteacher" type="name" placeholder="First Name" name="fname" required>
            <input class="addteacher" type="name" placeholder="Middle Name(Optional)" name="mname">
            <input class="addteacher" type="name" placeholder="Last Name" name="lname" required>
          </td>
        </tr>
        <tr>
          <td>
            <label>Teacher ID: </label>
          </td>
          <td>
            <input type="text" class="addteacher" placeholder="Teacher ID" name="tid" required>  
          </td>
        </tr>
        <tr>
          <td>
            <label style="margin-bottom: 0px;padding-bottom: 0px;">Select Semester<br> &<br> Subject:</label><br>
            <!-- <p style="font-size: 12px;">(Semester Automatically picked)</p>     -->
          </td>
          <td>
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
            <input class="addteacher" type="name" minlength="10" maxlength="10" name="tphone" required>
          </td>
        </tr>
        <tr>
          <td><label>Password:</label></td>
          <td>
            <input type="password" class="addteacher" name="tpass" minlength="8"  id="myInput"><br>
            <input type="checkbox" onclick="myFunction()">Show Password
          </td>
        </tr>
        <tr>
          <td></td><td><button class="sbutton" name="cteacher"><span>Create</span></button></td>
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
<?php
if(isset($_POST['cteacher']))
{
  $tid=$_POST['tid'];
  $ok=0;
  $qry="SELECT tid from teacher";
  $ret=mysql_query($qry);
  while($row=mysql_fetch_assoc($ret))
  {
    $check=$row['tid'];
    if(strtoupper($tid)==strtoupper($check))
    {
        echo "<script>
        alert('Teacher id already Registered...!');
        </script>";
        $ok=1;
    }
  }

  if($ok==0)
  {
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $lname=$_POST['lname'];
    $tphone=$_POST['tphone'];
    $tpass=$_POST['tpass'];
    $status="Active";
  if(!empty($_POST['subjects']))
  {
    $subjects="";
    foreach($_POST['subjects'] as $selected)
    {
      // $qr="SELECT * from semsub where "
      $subjects=$subjects."%&~".$selected;
    }
  }
  if(!empty($_POST['semester']))
  {
    $semester="";
    foreach($_POST['semester'] as $selected)
    {
      // $qr="SELECT * from semsub where "
      $semester=$semester.", ".$selected;
    }
  }
  else
  {
    echo "<script>alert('No Subject Selected... You can Add Subjects by updating Teacher');</script>";
  }
  $qry="INSERT into teacher values('sr','$fname','$mname','$lname','$tid','$semester','$subjects','$tphone','$tpass','$status')";
      if(mysql_query($qry))
      { 
        echo "<script>
        alert('Teacher Account Created');
        window.location.href='ahome.php';
        </script>";
      }
}
}
?>