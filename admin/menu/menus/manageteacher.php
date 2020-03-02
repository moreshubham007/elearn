<?php
if(!isset($_SESSION['usr']))
{
    header("Location: ../../../invalid.php");
    exit();
}
?>
<h2 style="text-align: center;">Teachers</h2>
<form method="POST">
<button 
style="border: none;
 background-color: #a08ffc;
 padding: 5px;
 border-radius: 5px;
 cursor: pointer;
 font-size: 16px;" name="reload">
Reload</button>
</form>
<div>
	<table>
		<tr>
			<td>Sr</td><td>Name</td><td>ID</td><td>Semester</td><td>Subjects</td><td>Status</td><td>View/Edit</td><td>Delete</td>
		</tr>
			<?php		
			$qry="SELECT * from teacher ORDER BY tid ASC";
			$retval=mysql_query(($qry));
			if(mysql_num_rows($retval)>0)
			{
				$no=1;
				while($row=mysql_fetch_assoc($retval))
				{
				echo "<tr>";
					$fname=$row['fname'];
					$lname=$row['lname'];
					?>
					<td><?php echo $no ?></td>
					<td><?php echo $fname." ".$lname ?></td>
					<td><?php echo $row['tid'] ?></td>
					<td><?php echo substr($row['semester'],1) ?></td>
						<?php
						$subs=$row['subjects'];
						$subs = explode('%&~', $subs);
						$subjects="";
						foreach($subs as $value){
						if(!empty($value))
					    {
							$subjects=$value.", ".$subjects;
					    }
						}
						$len=strlen($subjects);
						$subjects=substr($subjects,0,$len-2);
						?>
					<td><?php echo "$subjects"; ?></td>
					<td><?php echo $row['status'] ?></td>
					<form method="POST">
					<td><button name="update" class="mbutton" value="<?php echo $row['sr'] ?>"><span>View & Edit</span></button></td>
					<td><button name="delete" class="delbutton" value="<?php echo $row['sr'] ?>"><span>Delete</span></button></td>
					</form>
					<?php
				echo "</tr>";
				$no++;
				}
			}
			?>
	</table>
</div>
<?php
if(isset($_POST['delete']))
{
	$sr=$_POST['delete'];
	$qry="DELETE from teacher where sr=$sr";
	if(mysql_query($qry))
	{
		echo "<script>alert('Teacher Deleted');
		window.location.href='ahome.php';
		</script>";
	}
}

if(isset($_POST['reload']))
{
		echo "<script>
		window.location.href='ahome.php';
		</script>";
}
?>