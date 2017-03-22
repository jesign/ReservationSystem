<?php session_start();

	function loggedin(){
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
			return true;
		} else {
			return false;
		}

	}


	if(loggedin()){
		
		include "connect.php";

		$my_id = $_SESSION['user_id'];
		$sql = "SELECT username, user_level FROM users WHERE id = '$my_id'";
		$query = $db->query($sql);
		$data = $query->fetch_assoc();
		$user_name = $data['username'];
		$user_level = $data['user_level'];
		
		$sql2 = "SELECT level FROM user_level WHERE id = '$user_level'";
		$query = $db->query($sql2);
		$data = $query->fetch_assoc();
		$level_name = $data['level'];
	}
	