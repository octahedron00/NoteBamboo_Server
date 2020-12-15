<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

	$string = "INSERT INTO share (list, user_to, user_from, level, owner, name, AES_key) VALUES ("
		. $_POST['list'] .
		","
		. $_POST['user'] .
		","
		. $_POST['level'] .
		",'"
		. $_POST['owner'] .
		"','"
		. $_POST['name_Enc'] .
		"','"
		. $_POST['AES_key_Enc'] .
		"',1);";

	echo $string;
	$result = mysqli_query($con, $string);
	mysqli_close($con);
 ?>
