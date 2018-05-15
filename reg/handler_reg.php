<?php

 if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
 include("../include/conect.php");
 include("../function/function.php");
 
     $error = array();
         
        $login = iconv("UTF-8", "UTF-8",strtolower(tazalau($_POST['login-reg']))); 
        $pass = iconv("UTF-8", "UTF-8",strtolower(tazalau($_POST['pass-reg']))); 
        $surname = iconv("UTF-8", "UTF-8",tazalau($_POST['surname-reg'])); 
        $name = iconv("UTF-8", "UTF-8",tazalau($_POST['name-reg'])); 
        $email = iconv("UTF-8", "UTF-8",tazalau($_POST['email-reg'])); 
        
 
    if (strlen($login) < 5 or strlen($login) > 15)
    {
       $error[] = "Логин должен быть от 5 до 15 символов!"; 
    }
    else
    {   
     $result = mysql_query("SELECT Login FROM user_registr WHERE Login = '$login'",$link);
    If (mysql_num_rows($result) > 0)
    {
       $error[] = "Логин занят!";
    }
            
    }
     
    if (strlen($pass) < 7 or strlen($pass) > 15) $error[] = "Укажите пароль от 7 до 15 символов!";
    if (strlen($surname) < 3 or strlen($surname) > 20) $error[] = "Укажите Фамилию от 3 до 20 символов!";
    if (strlen($name) < 3 or strlen($name) > 15) $error[] = "Укажите Имя от 3 до 15 символов!";
    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",trim($email))) $error[] = "Укажите корректный email!";
    if($_SESSION['img_captcha'] != strtolower($_POST['reg_capcha'])) $error[] = "Неверный код с картинки!";
    unset($_SESSION['img_captcha']);
    
   if (count($error))
   {
    
 echo implode('<br />',$error);
     
   }else
   {   
        $pass   = md5($pass);
        $pass   = strrev($pass);
        $pass   = "9nm2rv8q".$pass."2yo6z";
        
        $ip = $_SERVER['REMOTE_ADDR'];
		
		mysql_query("	INSERT INTO user_registr (Login,pass,surname,name,email,date,ip)
						VALUES(
						
							'".$login."',
							'".$pass."',
							'".$surname."',
							'".$name."',
                            '".$email."',
                            NOW(),
                            '".$ip."'							
						)",$link);

 echo 'true';
 }        


}
?>