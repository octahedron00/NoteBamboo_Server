<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");
	$result = mysqli_query($con, "SELECT pw, nickname FROM user where id=".$_POST['id']);

	$success = false;
	$nickname = "";
	while($row = mysqli_fetch_array($result)){
		if($row['pw']==$_POST['pwEnc']){
			$success = true;
			$nickname = $row['nickname'];
		}
	}

	$response = array();
	$response["success"] = $success;
	$response["nickname"] = $nickname;
	echo json_encode($response);
	mysqli_close($con);
 ?>
