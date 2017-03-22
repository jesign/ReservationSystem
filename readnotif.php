<?php 
	include 'connect.php';
	if(isset($_GET['category'])){
		if ($_GET['category'] == 1 || $_GET['category'] == 2 || $_GET['category'] == 3 ) {
				$db->query("UPDATE notif SET status='read' WHERE id = " . $_GET['id']);
				$db->close();
				if($_GET['category'] == 3)
					header('location: admin_control.php?category=5');
				else
					header('location: admin_control.php?category=1');

		}elseif($_GET['category'] == 0) {
				
				// $db->query("UPDATE notif SET status='read' WHERE id = " . $_GET['id']);
				// $query = $db->query("SELECT comment_id FROM notif WHERE id = " . $_GET['id']);
				// $item = $query->fetch_assoc();

				if(isset($_GET['accept']) && $_GET['accept'] == 1)
					$db->query("UPDATE comments SET status='accepted' WHERE id = " . $_GET['c_id']);
				
				header('location: admin_control.php?category=5');
		}
	}



 ?>