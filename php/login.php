<?php 
	include("db_connect.php");

	//record the login information
	$account = $_POST['account'];
	$password = $_POST['password'];
	
	$check = "SELECT `password`,`name` FROM `member` WHERE `account` LIKE '$account';";
	$result = mysql_query($check);
	
	//check for the null input
	if(($account) && ($password))
	{
		if($result)
		{
			//check for the account existed or not
			if(mysql_num_rows($result) == 1)
			{
				$row = mysql_fetch_row($result);
				$check_password = $row[0];
				
				//check the correct password
				if($check_password == $password)	
					echo "~~歡迎回來 $row[1]~~";	
				else
					echo "請輸入正確的密碼！！";
			}
			
			else
				echo "您輸入了不存在的帳號！！";
		}
	
		else
			echo "wrong input";
	}
	
	else
		echo "請完整輸入帳號和密碼！！";
	
?>