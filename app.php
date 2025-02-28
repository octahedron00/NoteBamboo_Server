<?php
	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

	$method = $_POST['method'];
	$string = "";

	$response = array();
	$read = array();
	
	$response["success"] = false;
	$response["method"] = $method;
	$response["string"] = "";

	$key = "Notebamboo-octahedron00-Notebamboo-octahedron00-";
	$key256 = substr($key, 0, 32);
	$key128 = substr($key, 0, 16);


/*
	user : login, register, nickname, id_check
*/
	//login
	if($method=="login"){
		$string = "SELECT * FROM user where id='".$_POST['id']."';";
		
		$result = mysqli_query($con, $string);

		$row = mysqli_fetch_array($result);

		if($row['pw']==$_POST['pwEnc']){
			$response += $row;
			$response["success"] = true;
		}
	}

	//register
	if($method=="register"){
		$string = "SELECT no FROM user WHERE id='".$_POST['id']."';";
		$result = mysqli_query($con, $string);
		$row = mysqli_fetch_array($result);

		if(!is_null($row)){
			$response['reason'] = "ID already exists";
			goto endphp;
		}

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

		$result = mysqli_query($con, $string);
		$response["success"] = $result;
	}

	//nickname
	if($method=="nickname"){
		$string = "UPDATE user SET nickname = '"
			. $_POST['nickname'] .
			"' WHERE no = "
			. $_POST['user'];
		
		$result = mysqli_query($con, $string);
		$response["success"] = $result;
	}
	
	//id_check
	if($method=="id_check"){
		$string = "SELECT * FROM user where id='".$_POST['id']."';";
		$result = mysqli_query($con, $string);

		$row = mysqli_fetch_array($result);
		
		if(is_array($row)&&count($row)>0){
			$response += $row;
			$response["success"] = true;
		}
	}	

	//no_check
	if($method=="no_check"){
		$string = "SELECT * FROM user where no='".$_POST['no']."';";
		$result = mysqli_query($con, $string);

		$row = mysqli_fetch_array($result);
		
		if(is_array($row)&&count($row)>0){
			$response += $row;
			$response["success"] = true;
		}
	}	


/*
	list : lists, list_add, list_hide, list_name, list_origin
*/
	//lists
	if($method=="lists"){
		$string = "SELECT list.*, user.id, user.nickname FROM list LEFT JOIN user ON list.owner = user.no where list.user=".$_POST['user']." and list.visible=1 order by pos desc, no asc;";
		$result = mysqli_query($con, $string);

		while($row = mysqli_fetch_array($result)){
			array_push($read, $row);
		}
		$response['array'] = $read;
		$response['success'] = true;
	}

	//list_add
	if($method=="list_add"){
		$string = "INSERT INTO base (name) VALUES ('".$_POST['name_Enc']."') RETURNING no;";
		$result = mysqli_query($con, $string);

		$row = mysqli_fetch_array($result);

		if($row==false){
			goto endphp;
		}

		$no = $row['no'];
		
		$string = "INSERT INTO list (list, user, level, owner, name, AES_key, visible) VALUES ("
			. $no .
			","
			. $_POST['user'] .
			","
			. $_POST['level'] .
			","
			. $_POST['owner'] .
			",'"
			. $_POST['name_Enc'] .
			"','"	
			. $_POST['AES_key_Enc'] .
			"',1);";

		$result = mysqli_query($con, $string);
		$response["success"] = $result;
	}

	//list_hide
	if($method=="list_hide"){
		$string = "UPDATE list SET visible=0 where list=".$_POST['list'].";";
		$result = mysqli_query($con, $string);
		$string = "DELETE FROM list where list=".$_POST['list']." and level<5;";
		$result = mysqli_query($con, $string);
		$string = "DELETE FROM share where list=".$_POST['list'].";";
		$result = mysqli_query($con, $string);

		$response["result"] = $result;
	}

	//list_name
	if($method=="list_name"){
		$string = "UPDATE list SET name = '".$_POST['name_Enc']."' where list=".$_POST['list']." and user=".$_POST['user'].";";
		$result = mysqli_query($con, $string);

		$response["success"] = $result;
	}

	//list_order
	if($method=="list_order"){
		$string = "UPDATE list SET pos = ".$_POST['pos']." where list=".$_POST['list']." and user=".$_POST['user'].";";
		$result = mysqli_query($con, $string);

		$response["success"] = $result;
	}



