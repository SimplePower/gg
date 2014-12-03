<?php
	include("db_connect.php");
	
	/****** record the member information ******/
	$account = $_POST['account'];
	$password = $_POST['password'];
	$re_password = $_POST['re_password'];
	$name = $_POST['name'];
	$like = $_POST['like'];
	/*******************************************/
	
	//count the number of each member
	$check = "SELECT * FROM `member`;";
	$result = mysql_query($check); 
	$total_number = 1 + mysql_num_rows($result);
	
	$check = "SELECT * FROM `member` WHERE `account` LIKE '$account';";
	$result = mysql_query($check);
	
	//detect for the null input
	if(!($account) || !($password) || !($name) || !($like))
		echo "請確定每個資料都正確填入！！";
	
	else
	{
		//detect whether there is wrong input
		if($result)
		{
			//detect whether the account has existed
			if(mysql_num_rows($result) < 1)
			{
				//check the same password
				if($re_password == $password)
				{
					$sql = "INSERT INTO `gamepeen`.`member`(`num`,`account`,`password`,`name`,`like`)VALUES('$total_number','$account','$password','$name','$like');";
					//detect whether there is wrong input
					if(mysql_query($sql,$db_link))
						echo "~~恭喜加入我們~~";
				
					else
						echo "您輸入的資料有錯！！";
				}
				
				else
					echo "請重新確認輸入的密碼！！"	;	
			}
		
			else
				echo "帳號已經有人使用！！";
		}
	
		else
			echo "您輸入的資料有錯！！";
	}
	
?>
