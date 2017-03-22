<?php 
include 'connect.php';
$sql = "DELETE FROM `items` WHERE `id`=".$_GET['id'];
$db->query($sql);
if($_GET['pro'] == 1)
	header('location: products.php?start=0&pro=1');
elseif($_GET['pro'] == 2)
	header('location: products.php?start=0&pro=2');
elseif($_GET['pro'] == 3)
	header('location: products.php?start=0&pro=3');
elseif($_GET['pro'] == 4)
	header('location: products.php?start=0&pro=4'); 
 ?>