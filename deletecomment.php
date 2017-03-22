<?php 

	include 'connect.php';
	$sql = "DELETE FROM `comments` WHERE `id`=".$_GET['id'];
	$db->query($sql);

	header('location: admin_control.php?category=5');