/*
	note : notes, note_add, note_hide, note_read, note_save
*/	
	//notes
	if($method=="notes"){
		$string = "SELECT * FROM note where list=".$_POST['list']." and visible=1 order by pos desc, no asc;";
		$result = mysqli_query($con, $string);

		while($row = mysqli_fetch_array($result)){
			array_push($read, $row);
		}
		$response['array'] = $read;
		$response['success'] = true;
	}

	//note_add
	if($method=="note_add"){
		$string = "INSERT INTO note (list, title, visible) VALUES ("
			. $_POST['list'] .
			",'"
			. $_POST['title'] .
			"',1) RETURNING no;";
		$result = mysqli_query($con, $string);

		if($result==false){
			goto endphp;
		}

		$row = mysqli_fetch_array($result);
		$no = $row['no'];

		$string = "INSERT INTO version (note, title, text, user) VALUES ("
			. $no .
			",'"
			. $_POST['title'] .
			"','"
			. $_POST['title'] .
			"',"
			. $_POST['user'] .
			");";

		$result = mysqli_query($con, $string);
		$response['success'] = $result;
	}

	//note_hide
	if($method=="note_hide"){
		$string = "UPDATE note SET visible = 0 where no=".$_POST['note'].";";
		$result = mysqli_query($con, $string);
	
		$response['success'] = $result;		
	}
	
	//note_order
	if($method=="note_order"){
		$string = "UPDATE note SET pos = ".$_POST['pos']." where no=".$_POST['note'].";";
		$result = mysqli_query($con, $string);

		$response["success"] = $result;
	}


	//note_read
	if($method=="note_read"){
		$string = "SELECT version.*, user.id, user.nickname FROM version LEFT JOIN user on version.user = user.no where note=".$_POST['note']." order by version.length asc, version.time desc;";
		$result = mysqli_query($con, $string);

		while($row = mysqli_fetch_array($result)){
			array_push($read, $row);
		}
		$response['array'] = $read;
		$response['success'] = true;
	}

	//note_ends
	if($method=="note_ends"){
		$string = "SELECT version.*, user.id, user.nickname FROM version LEFT JOIN user on version.user = user.no where version.note=".$_POST['note']." and version.child=0 order by version.length desc, version.time asc;";
		$result = mysqli_query($con, $string);

		while($row = mysqli_fetch_array($result)){
			array_push($read, $row);
		}
		$response['array'] = $read;
		$response['success'] = true;
	}

	//note_end
	if($method=="note_end"){
		$string = "SELECT version.*, user.id, user.nickname FROM version LEFT JOIN user on version.user = user.no where version.note=".$_POST['note']." and version.child=0 order by version.length desc, version.time asc;";
		$result = mysqli_query($con, $string);

		$row = mysqli_fetch_array($result);
		$response += $row;
		if(is_null($row)){
			goto endphp;
		}
		$response['success'] = true;
	}

	//note_save
	if($method=="note_save"){
		$result = mysqli_query($con,"UPDATE note SET title='".$_POST['title']."' WHERE no=".$_POST['note'].";");

		$string = "INSERT INTO version (note, title, text, user, parent, length) VALUES ("
			. $_POST['note'] .
			",'"
			. $_POST['title'] .
			"','"
			. $_POST['text'] .
			"','"
			. $_POST['user'] .
			"',"
			. $_POST['parent'] .
			","
			. $_POST['length'] .
			") RETURNING no;";

		$result = mysqli_query($con, $string);
		
		if($result==false){
			goto endphp;
		}
		
		$row = mysqli_fetch_array($result);
		$no = $row['no'];

		$string = "UPDATE version SET child=".$no." WHERE no=".$_POST['parent']." and child=0;";
		$result = mysqli_query($con, $string);

		
		if($result==false){
			goto endphp;
		}
		
		$string = "UPDATE note SET length=".$_POST['length']." WHERE no=".$_POST['note'].";";
		$result = mysqli_query($con, $string);

		
		if($result==false){
			goto endphp;
		}

		$add = $_POST['add'];
		if(!is_null($add)){
			$string = "UPDATE version SET child=".$no." WHERE no=".$_POST['add']." and child=0;";
			$result = mysqli_query($con, $string);			
		}

		
		if($result==false){
			goto endphp;
		}

		$no = $_POST['parent'];

		for($i=0; $i<4; $i++){
			$string = "SELECT parent FROM version WHERE no=".$no.";";
			$result = mysqli_query($con, $string);
			$row = mysqli_fetch_array($result);
			if(is_null($row)){
				goto next1;
			}
			$no = $row['parent'];
		}
		
		if($result==false){
			goto endphp;
		}

		if($no>0){
			$string = "DELETE FROM version WHERE note=".$_POST['note']." and child>0 and no<".$no.";";
			$result = mysqli_query($con, $string);
		}
		
		$response['success'] = $result;
		next1:;
	}


	
