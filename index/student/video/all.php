<?php
if(!isset($_SESSION['sid']))
{
    header("Location: ../../../invalid.php");
    exit();
}
?>
<form method="POST">
<?php
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'e-learning');

$results_per_page = 5;
$sql="SELECT * FROM video where semester='$semester' ORDER BY id DESC";
$result = mysqli_query($con, $sql);
$number_of_results = mysqli_num_rows($result);
$number_of_pages = ceil($number_of_results/$results_per_page);
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
$this_page_first_result = ($page-1)*$results_per_page;
$sql="SELECT * FROM video where semester='$semester' ORDER BY id DESC LIMIT " . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($con, $sql);
if(mysqli_fetch_array($result)>0)
{
while($row = mysqli_fetch_array($result)) {
	?>
		<div class="videolist">
		  <img class="img2" src="video/video.png" width="260" height="150">
		  <div align="left" style="padding-left: 10px;">
			  <button name="view" value=<?php echo $row['id'] ?> class=viewbutton><h1><?php echo $row['title']; ?></h1></button>
			  <p><?php echo $row['subject']; ?></p>
			  <p><?php echo $row['date']; ?></p>
		  </div>
		</div>
	<br>
	<?php
}
}
else
{
	echo "<h3>Video Not Uploaded !</h3>";
}
?>
<div class="count">
<?php
for ($page=1;$page<=$number_of_pages;$page++) {
  echo '<a class="count1" href="index.php?page=' . $page . '">' . $page . '</a> ';
}
?>
</div>
<?php
?>
</form>