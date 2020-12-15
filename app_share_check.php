<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");
	$result = mysqli_query($con, "SELECT no FROM list WHERE list=".$_POST['list']." AND user=".$_POST['user'].";");

	$bool = false;
	while($row = mysqli_fetch_array($result)){
		$bool = true;
	}

	echo json_encode(array("success" => $bool));
	mysqli_close($con);
 ?>
