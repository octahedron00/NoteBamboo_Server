<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

	$string = "INSERT INTO user (id, pw, nickname, email) VALUES ('"
		. $_POST['id'] .
		"','"
		. $_POST['pwEnc'] .
		"','"
		. $_POST['nickname'] .
		"','"
		. $_POST['email'] .
		"');";

	echo $string;
	$result = mysqli_query($con, $string);
	mysqli_close($con);
 ?>
