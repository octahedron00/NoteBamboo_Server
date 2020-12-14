<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");
	$result = mysqli_query($con, "SELECT no, pw, nickname, RSA_public, RSA_private FROM user where id='".$_POST['id']."';");

	$success = false;
	while($row = mysqli_fetch_array($result)){
		if($row['pw']==$_POST['pwEnc']){
			$success = true;
			$no = $row['no'];
			$nickname = $row['nickname'];
			$RSA_public = $row['RSA_public'];
			$RSA_private = $row['RSA_private'];
		}
	}

	$response = array();
	$response["success"] = $success;
	$response["nickname"] = $nickname;
	$response["no"] = $no;
	$response["RSA_public"] = $RSA_public;
	$response["RSA_private"] = $RSA_private;
	echo json_encode($response);
	mysqli_close($con);
 ?>
