<?php 
	if(isset($_POST['reserve'])){
		$itemID = $_POST['item_id'];

		if($itemID == 0){
			header('location: admin_reservation.php?reserve=4&id=0');
		} 

		list($m,$d,$y) = explode("/",$_POST['datepicker']);
		$timestamp = mktime(0,0,0,$m,$d,$y);
		$newdate = date("Y-m-d",$timestamp);
		
		//date compare
		$date1=date_create($_POST['date']);
		$date2=date_create($newdate);
		$diff=date_diff($date1,$date2);
		$diff = $diff->format("%R%a");

		
		include 'connect.php';
		
		$sql = 'INSERT INTO `walkin_reservations`(`walkin_id`, `item_id`, `date`, `time`, `rdate`,`rtime`, `finish`) 
					VALUES ( 
						"' . mysqli_real_escape_string($db, $_POST['walkin_id'])  . '",
						"' . mysqli_escape_string($db, $_POST['item_id']) . '", 
						"' . mysqli_escape_string($db, $_POST['date']) . '",
						"' . mysqli_escape_string($db, $_POST['time']) . '",  
						"' . $newdate . '",
						"' . mysqli_escape_string($db, $_POST['timepicker']) . '",
						"no")';

		// date validation
		if($diff > 0 && $diff < 10){
			$query = $db->query($sql);
			$db->close();
			header('location: admin_walkin_reserve.php?reserve=1&id=' . $itemID );
		} elseif($diff > 0 && $diff > 10) {
			header('location: admin_walkin_reserve.php?reserve=2&id=' . $itemID);
		} elseif($diff < 0) {
			header('location: admin_walkin_reserve.php?reserve=3&id=' . $itemID);
		}

	
	}


	// service reservation
	if(isset($_POST['service'])){

	 	$services = array();
	 	$services = $_POST['service_list'];
		
		if(strlen(trim(preg_replace('/\xc2\xa0/','',$_POST['others']))) == 0 && count($services) == 0){
			header('location: admin_reservation.php?reserve=5&id=0');
		}

		list($m,$d,$y) = explode("/",$_POST['datepicker']);
		$timestamp = mktime(0,0,0,$m,$d,$y);
		$newdate = date("Y-m-d",$timestamp);
		
		//date compare
		$date1=date_create($_POST['date']);
		$date2=date_create($newdate);
		$diff=date_diff($date1,$date2);
		$diff = $diff->format("%R%a");
	
		
		include 'connect.php';
		$sql = 'INSERT INTO `walkin_service_reserve`(`walkin_id`, `date`, `time`, `rdate` ,`rtime`, `finish` ) 
					VALUES ( 
						"' . mysqli_real_escape_string($db, $_POST['walkin_id'])  . '",
						"' . mysqli_escape_string($db, $_POST['date']) . '", 
						"' . mysqli_escape_string($db, $_POST['time']) . '", 
						"' . $newdate . '", 
						"' . mysqli_escape_string($db, $_POST['timepicker']) . '",
						"no")';
		// date validation
		if($diff > 0 && $diff < 10){
			$query = $db->query($sql);
			$lastID = $db->insert_id;
			
			foreach ($services as $key => $value) {
			$sql2 = 'INSERT INTO `walkin_service_list`(`service_id`, `services`) 
					VALUES ("' . $lastID . '", "' . $value . '")';
			$db->query($sql2);
			}
			
			$sql3 = 'INSERT INTO `walkin_service_list` (`service_id`, `services`)
					VALUES ("' . $lastID . '", "' . $_POST['others'] . '")';
			if(strlen(trim(preg_replace('/\xc2\xa0/','',$_POST['others']))) != 0)
				$db->query($sql3);

			$db->close();
			header('location: admin_walkin_reserve.php?reserve=1&id=0');
		} elseif($diff > 0 && $diff > 10) {
			header('location: admin_walkin_reserve.php?reserve=2&id=0');
		} elseif($diff < 0) {
			header('location: admin_walkin_reserve.php?reserve=3&id=0');
		} 
	}

 ?>
