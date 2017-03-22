<?php 
    
	include "function.php";

    if(loggedin()){
        


    $db = new MySqli('localhost', 'root', '', 'reservationsystem');
    date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d");
    $time = date("h:i"); 

    if($user_level == 1){
        $sql = 'INSERT INTO `comments`(`user_id`, `comment`, `date`, `time`, `status`) 
                    VALUES ( 
                        "' . $my_id . '", 
                        "' . $_POST['comment'] . '", 
                        "' . $date . '", 
                        "' . $time . '",
                        "accepted")';
    
        $db->query($sql);

    }else{

        $sql = 'INSERT INTO `comments`(`user_id`, `comment`, `date`, `time`) 
                        VALUES ( 
                            "' . $my_id . '", 
                            "' . $_POST['comment'] . '", 
                            "' . $date . '", 
                            "' . $time . '")';
        
        $db->query($sql);
        $lastID = $db->insert_id;
        
        $db->query("INSERT INTO `notif`(`user_id`, `comment_id`, `type`, `status`, `date`, `time`) 
                    VALUES ('" . $my_id . "', '" . $lastID . "', '0', 'unread', '" . $date . "', '" . $time . "')"  . "");
    }

    header('location: index.php?comment=1');
    }
    else
        header('location: login.php');