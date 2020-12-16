<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

	$string = "DELETE FROM share WHERE no=".$_POST['no'].";";

	$result = mysqli_query($con, $string);

	$response = array();
	while($row = mysqli_fetch_array($result)){
		array_push($response, $row);
	}

	echo json_encode(array("response" => $response));
	mysqli_close($con);
 ?>
