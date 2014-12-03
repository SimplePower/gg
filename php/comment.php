<?php
	include("db_connect.php");
	
	//information from database
	$like = $_POST['like'];	
	$comment = $_POST['comment'];	
	$game_id = $_POST['game_id'];
	$member = $_POST['member'];
	
	$sql = "INSERT INTO `gamepeen`.`game_info` (`like`, `comment`, `game_id`, `member`) VALUES ('$like','$comment','$game_id','$member');";

?>