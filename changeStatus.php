<?php 
	include 'connect.php';
	
	$sql = 'SELECT status FROM users WHERE `id`=' . $_GET['id'];
	$query = $db->query($sql);
	$status = $query->fetch_assoc();

	$cstatus;
	if($status['status'] == 'a')
		$cstatus = 'd';
	else
		$cstatus = 'a';

	$str = 'UPDATE users SET status = "' . $cstatus . '" WHERE id = ' . $_GET['id'];
	$query = $db->query($str);

	header('location: admin_control.php?category=3');
