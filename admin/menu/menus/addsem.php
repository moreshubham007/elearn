<?php
if(!isset($_SESSION['usr']))
{
    header("Location: ../../../invalid.php");
    exit();
}
?>
<form method="POST">
  <h2>Add Semester & Subject</h2><p style="font-size: 12px;">(To View added semester & Subject visit add teacher page...)</p>
  <table>
    <tr>
      <td>
        <label>Semester: </label>
      </td>
      <td>
        <input class="addteacher" type="number" placeholder="Semester" name="sem" required>
      </td>
    </tr>
    <tr>
      <td>
        <label>Subject: </label>
      </td>
      <td>
        <?php
        for($i=1;$i<=15;$i++)
        {
          ?>
          <input class="addteacher" type="text" placeholder="sub<?php echo "$i" ?>" name="subjects[]">
          <?php
        }
        ?>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
          <button class="sbutton" name="addsub"><sapn>Add</span></button>
      </td>
    </tr>
  </table>
</form>
<form style="padding: 10px;" method="POST">
  <h2>Delete Semester:</h2>
  <select name="delsem" class="addteacher">
    <option value="no">
      --Select--
    </option>
        <?php
    $qry="SELECT * from semsub";
    $ret=mysql_query($qry);
    if(mysql_num_rows($ret)>0)
    {
      while($ro=mysql_fetch_assoc($ret))
      {
        $sr=$ro['sr'];
        $semester=$ro['semester'];
        ?>
        <option value="<?php echo $sr ?>"><?php echo $semester; ?></option>
        <?php
      }
    }
    ?>
  </select>
  <button name="del" class="delbutton">Delete</button>
</form>
<!-- DELETE -->
<?php
if(isset($_POST['del']))
{
  $delsem=$_POST['delsem'];
  if($delsem=="no")
  {
        echo "<script>
        alert('No Semester Selected');
        </script>";
  }
  else
  {
    $qry="DELETE from semsub where sr=$delsem";
    if(mysql_query($qry))
    {
      ?>
      <script type="text/javascript">
        alert("Semester Deleted");
        window.location.href='ahome.php';
      </script>
      <?php
    }
  }
}
?>
<!-- INSERT -->
<?php
if(isset($_POST['addsub']))
{
  if(!empty($_POST['subjects']))
  {
    $subject="";
    foreach($_POST['subjects'] as $sub) {
      if(!empty($sub))
      {
        $subject=$subject."@#$".$sub;
      }
    }
  }
  $semester="Semester-".$_POST['sem'];
// 
    $qry="SELECT * from semsub";
    $ret=mysql_query($qry);
    if(mysql_num_rows($ret)>0)
    {
      while($ro=mysql_fetch_assoc($ret))
      {
        $semold=$ro['semester'];
        if($semold==$semester)
        {
        $stop=1;
        }
      }
    }
// 
    if($stop==1)
    {
        echo "<script>
        alert('Semester Already Found...! Delete Them First');
        </script>";      
    }
    else
    {
    if($subject!="")
    {
      $qry="INSERT into semsub values('sr','$semester','$subject')";
      if(mysql_query($qry))
      { 
        echo "<script>
        alert('Semester and Subject Inserted');
        window.location.href='ahome.php';
        </script>";
      }
    }
    else
    {
          echo "<script>
          alert('No Subject Selected ... You Can Add later');
          </script>";
    }
    }
}
?>