<?php 
	include 'connect.php';
	include 'function.php';

	session_destroy();
	header('location: index.php');

 ?>