/*
	share : shares, share_send, share_add, share_delete, notifs
*/	
	//sharings
	if($method=="sharings"){
		$string = "SELECT list.*, user.id, user.nickname FROM list LEFT JOIN user on list.user = user.no where list.list=".$_POST['list'].";";
		$result = mysqli_query($con, $string);

		while($row = mysqli_fetch_array($result)){
			array_push($read, $row);
		}
		
		$response['array'] = $read;
		$response['success'] = true;
	}

	//shares
	if($method=="shares"){
		$string = "SELECT share.*, user.id, user.nickname FROM share LEFT JOIN user on share.user_to = user.no where share.list=".$_POST['list'].";";
		$result = mysqli_query($con, $string);

		while($row = mysqli_fetch_array($result)){
			array_push($read, $row);
		}
		
		$response['array'] = $read;
		$response['success'] = true;
	}

	//share_send
	if($method=="share_send"){
		$string = "SELECT no FROM list WHERE user=".$_POST['user']." AND list=".$_POST['list'].";";
		$result = mysqli_query($con,$string);
		$row1 = mysqli_fetch_array($result);
		
		$string = "SELECT no FROM share WHERE user_to=".$_POST['user']." AND list=".$_POST['list'].";";
		$result = mysqli_query($con,$string);
		$row2 = mysqli_fetch_array($result);

		if(is_null($row1) and is_null($row2)){
			$string = "INSERT INTO share (list, user_to, level, user_from, owner, name, AES_key) VALUES ("
				. $_POST['list'] .
				","
				. $_POST['user'] .
				","
				. $_POST['level'] .
				",'"
				. $_POST['me'] .
				"',"
				. $_POST['owner'] .
				",'"
				. $_POST['name_Enc'] .
				"','"
				. $_POST['AES_key_Enc'] .
				"');";
			$result = mysqli_query($con, $string);
			$response['success'] = $result;
		};
	}

	//share_add
	if($method=="share_add"){
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

		$result = mysqli_query($con, $string);
		$response['success'] = $result;
	}

	//share_level
	if($method=="share_level"){
		$string = "UPDATE list SET level = ".$_POST['level']." where no=".$_POST['no'].";";
		$result = mysqli_query($con, $string);

		$response["success"] = $result;
	}

	//share_delete
	if($method=="share_delete"){
		$string = "DELETE FROM share WHERE no=".$_POST['no'].";";
	
		$result = mysqli_query($con, $string);
		$response['success'] = $result;
	}
	
	//sharing_delete
	if($method=="sharing_delete"){
		$string = "DELETE FROM list WHERE no=".$_POST['no'].";";
	
		$result = mysqli_query($con, $string);
		$response['success'] = $result;
	}

	//notifs
	if($method=="notifs"){
		
		$string = "SELECT no, user_from, level, AES_key, name, owner, list FROM share WHERE user_to=".$_POST['user'].";";

		$result = mysqli_query($con, $string);
	
		while($row = mysqli_fetch_array($result)){
			array_push($read, $row);
		}
		$response['array'] = $read;
		$response['success'] = true;
	}

/*
	//
	if($method=="anything"){
		
		
		//$result = mysqli_query($con, $string);
		//$response['success'] = $result;
	}
*/
	endphp:;

	if($result==false){
		$response['success'] = false;
	}
	$response["error"] = openssl_encrypt(mysqli_error($con), "AES-256-CBC", $key256, 0, $key128);
	$response["string"] = openssl_encrypt($string, "AES-256-CBC", $key256, 0, $key128);

	echo json_encode($response);
	mysqli_close($con);
 ?>
