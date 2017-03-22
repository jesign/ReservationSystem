<?php 

	include "function.php";

	$db = new MySqli('localhost', 'root', '', 'reservationsystem');
	date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d");
    $time = date("h:i:sa");     


	$sql = 'INSERT INTO `comments`(`user_id`, `comment`, `date`, `time`) 
                    VALUES ( 
                        "' . $my_id . '", d
                        "' . mysqli_escape_string($db, $_POST['comment']) . '", 
                        "' . $date . '", 
                        "' . $time . ')';
	$db->query($sql);

	header('location: contact.php');