<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

	$result = mysqli_query($con,"INSERT INTO base (name) VALUES '".$_POST['name_Enc']."';");

	$result = mysqli_query($con,"SELECT no FROM base WHERE name='".$_POST['name_Enc']."';");

	$no = 0;
	while($row = mysqli_fetch_array($result)){
		$no = $row['no'];
	}

	$string = "INSERT INTO list (list, user, level, owner, name, AES_key, visible) VALUES ("
		. $no .
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
