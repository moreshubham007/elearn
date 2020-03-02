<?php

$mySem = explode(', ', $semester2);
$mySub = explode('%&~', $subject2);
?>
<h2 style="text-align: center;">Post Video</h2>
<div>

<form action="index.php" method="POST" enctype="multipart/form-data">
	<table>
		<tr>
			<td style="font-weight: bold;"><label>Select <br>Semester & <br>Subject:</label></td>
			<td>
				<select name="semsub" class="inputbox">
					<?php
					$not=0;
					foreach($mySem as $sem)
					{
						if($sem!="")
						{
						$qry="SELECT * from semsub where semester='$sem'";
						$retval=mysql_query(($qry));
						if(mysql_num_rows($retval)>0)
						{
						while($row=mysql_fetch_assoc($retval))
						{
						  $subject3=$row['subject'];
						  $defSub = explode('@#$', $subject3);
							foreach($mySub as $sub)
							{
								if($sub!="")
								{
								foreach($defSub as $defs)
								{
									// echo "$defs $sub<br>";
									if($defs!="" && $sub!="")
									{
									if($defs==$sub)
									{
										echo "<option value='$sem%%$defs'>$sem $defs</option>";
									}
									}
								}
								}
							}
						}
						}
						}
						else
						{
							$not++;
						}
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td style="font-weight: bold;"><label>Date:</label></td>
			<td><input class="inputbox" type="date" date-format="DD MM YYYY" name="date" required></td>
		</tr>
		<tr>
			<td style="font-weight: bold;"><label>Title:</label></td>
			<td><input class="inputbox" type="text" name="title" required></td>
		</tr>
		<tr style="font-weight: bold;">
			<td><label>Description:</label></td>
			<td><textarea name="desc" class="inputbox" style="height: 200px;width: 500px;"></textarea></td>
		</tr>
		<tr style="font-weight: bold;">
			<td><label>Video:</label></td>
			<td>
				<input class="inputbox" type="file" name="fileToUpload" id="fileToUpload">
			</td>
		</tr>
		<tr style="font-weight: bold;">
			<td><label>Notes:</label></td>
			<td>
				<input class="inputbox" type="file" name="fileToUpload2" id="fileToUpload2">(Only for Extra notes)
			</td>			
		</tr>
	</table>
	<div style="text-align: center;">
	<input type="submit" class="inputbutton" value="Post" name="submit">	
	</div>
	
</form>
</div>
<div style="color: red">
<?php
date_default_timezone_set("Asia/Kolkata");
if(isset($_POST["submit"])) {
	$vidsem=$_POST['semsub'];
	$check=$vidsem;
	if($check!="")
	{
	// Upload Video
	$semsub=$_POST['semsub'];
	$date=$_POST['date'];
	$title=$_POST['title'];
	$desc=$_POST['desc'];

	$target_dir = "menu/menus/video/";
	$vnm=$_FILES["fileToUpload"]["name"];
    $file_ext=strtolower(end(explode('.',$_FILES['fileToUpload']['name'])));
	$names=rand(9999,1000).date("h_i_sa").'_'.$date.'_'.$title.'.'.$file_ext;
	if($file_ext=="")
	{
		$names="";
	}
	$target_file = $target_dir.basename($names);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "webm"
&& $imageFileType != "flv" ) {
	    $uploadOk = 0;
	}
	if ($uploadOk == 0) {
	    echo "<script>alert('Video Not found');</script>";

	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

	// Upload Documents
	$err=0;
	$semsub=$_POST['semsub'];
	$date=$_POST['date'];
	$newdate=new DateTime($date);
	$date=date_format($newdate,'dd-mm-yy');
	$title=$_POST['title'];

	// $vnm=$_FILES["fileToUpload2"]["name"];
    $file_ext=strtolower(end(explode('.',$_FILES['fileToUpload2']['name'])));
	$names2=rand(9999,1000).date("h_i_sa").'_'.$date.$title.'.'.$file_ext;
	if($file_ext=="")
	{
		$names2="";
	}
	$target_dir = "menu/menus/docs/";
	$target_file = $target_dir.basename($names2);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if($imageFileType == "mp4") {
	    echo "Sorry, video not allowed";
	    $err++;
	    $uploadOk = 0;
	}

	if ($uploadOk == 0) {
	    echo "Sorry, documents file was not uploaded.";
	    echo "<script>alert('No Documents Selcted');</script>";
	    $err++;

	} else {
	    if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["fileToUpload2"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

// Entry Database
		$vidsem=$_POST['semsub'];
		$check=$vidsem;
		$vidsem = explode('%%', $vidsem);
		
		$semester=$vidsem[0];
		$subject=$vidsem[1];
		$date=$_POST['date'];
		$date=date('d-m-Y',strtotime($date));
		$title=$_POST['title'];
		$description=$_POST['desc'];
		$video=$names;
		$docs=$names2;
		$qry="INSERT into video values('id','$tid','$semester','$subject','$date','$title','$description','$video','$docs')";

	      if(mysql_query($qry))
	      { 
	        echo "<script>
	        alert('Post Uploaded...');
	        window.location.href='index.php';
	        </script>";
	      }
	  
	}
	else
	{ 
	        echo "<script>
	        alert('You Have no any semester provided ! Contact Administrator to update your profile...');
	        window.location.href='index.php';
	        </script>";
	}
}

?>
</div>