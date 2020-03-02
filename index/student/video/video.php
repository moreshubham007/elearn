<?php
if(!isset($_SESSION['sid']))
{
    header("Location: ../../../invalid.php");
    exit();
}
?>

<?php #echo $semester ?>
<div class="row">
  <div class="col-3 col-s-3 menu">
    <img src="index.png" alt="Video" style="width:300px;height:400px;margin-right:15px;float: left; padding-top: 100px;">
  </div>

  <div class="col-6 col-s-9">
    <h1>Latest Upload</h1>
    <?php
	$qry="SELECT subject from semsub where semester='$semester' ORDER BY sr DESC";
	$ret=mysql_query($qry);
	if($row=mysql_fetch_assoc($ret))
	{
		$subjects=$row['subject'];
		$subjects=explode('@#$', $subjects);
	}	
	?>
	<form method="POST">
		<select name="sem" class="input">
			<option class="input" value="all">All Subjects</option>
			<?php
			foreach($subjects as $subject)
			{
			if($subject!="")
			{
				?>
				<option value="<?php echo $subject ?>"><?php echo $subject ?></option>
				<?php
			}
			}
			?>
		</select>
		<button name="go" class="buttongo">Go !</button>
	</form>
	<br>
	<?php
	if(isset($_POST['go']))
	{
		$sub=$_POST['sem'];
		if($sub=='all')
		{
	 		include("all.php");
		}
		else
		{
			include("sort.php");
#
		}
	}
	else
	{
	 include("all.php");
	}
	?>

  </div>

</body>
</html>