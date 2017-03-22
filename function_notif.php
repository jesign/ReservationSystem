<?php 
	function hasnotif(){

		include 'connect.php';
		$query = $db->query("SELECT * FROM notif WHERE status = 'unread'");
		$num = $query->fetch_assoc();
		$db->close();
		if(count($num)>0){
			return true;
		} else {
			return false;
		}

	}	


 ?>