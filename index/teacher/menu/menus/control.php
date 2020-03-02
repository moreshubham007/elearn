<?php
if(!isset($_SESSION['sr'])) 
{
    header("Location: ../../../../invalid.php");
    exit();
}
?>
<style type="text/css">
.control
{
  width: 100%;
  border-radius: 10px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  padding: 20px;
  padding-top: 20px;
}

table {
  border-collapse: collapse;
  width: 80%;
}

th, td {
  text-align: left;
  padding: 2px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
  font-size: 20px;
}


.status
{
	font-size: 20px;
	padding: 5px;
	border: none;
	border-radius: 5px;
	color: white;
	cursor: pointer;
}

</style>
<br>
<div align="center" class="control">
	<table>
		<th>Sr</th>
		<th>Id</th>
		<th>Name</th>
		<th>Semester</th>
		<th>Phone</th>
		<th>Status</th>
		<th>Action</th>
		<?php
		$sr=0;
		if($sort=="deactive")
		{
			$qry="SELECT * FROM student ORDER BY status DESC";
		}
		else
		{
			$qry="SELECT * FROM student ORDER BY $sort ASC";
		}
		$ret=mysql_query($qry);
		while($row=mysql_fetch_assoc($ret))
		{
			$sr++;
			$sid=$row['sid'];
			$fname=$row['fname'];
			$mname=$row['mname'];
			$lname=$row['lname'];
			$semester=$row['semester'];
			$sphone=$row['sphone'];
			$status=$row['status'];
		?>
		<tr>
			<td style="font-size: 18px"><label><?php echo $sr ?>)</label></td>
			<td style="font-size: 18px"><label><?php echo $sid ?></label></td>
			<td style="font-size: 18px"><label><?php echo $fname." ".$mname." ".$lname ?></label></td>
			<td style="font-size: 18px"><label><?php echo $semester ?></label></td>
			<td style="font-size: 18px"><label><?php echo $sphone ?></label></td>
			<form method="POST">
			<td style="font-size: 18px">
				<button <?php
				if($status=="active")
				{
				?>
				style="background-color: #09b300"
				<?php
				}
				else
				{
				?>
				style="background-color: #de0202"
				<?php
				}
				?> name="action" class="status" value="<?php echo $sid ?>"><?php echo $status ?></button>
			</td>
			<td><button name="sdel" value="<?php echo $row['sid'] ?>" style="background-color: #de0202; color: white;" value="<?php echo $sid ?>" class="change">Delete</button></td>
			</form>
		</tr>
		<?php
		}
		?>
	</table>
</div>