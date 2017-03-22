<?php 
	
	include "function.php";
	include 'connect.php';
	
	$id = $_GET['id'];
	

	if($_GET['item'] == 1 )
		$delSql = "DELETE FROM `reservations` WHERE id = ". $id;
	else
		$delSql = "DELETE FROM `service_reserve` WHERE id = ". $id;
	
	$db->query($delSql);

		if($user_level == 1)
			header('location: admin_reservations.php?cancel=1');
		else
			header('location: client_reservation.php?cancel=1');

 ?>