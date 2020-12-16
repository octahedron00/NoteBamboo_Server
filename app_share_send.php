<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

	$result = mysqli_query($con,"SELECT no FROM list WHERE user=".$_POST['user']." AND list=".$_POST['list'].";");

	$go = true;
	while($row = mysqli_fetch_array($result)){
		$go = false;
	}


	if($go){
		$string = "INSERT INTO share (list, user_to, level, user_from, owner, name, AES_key) VALUES ("
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
	};

	echo json_encode(array("success" => $go));
	mysqli_close($con);
 ?>
