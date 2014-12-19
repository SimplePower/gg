<?php 
	include("db_connect.php");

	//record the login information
	$account = mysql_real_escape_string($_POST['account']);
	$password = mysql_real_escape_string($_POST['password']);
	
	//for checking all the variables are numbers or letters
	$standard_en = "/^([0-9 A-Z a-z]+)$/";
	$standard_space = "/^([\S]+)$/";
	
	//detect for the null input
	if(!($account) || !($password))
		echo "請完整輸入帳號和密碼！！";
	
	else if(!(preg_match($standard_space, $account, $array)) || !(preg_match($standard_space, $password, $array)))
		echo "請勿輸入空白鍵！！";
	
	//detect for the wrong input even SQL injection
	else if(!(preg_match($standard_en, $account, $account)) || !(preg_match($standard_en, $password, $password)))
		echo "您輸入的資料格式有錯！！";
	
	else
	{
		$check = "SELECT `password`,`name` FROM `member` WHERE `account` LIKE '$account[0]';";
		$result = mysql_query($check);
	
		if($result)
		{
			//check for the account existed or not
			if(mysql_num_rows($result) == 1)
			{
				$row = mysql_fetch_row($result);
				$check_password = $row[0];
				
				//check the correct password
				if($check_password == $password[0])	
					echo "~~歡迎回來 $row[1]~~";	
				else
					echo "請輸入正確的密碼！！";
			}
			
			else
				echo "您輸入了不存在的帳號！！";
		}
	
		else
			echo "您輸入的資料有錯！！";
	}	
?>