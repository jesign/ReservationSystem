<?php 
	include 'connect.php';

	if(isset($_GET['item']) && $_GET['item'] == 1)
		$sql = 'SELECT status FROM reservations WHERE `id`=' . $_GET['id'];
	elseif(isset($_GET['item']) && $_GET['item'] == 2)
		$sql = 'SELECT status FROM walkin_reservations WHERE `id`=' . $_GET['id'];
	elseif(isset($_GET['service']) && $_GET['service'] == 1)
		$sql = 'SELECT status FROM service_reserve WHERE `id`=' . $_GET['id'];
	elseif(isset($_GET['service']) && $_GET['service'] == 2)
		$sql = 'SELECT status FROM walkin_service_reserve WHERE `id`=' . $_GET['id'];

	$query = $db->query($sql);
	$status = $query->fetch_assoc();

	$cstatus;
	if($status['status'] == 'a')
		$cstatus = 'b';
	else
		$cstatus = 'a';

	if(isset($_GET['item']) && $_GET['item'] == 1){
		$str = 'UPDATE reservations SET status = "' . $cstatus . '" WHERE id = ' . $_GET['id'];
		header('location: admin_control.php?category=1&&update=1');	
	} elseif(isset($_GET['item']) && $_GET['item'] == 2){
		$str = 'UPDATE walkin_reservations SET status = "' . $cstatus . '" WHERE id = ' . $_GET['id'];
		header('location: admin_control.php?category=2&&update=1');	
	} elseif(isset($_GET['service']) && $_GET['service'] == 1){
		$str = 'UPDATE service_reserve SET status = "' . $cstatus . '" WHERE id = ' . $_GET['id'];
		header('location: admin_control.php?category=1&&update=1');	
	} elseif(isset($_GET['service']) && $_GET['service'] == 2){
		$str = 'UPDATE walkin_service_reserve SET status = "' . $cstatus . '" WHERE id = ' . $_GET['id'];
		header('location: admin_control.php?category=2&&update=1');	
	}
	$db->query($str);


