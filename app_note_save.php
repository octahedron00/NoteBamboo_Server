<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

	$time = new DateTime();
	$times = $time->format("Y-m-d H:i:s");

	$string = "INSERT INTO version (note, title, text, user, time) VALUES ("
		. $_POST['note'] .
		",'"
		. $_POST['title'] .
		"','"
		. $_POST['text'] .
		"','"
		. $_POST['user'] .
		"','"
		. $times .
		"');";

	echo $string;
	$result = mysqli_query($con, $string);
	mysqli_close($con);
 ?>
