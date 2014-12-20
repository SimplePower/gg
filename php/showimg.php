<?php
	//check the session start or not
	if(!isset($_SESSION))
		session_start();
	
	//for the first random codes
	if(!($_SESSION['answer_word']))
	{
		//initial variables for developing the random number
		$answer_str = 0;
		$answer_now = '';
	
		//set the random number for check
		$_SESSION['answer_word'] = '';	
		mt_srand((double)microtime() * 1000000);
		
		//random choose six chars form a-z
		for($a = 0; $a < 6; $a++)
		{
			$answer_str = mt_rand(97,122);
			$answer_now .= chr($answer_str);
		}
		
		$_SESSION['answer_word'] = $answer_now;	
	}
	
	//initial the variable for the image developing
	$s_x = 0;
	$s_y = 0;
	$answer_right_move = '';

	//developing the checking number image
	$image = imagecreate(85,26);
	$word_color = imagecolorallocate($image,255,0,0);				//color of word				
	$back_color = imagecolorallocate($image,200,200,200);			//color of the back of the word

	imagefill($image,0,0,$back_color);
	mt_srand((double)microtime() * 1000000);						//reset the random number

	//random 30 dots
	$s_dot = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	for($a = 0 ; $a < 30 ; $a++)
		imagesetpixel($image,mt_rand(10,75),mt_rand(5,20),$s_dot);
	
	
	//for words float randomly
	$s_x = mt_rand(5,10);
	for($a = 0 ; $a < 6 ; $a++)
	{
		$answer_right_move = substr($_SESSION['answer_word'],$a,1);
		$s_y = mt_rand(1,8);
		imagestring($image,5,$s_x,$s_y,$answer_right_move,$word_color);
		$s_x += mt_rand(8,14);
	}

	//print out the image
	header('Content-type: image/png');
	imagepng($image);
	imagedestroy($image);
?>