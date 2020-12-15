<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");
	$result = mysqli_query($con, "UPDATE list SET visible=0 where list=".$_POST['list'].";");

	echo $result;
	mysqli_close($con);
 ?>
