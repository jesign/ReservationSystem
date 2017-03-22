<?php 
	include 'connect.php';
	
	if(isset($_GET['item']) && $_GET['item'] == 1){
		$sql = 'DELETE FROM reservations WHERE `id`=' . $_GET['id'];
		header('location: admin_control.php?category=1&&update=1');
	}
	elseif(isset($_GET['item']) && $_GET['item'] == 2){
		$sql = 'DELETE FROM walkin_reservations WHERE `id`=' . $_GET['id'];
		header('location: admin_control.php?category=2&&update=1');	
	}
	elseif(isset($_GET['service']) && $_GET['service'] == 1){
		$sql = 'DELETE FROM service_reserve WHERE `id`=' . $_GET['id'];
		header('location: admin_control.php?category=1&&update=1');	
	}
	elseif(isset($_GET['service']) && $_GET['service'] == 2){
		$sql = 'DELETE FROM walkin_service_reserve WHERE `id`=' . $_GET['id'];
		header('location: admin_control.php?category=2&&update=1');	
	}

	$query = $db->query($sql);


