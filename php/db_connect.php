<?php
	//connect to the database
	$db_host = 'localhost';
	$db_user = 'gamepeen';
	$db_pass = 'gamepeenadmin';
	$db_name = 'gamepeen';
	$db_link = mysql_connect($db_host,$db_user,$db_pass) or die('Error with MySQL connection');
	mysql_query("SET NAMES 'utf8'") or die('Error encoding');
	mysql_select_db($db_name,$db_link) or die('Error with Database selection');
?>