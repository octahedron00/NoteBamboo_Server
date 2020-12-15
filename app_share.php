<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");
	$result = mysqli_query($con, "SELECT list.no, list.level, user.id, user.nickname FROM list LEFT JOIN user on list.user = user.no where list.no=".$_POST['user'].";");

	$response = array();
	while($row = mysqli_fetch_array($result)){
		array_push($response, $row);
	}

	echo json_encode(array("response" => $response));
	mysqli_close($con);
 ?>
