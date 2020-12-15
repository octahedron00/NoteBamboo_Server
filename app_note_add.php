<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

	$string = "INSERT INTO note (list, title) VALUES ("
		. $_POST['list'] .
		",'"
		. $_POST['title'] .
		"');";

	echo $string." ";
	$result = mysqli_query($con, $string);


	$result = mysqli_query($con, "SELECT no FROM note WHERE list=".$_POST['list']." AND title='".$_POST['title']."';");
	$no = 0;
	while($row = mysqli_fetch_array($result)){
		$no = $row['no'];
	}

	$time = new DateTime();
	$times = $time->format("Y-m-d H:i:s");

	$string = "INSERT INTO version (note, title, user, time) VALUES ("
		. $_no .
		",'"
		. $_POST['title'] .
		"','"
		. $_POST['user'] .
		"','"
		. $times .
		"');";

	$result = mysqli_query($con, $string);
	mysqli_close($con);
 ?>
