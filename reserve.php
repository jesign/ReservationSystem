<?php 
	if(isset($_POST['reserve'])){
		$itemID = $_POST['item_id'];

		if($itemID == 0){
			header('location: reservation.php?reserve=4&id=0');
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
		$sql = 'INSERT INTO `reservations`(`user_id`, `item_id`, `date`, `time`, `rdate`, `rtime` ,`status`,`finish`) 
					VALUES ( 
						"' . mysqli_real_escape_string($db, $_POST['user_id'])  . '",
						"' . mysqli_escape_string($db, $_POST['item_id']) . '", 
						"' . mysqli_escape_string($db, $_POST['date']) . '",
						"' . mysqli_escape_string($db, $_POST['time']) . '",  
						"' . $newdate . '",
						"' . mysqli_escape_string($db, $_POST['timepicker']) . '",
						"b",
						"no")';

		// date validation
		if($diff > 0 && $diff < 10){
			$query = $db->query($sql);

			$db->query("INSERT INTO `notif`(`user_id`, `item_id`, `type`, `status`, `date`, `time`) 
						VALUES ('" . mysqli_real_escape_string($db, $_POST['user_id'])  . "', '" . mysqli_escape_string($db, $_POST['item_id']) . "' ,'1' , 'unread', '" . $_POST['date'] . "', '" . $_POST['time'] . "')");
			$db->close();

			header('location: reservation.php?reserve=1&id=' . $itemID );
		} elseif($diff > 0 && $diff > 10) {
			header('location: reservation.php?reserve=2&id=' . $itemID);
		} elseif($diff < 0) {
			header('location: reservation.php?reserve=3&id=' . $itemID);
		}

	}


	// service reservation
	if(isset($_POST['service'])){
	 	$services = array();
		if(isset($_POST['service_list'])){
			$services = $_POST['service_list'];
		}

		if(strlen(trim(preg_replace('/\xc2\xa0/','',$_POST['others']))) == 0 && count($services) == 0){
			header('location: reservation.php?reserve=5&id=0');
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
		$sql = 'INSERT INTO `service_reserve`(`user_id`, `date`, `time`, `rdate`, `rtime` ,`status`,`finish` ) 
					VALUES ( 
						"' . mysqli_real_escape_string($db, $_POST['user_id'])  . '",
						"' . mysqli_escape_string($db, $_POST['date']) . '", 
						"' . mysqli_escape_string($db, $_POST['time']) . '", 
						"' . $newdate . '", 
						"' . mysqli_escape_string($db, $_POST['timepicker']) . '",
						"b",
						"no")';
		// date validation
		if($diff > 0 && $diff < 10){
			$query = $db->query($sql);
			$lastID = $db->insert_id;
			
			if(count($services) != 0){
				foreach ($services as $key => $value) {
				$sql2 = 'INSERT INTO `service_list`(`service_id`, `services`) 
						VALUES ("' . $lastID . '", "' . $value . '")';
				$db->query($sql2);
				}
			}

			$sql3 = 'INSERT INTO `service_list` (`service_id`, `services`)
					VALUES ("' . $lastID . '", "' . $_POST['others'] . '")';
			if(strlen(trim(preg_replace('/\xc2\xa0/','',$_POST['others']))) != 0)
				$db->query($sql3);

			$db->query("INSERT INTO `notif`(`user_id`, `item_id`, `type`, `status`, `date`, `time`) 
			VALUES ('" . mysqli_real_escape_string($db, $_POST['user_id'])  . "', '" . $lastID . "', '2' , 'unread', '" . $_POST['date'] . "', '" . $_POST['time'] . "')");

			$db->close();
			header('location: reservation.php?reserve=1&id=0');
		} elseif($diff > 0 && $diff > 10) {
			header('location: reservation.php?reserve=2&id=0');
		} elseif($diff < 0) {
			header('location: reservation.php?reserve=3&id=0');
		} 
	}

 ?>
