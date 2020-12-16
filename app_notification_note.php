<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

	$result = mysqli_query($con,"SELECT no FROM list WHERE user=".$_POST['user']." AND list=".$_POST['list'].";");

	$go = true;
	while($row = mysqli_fetch_array($result)){
		$go = false;
	}

	if($go){
		$string = "INSERT INTO list (list, user, level, owner, name, AES_key, visible) VALUES ("
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
	}

	echo json_encode(array('success' => $go));
	$result = mysqli_query($con, $string);
	mysqli_close($con);
 ?>
