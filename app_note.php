<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");
	$result = mysqli_query($con, "SELECT no, title FROM note where list=".$_POST['list'].";");

	$response = array();
	while($row = mysqli_fetch_array($result)){
		array_push($response, $row);
	}

	echo json_encode(array("response" => $response));
	mysqli_close($con);
 ?>
