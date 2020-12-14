<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");
	$result = mysqli_query($con, "SELECT no FROM user where id='".$_POST['id']."';");

	$success = true;
	while($row = mysqli_fetch_array($result)){
		$success = false;
	}

	$response = array();
	$response["success"] = $success;
	echo json_encode($response);
	mysqli_close($con);
 ?>
