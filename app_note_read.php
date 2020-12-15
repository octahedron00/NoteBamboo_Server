<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");
	$result = mysqli_query($con, "SELECT no, title, text, user, time FROM version where note=".$_POST['note'].";");

	$response = array();
	$response['success'] = false;
	while($row = mysqli_fetch_array($result)){
		$response = $row;
		$response['success'] = true;
	}

	echo json_encode($response);
	mysqli_close($con);
 ?>
