<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");
	$result = mysqli_query($con, "SELECT no, nickname, RSA_public FROM user where id='".$_POST['id']."';");

	$success = false;
	$no = 0;
	$nickname = "";
	$RSA_public = "";
	while($row = mysqli_fetch_array($result)){
		$success = true;
		$no = $row['no'];
		$nickname = $row['nickname'];
		$RSA_public = $row['RSA_public'];
	}

	$response = array();
	$response["success"] = $success;
	$response["no"] = $no;
	$response["nickname"] = $nickname;
	$response["RSA_public"] = $RSA_public;
	echo json_encode($response);
	mysqli_close($con);
 ?>
