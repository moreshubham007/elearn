<?php
if(!isset($_SESSION['usr']))
{
    header("Location: ../../../invalid.php");
    exit();
}
?>

<form method="POST">
  <h2>All videos:</h2>

  <br>
    <table>
        <tr>
          <th>Sr</th>
          <th>id</th>
          <th>Semester</th>
          <th>Subject</th>
          <th>Title</th>
          <th>Date</th>
          <th>Video</th>
          <th>Docs</th>
          <th></th>
        </tr>
        <?php
        $qry="SELECT * from video  ORDER BY id DESC";
        $ret=mysql_query($qry); 
        if(mysql_fetch_assoc($ret)>0)
        {
          $sr=0;
        while($row=mysql_fetch_assoc($ret))
        {
          $sr++;
          if($row['video']=="")
            { $video="Not Available"; }
          else
            { $video="Available"; }

          if($row['docs']=="")
            { $docs="Not Available"; }
          else
            { $docs="Available"; }

        ?>
        <tr>
          <td><?php echo $sr ?>)</td>
          <td><?php echo $row['tid'] ?></td>
          <td><?php echo $row['semester'] ?></td>
          <td><?php echo $row['subject'] ?></td>
          <td><?php echo $row['title'] ?></td>
          <td><?php echo $row['date'] ?></td>
          <td><?php echo $video ?></td>
          <td><?php echo $docs ?></td>
          <td><button 
            style="
            background-color: #00d153;
            font-weight: bold;
            " class="vbutton" name="vview" value="<?php echo $row['id'] ?>"><span>view</span></button></td>
        </tr>
        <?php
        }
        }
        else
        {
          echo "<h3>No video !</h3>";
        }
        ?>
    </table>
</form>
