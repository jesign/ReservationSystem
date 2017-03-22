<?php 
	$db = new MySQLi('localhost', 'root', '', 'reservationsystem');

	list($m,$d,$y) = explode("/",$_POST['date']);
		$timestamp = mktime(0,0,0,$m,$d,$y);
		$newdate = date("Y-m-d",$timestamp);
	if(isset($_POST['category'])){	
		if($_POST['category'] == 'item-ol')
			$queryy = $db->query("SELECT * FROM reservations WHERE rdate = '" . $newdate . "' AND status = 'a' ORDER BY rtime");
		elseif($_POST['category'] == 'service-ol')
			$queryy = $db->query("SELECT * FROM service_reserve WHERE rdate = '" . $newdate . "' AND status = 'a' ORDER BY rtime");
		elseif($_POST['category'] == 'item-wi')
			$queryy = $db->query("SELECT * FROM walkin_reservations WHERE rdate = '" . $newdate . "' ORDER BY rtime");
		elseif($_POST['category'] == 'service-wi')
			$queryy = $db->query("SELECT * FROM walkin_service_reserve WHERE rdate = '" . $newdate . "' ORDER BY rtime");
	}

	$str = "<table class='schedule' >
				<thead>
					<tr>
						<th>Customer</th>
						<th>Date</th>
						<th>Time</th>
					</tr>
				</thead>
				<tbody>";
	$c = 1;
	while ($data = $queryy->fetch_assoc()) {
		$str .= "<tr>
					<td> Customer #" . $c . "</td>
					<td> " . $data['rdate'] . "</td>
					<td> " . $data['rtime'] . "</td>
				</tr>";
		$c++;
	}
	$str .= "</tbody>
		</table> ";
	if($c>1)
		echo $str;
	else
		echo 'There are no scheduled reservation for this day';
	// echo 'yeaaaaaahhhhh';

 ?>