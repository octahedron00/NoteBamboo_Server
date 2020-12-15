<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");
	$result = mysqli_query($con, "UPDATE note SET visible=0 where no=".$_POST['note'].";");

	echo $result;
	mysqli_close($con);
 ?>
