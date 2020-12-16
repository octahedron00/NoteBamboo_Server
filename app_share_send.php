<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

	$result = mysqli_query($con,"SELECT no FROM list WHERE user=".$_POST['user']." AND list=".$_POST['list'].";");

	$bool = false;
	while($row = mysqli_fetch_array($result)){
		$bool = true;
	}

	if($bool){
		$string = "INSERT INTO share (list, user_to, user_from, level, owner, name, AES_key) VALUES ("
			. $_POST['list'] .
			","
			. $_POST['user'] .
			","
			. $_POST['level'] .
			",'"
			. $_POST['me'] .
			"','"
			. $_POST['owner'] .
			"','"
			. $_POST['name_Enc'] .
			"','"
			. $_POST['AES_key_Enc'] .
			"');";
		$result = mysqli_query($con, $string);
	}

	echo json_encode(array('success' => $bool););
	mysqli_close($con);
 ?>
