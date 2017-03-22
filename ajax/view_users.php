<?php 

		$db = new MySQLi('localhost', 'root', '', 'reservationsystem');
		
		$sql2 = "SELECT * FROM users ";
		if(isset($_POST['name']) === true && empty($_POST['name']) === false){
			$sql2 .= "WHERE username LIKE '" .
			mysql_real_escape_string(trim($_POST['name'])) . "%'";
		}
		
		$query2 = $db->query($sql2);

		$str = '<table border="2px" class="reservation">
				<thead>
					<th>ID</th>
					<th>Username</th>
					<th>User Level</th>
					<th>Email</th>
				
					<th>Status</th>
					
				</thead>
				<tbody>';
						while ($data = $query2->fetch_assoc()) {
							$str .= '<tr>';
							$str .= '<td>' . $data['id'] .  '</td>';
							$str .= '<td>' . $data['username'] .  '</td>';
							$user = "SELECT * FROM user_level WHERE id = " . $data['user_level'];
							$query = $db->query($user);
							$userlevel = $query->fetch_assoc();
							$str .= '<td>' . $userlevel['level'] .  '</td>';
							$str .= '<td>' . $data['email'] .  '</td>';
						
							if($data['status'] == 'a')
								$str .= "<td><a href='changeStatus.php?id=" . $data['id'] ."'.>Active</a></td>";
							else
								$str .= "<td><a href='changeStatus.php?id=" . $data['id'] ."'.>Inactive</a></td>";
							$str .= '</tr>';
						}

				$str .= '</tbody>
					</table>';
				

		echo $str;


		
 ?>