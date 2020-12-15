<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");
	$result = mysqli_query($con, "DELETE FROM list WHERE no=".$_POST['no'].";");

	echo json_encode($result);
	mysqli_close($con);
 ?>
