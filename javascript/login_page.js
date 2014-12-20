//close the right click
document.oncontextmenu = function(){ return false; } 

//check the information user input and join member
function login_check()
{
	$.ajax({
		url:"php/login_check.php",
		data:
		{
			account:jQuery('input[name = account_join]').val(),
			password:jQuery('input[name = password_join]').val(),
			re_password:jQuery('input[name = re_password_join]').val(),
			name:jQuery('input[name = name]').val(),
			like:jQuery('select[name = like]').val(),
			answer_check:jQuery('input[name = answer_check]').val()
		},
					
		type:"POST",
				
		success:function(res)
		{
			$('.loading').remove();
			$('#member_information').show();			
			alert(res);
			

			//successfully joined
			/*
			if(res == "~~恭喜加入我們~~")
			{
				
			}*/
		}
	});
								
	$('#member_information').hide();
	$('#member_joining').append('<h2 class="loading" style="margin-left:45%; margin-top:45%;"><i>請稍候');
	$('#member_joining').append('<img class="loading" src="img/loading.gif" style="margin-left:39%;">');
				
	return false;
}

//for the member login
function login()
{
	$.ajax({
		url:"php/login.php",
		data:
		{
			account:jQuery('input[name = member_account]').val(),
			password:jQuery('input[name = member_password]').val()
		},
					
		type:"POST",
				
		success:function(res)
		{
			$('#loading').remove();
			$('#member_login input[type = submit]').show();
			alert(res);			
			
			if(res == "請輸入正確的密碼！！" || res == "您輸入了不存在的帳號！！" || res == "請完整輸入帳號和密碼！！")
			{
				//$('form[name = member_login]').show();
				
			}
					
			//for the successfully login
			/*
			else
			{
				
			}
			*/
		}
	});
				
		$('#member_login input[type = submit]').hide();
		$('#member_login form').append('<img id="loading" src="img/loading.gif" style="width:18%; margin-top:2.5%; margin-left:5%;">');
				
		return false;
}

//show the check codes image			
function show_checkimg()
{
	jQuery('#show_check_num').html("<img src= php/showimg.php>"); 
}