<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

	$string = "SELECT no, user_from, level, AES_key, name, owner, list FROM share WHERE user_to=".$_POST['user'].";";

	$result = mysqli_query($con, $string);

	$response = array();
	while($row = mysqli_fetch_array($result)){
		array_push($response, $row);
	}

	echo json_encode(array("response" => $response));
	mysqli_close($con);
 ?>
