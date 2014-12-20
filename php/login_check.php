<?php
	//check the session start or not
	if(!isset($_SESSION))
		session_start();
	
	include("db_connect.php");
	
	//initial variables for developing the random number
	$answer_str = 0;
	$answer_now = '';
	
	/****** record the member information ******/
	$account = sprintf("%s",mysql_real_escape_string($_POST['account']));
		
	$password = mysql_real_escape_string($_POST['password']);
	$re_password = mysql_real_escape_string($_POST['re_password']);
	$name = mysql_real_escape_string($_POST['name']);
	$like = mysql_real_escape_string($_POST['like']);
	$answer_check = mysql_real_escape_string($_POST['answer_check']);
	/*******************************************/

	//for checking all the variables are numbers or letters
	$standard_en = "/^([0-9 A-Z a-z]+)$/";
	$standard_ch = "/^([\x7f-\xff]+)$/";
	$standard_en_ch = "/^([0-9 A-Z a-z \x7f-\xff]+)$/";
	$standard_space = "/^([\S]+)$/";

	//detect for the null input
	if(!($account) || !($password) || !($name) || !($like) ||!($answer_check))
		echo "請確定每個資料都正確填入！！";
	
	else if(!(preg_match($standard_space, $account, $array)) || !(preg_match($standard_space, $password, $array)) || !(preg_match($standard_space, $name, $array)) || !(preg_match($standard_space, $like, $array)))
		echo "請勿輸入空白鍵！！";
	
	
	//detect for the wrong input even SQL injection
	else if(!(preg_match($standard_en, $account, $account)) || !(preg_match($standard_en, $password, $password)) || !(preg_match($standard_en_ch, $name, $name)) || !(preg_match($standard_ch, $like, $like)))
		echo "您輸入的資料格式有錯！！";
	
	else
	{
		//check answer_word and answer_check empty ; if not , check the value equal or not
		if((!empty($_SESSION['answer_word'])) && (!empty($_POST['answer_check'])) && ($_SESSION['answer_word'] == $_POST['answer_check']))
		{
			//pass the check
			$_SESSION['answer_word'] = '';
			
			//check for the 
			$query = "SELECT * FROM `member` WHERE `account` = '$account[0]';";
			$result = mysql_query($query);
			
			//detect whether there is wrong input
			if($result)
			{
				//detect whether the account has existed
				if(mysql_num_rows($result) < 1)
				{
					//check the same password
					if($re_password == $password[0])
					{
						//count the number of each member
						$check = "SELECT * FROM `member`;";
						$result = mysql_query($check); 
						$total_number = 1 + mysql_num_rows($result);
						
						$sql = "INSERT INTO `gamepeen`.`member`(`num`,`account`,`password`,`name`,`game_like`)VALUES('$total_number','$account[0]','$password[0]','$name[0]','$like[0]');";
												
						//detect whether there is wrong input
						if(mysql_query($sql,$db_link))
						{
							echo "~~恭喜加入我們~~";
							exit;
						}
							
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

		else
			echo "您輸入了錯誤的驗證碼！！";
	}
	
	//not pass check，reset the random number for check
	$_SESSION['answer_word'] == '';	
	mt_srand((double)microtime() * 1000000);
		
	//random choose six chars form a-z
	for($a = 0; $a < 6; $a++)
	{
		$answer_str = mt_rand(97,122);
		$answer_now .= chr($answer_str);
	}
					
	$_SESSION['answer_word'] = $answer_now;	
?>