<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

	$string = "INSERT INTO list (user, level, owner, name, AES_key, visible) VALUES ("
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
