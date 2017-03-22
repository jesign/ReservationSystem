<?php 
	$db = new MySQLi('localhost', 'root', '', 'reservationsystem');
	date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d");
	include 'fpdf/fpdf.php';
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', '14');
	$pdf->cell(0, 10 , 'Shoppe and See Vision Center', '0', '1' );

	$pdf->SetFont('Arial', '', '12');
	$pdf->cell(0, 10 , 'Date: ' . $date, '0', '1' );
	$pdf->SetFont('Arial', 'B', '14');

    
    if(isset($_GET['category'])){

		if($_GET['category'] == 1){

			$pdf->cell(0, 10 , 'Item Reservations - Online', '0', '1','C' );
			$pdf->cell(0, 2 , '', '0', '1','C' );

			$pdf->SetFont('Arial', 'B', '10');
			$pdf->Cell(30,10,'Username', '1', '0','C');
			$pdf->Cell(60,10,'Name', '1', '0','C');
			$pdf->Cell(30,10,'Item No.', '1', '0','C');
			$pdf->Cell(30,10,'Date', '1', '0','C');
			$pdf->Cell(30,10,'Time', '1', '1','C');

			$s_rsrv = "SELECT * FROM reservations WHERE finish = 'yes' ORDER BY cdate";
			$q_rsrv = $db->query($s_rsrv);

			while ($rsrv = $q_rsrv->fetch_assoc()) {
				$s_user = "SELECT * FROM users WHERE id = " . $rsrv['user_id'];
				$q_user = $db->query($s_user);
				$user = $q_user->fetch_assoc();
				$pdf->Cell(30,10,   $user['username'] , '1', '0','C');
				$pdf->Cell(60,10,$user['firstname'] . ' ' . $user['lastname'], '1', '0','C');
				$pdf->Cell(30,10, $rsrv['item_id'], '1', '0','C');
				$pdf->Cell(30,10, $rsrv['cdate'] , '1', '0','C');
				$pdf->Cell(30,10, $rsrv['ctime'] , '1', '1','C');
			}

			$db->close();
			$pdf->Output();

		} elseif($_GET['category'] == 2){
			
			$pdf->cell(0, 10 , 'Service Reservations - Online', '0', '1','C' );
			$pdf->cell(0, 6 , '', '0', '1','C' );

			$s_rsrv = "SELECT * FROM service_reserve WHERE finish = 'yes' ORDER BY cdate";
			$q_rsrv = $db->query($s_rsrv);

			while ($rsrv = $q_rsrv->fetch_assoc()) {
				$s_user = "SELECT * FROM users WHERE id = " . $rsrv['user_id'];
				$q_user = $db->query($s_user);
				$user = $q_user->fetch_assoc();
				$pdf->SetFont('Arial', '', '12');
				$pdf->Cell(100,10, 'Username:  ' . $user['username'] , '0', '0');
				$pdf->Cell(100,10, 'Name: ' . $user['firstname'] . ' ' . $user['lastname'], '0', '1');
				$pdf->Cell(100,10, 'Date: ' . $rsrv['cdate'] , '0', '0');
				$pdf->Cell(100,10, 'Time: ' . $rsrv['ctime'] , '0', '1');
				$s_slist = "SELECT * FROM service_list WHERE service_id = " . $rsrv['id'];
				$q_slist = $db->query($s_slist);
				$pdf->Cell(100,10, 'Services: ', '0', '1');
				while ($slist = $q_slist->fetch_assoc()) {
					$pdf->MultiCell(50,10, '    -' . $slist['services'] , '0', '1');
				}
				$pdf->Cell(185,10,'--------------------------------------------------------------------------------------------------------------------', '0', '1', 'C');
			}

			$db->close();
			$pdf->Output();
		} elseif($_GET['category'] == 3){
			
			$pdf->cell(0, 10 , 'Item Reservations - Walk-in', '0', '1','C' );
			$pdf->cell(0, 2 , '', '0', '1','C' );

			$pdf->SetFont('Arial', 'B', '10');
			
			$pdf->Cell(60,10,'Name', '1', '0','C');
			$pdf->Cell(30,10,'Item No.', '1', '0','C');
			$pdf->Cell(30,10,'Date', '1', '0','C');
			$pdf->Cell(30,10,'Time', '1', '1','C');

			$s_rsrv = "SELECT * FROM walkin_reservations WHERE finish = 'yes' ORDER BY cdate";
			$q_rsrv = $db->query($s_rsrv);

			while ($rsrv = $q_rsrv->fetch_assoc()) {
				$s_user = "SELECT * FROM walk_in WHERE id = " . $rsrv['walkin_id'];
				$q_user = $db->query($s_user);
				$user = $q_user->fetch_assoc();
				
				$pdf->Cell(60,10,$user['first_name'] . ' ' . $user['last_name'], '1', '0','C');
				$pdf->Cell(30,10, $rsrv['item_id'], '1', '0','C');
				$pdf->Cell(30,10, $rsrv['cdate'] , '1', '0','C');
				$pdf->Cell(30,10, $rsrv['ctime'] , '1', '1','C');
			}

			$db->close();
			$pdf->Output();
		}elseif($_GET['category'] == 4){
			
			$pdf->cell(0, 10 , 'Service Reservations - Online', '0', '1','C' );
			$pdf->cell(0, 6 , '', '0', '1','C' );

			$s_rsrv = "SELECT * FROM walkin_service_reserve WHERE finish = 'yes' ORDER BY cdate";
			$q_rsrv = $db->query($s_rsrv);

			while ($rsrv = $q_rsrv->fetch_assoc()) {
				$s_user = "SELECT * FROM walk_in WHERE id = " . $rsrv['walkin_id'];
				$q_user = $db->query($s_user);
				$user = $q_user->fetch_assoc();
				$pdf->SetFont('Arial', '', '12');
				$pdf->Cell(100,10, 'Name: ' . $user['first_name'] . ' ' . $user['last_name'], '0', '1');
				$pdf->Cell(100,10, 'Date: ' . $rsrv['cdate'] , '0', '0');
				$pdf->Cell(100,10, 'Time: ' . $rsrv['ctime'] , '0', '1');
				$s_slist = "SELECT * FROM walkin_service_list WHERE service_id = " . $rsrv['id'];
				$q_slist = $db->query($s_slist);
				$pdf->Cell(100,10, 'Services: ', '0', '1');
				while ($slist = $q_slist->fetch_assoc()) {
					$pdf->MultiCell(50,10, '    -' . $slist['services'] , '0', '1');
				}
				$pdf->Cell(185,10,'--------------------------------------------------------------------------------------------------------------------', '0', '1', 'C');
			}

			$db->close();
			$pdf->Output();
		}
	}

 ?>
 <!-- $pdf->Cell(40,10,$user['firstname'] . ' ' . $user['lastname'], '1', '0','C'); -->