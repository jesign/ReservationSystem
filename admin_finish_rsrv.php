<?php 
	include 'connect.php';
	
	date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d");
    $time = date("h:i"); 

	if(isset($_GET['item']) && $_GET['item'] == 1)
		$sql = 'SELECT finish, user_id FROM reservations WHERE `id`=' . $_GET['id'];
	elseif(isset($_GET['item']) && $_GET['item'] == 2)
		$sql = 'SELECT finish,walkin_id FROM walkin_reservations WHERE `id`=' . $_GET['id'];
	elseif(isset($_GET['service']) && $_GET['service'] == 1)
		$sql = 'SELECT finish, user_id FROM service_reserve WHERE `id`=' . $_GET['id'];
	elseif(isset($_GET['service']) && $_GET['service'] == 2)
		$sql = 'SELECT finish, walkin_id FROM walkin_service_reserve WHERE id=' . $_GET['id'];

	$query = $db->query($sql);
	$finish = $query->fetch_assoc();

	$cfinish;
	if($finish['finish'] == 'yes')
		$cfinish = 'no';
	else
		$cfinish = 'yes';

	if(isset($_GET['item']) && $_GET['item'] == 1){
		$client = 'UPDATE users SET user_type = "client" WHERE id = ' . $finish['user_id'];
	} elseif(isset($_GET['item']) && $_GET['item'] == 2){
		$client = 'UPDATE walk_in SET walkin_type = "client" WHERE id = ' . $finish['walkin_id'];
	} elseif(isset($_GET['service']) && $_GET['service'] == 1){
		$client = 'UPDATE users SET user_type = "client" WHERE id = ' . $finish['user_id'];
	} elseif(isset($_GET['service']) && $_GET['service'] == 2){
		$client = 'UPDATE walk_in SET walkin_type = "client" WHERE id = ' . $finish['walkin_id'];
	}

	$db->query($client);

	if(isset($_GET['item']) && $_GET['item'] == 1){
		$str = 'UPDATE reservations SET finish = "' . $cfinish . '" ,cdate = "' . $date . '" ,ctime = "' . $time . '"	 WHERE id = ' . $_GET['id'];
		header('location: admin_control.php?category=1&&update=1');	
	} elseif(isset($_GET['item']) && $_GET['item'] == 2){
		$str = 'UPDATE walkin_reservations SET finish = "' . $cfinish . '" ,cdate = "' . $date . '" ,ctime = "' . $time . '" WHERE id = ' . $_GET['id'];
		header('location: admin_control.php?category=2&&update=1');	
	} elseif(isset($_GET['service']) && $_GET['service'] == 1){
		$str = 'UPDATE service_reserve SET finish = "' . $cfinish . '", cdate = "' . $date . '" ,ctime = "' . $time . '" WHERE id = ' . $_GET['id'];
		header('location: admin_control.php?category=1&&update=1');	
	} elseif(isset($_GET['service']) && $_GET['service'] == 2){
		$str = 'UPDATE walkin_service_reserve SET finish = "' . $cfinish . '" ,cdate = "' . $date . '" ,ctime = "' . $time . '" WHERE id = ' . $_GET['id'];
		header('location: admin_control.php?category=2&&update=1');	
	}
	$db->query($str);

