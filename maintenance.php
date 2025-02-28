<?php
	error_reporting(E_ALL); 
	ini_set("display_errors", true);

	$con = mysqli_connect("localhost","crud","qwerty2020","notebamboo");

    for($note=50; $note<125; $note++){
        $string = "SELECT no FROM version where note=".$note.";";
		$result = mysqli_query($con, $string);

        echo $note." => ";
		$array = array();
		$i = 0;

		if(is_null($result)){
			goto next;
		}

        while($row = mysqli_fetch_array($result)){
			$array[$i] = $row['no'];
			$i++;
		}
		$array[$i] = 0;
		
		$string = "UPDATE version SET parent = 0, child = ".$array[1].", length = 0 where no=".$array[0].";";
		$result = mysqli_query($con, $string);

		for($i=1; $i<sizeof($array)-1; $i++){
			$string = "UPDATE version SET parent = ".$array[$i-1].", child = ".$array[$i+1].", length = ".$i." where no=".$array[$i].";";
			$result = mysqli_query($con, $string);
		}

        next:;
        echo json_encode($array)."<br>";
    }

	mysqli_close($con);
 ?>
