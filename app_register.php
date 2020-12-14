<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

	$string = "INSERT INTO user (id, pw, nickname, email, RSA_public, RSA_private) VALUES ('"
		. $_POST['id'] .
		"','"
		. $_POST['pwEnc'] .
		"','"
		. $_POST['nickname'] .
		"','"
		. $_POST['email'] .
		"','"
		. $_POST['RSA_public'] .
		"','"
		. $_POST['RSA_private_Enc'] .
		"');";

	echo $string;
	$result = mysqli_query($con, $string);
	mysqli_close($con);
 ?>
