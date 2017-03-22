<?php 

	include 'function.php';
	include 'menu.php';
	
	if($user_level !=1){
		header('location: index.php');
	}
?> 	
	<input type="text" id="search_uname">
	<button id="view">yeah</button>
	<br>
	<div class="yeah"></div>

<?php 
	include 'javascripts.php';
 ?>


