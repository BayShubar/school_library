<?php
	session_start();
    define('mylibrary', true);
    include("include/conect.php");
    include("include/function.php");

    
 If ($_POST["submit_enter"])
 {
    $login = tazalau($_POST["input_login"]);
    $pass  = tazalau($_POST["input_pass"]);
    
  
 if ($login && $pass)
  {   

   $result = mysql_query("SELECT * FROM admin WHERE login = '$login' AND pass = '$pass'",$link);
   
 If (mysql_num_rows($result) > 0)
  {
    $row = mysql_fetch_array($result);

    $_SESSION['auth_admin'] = 'yes_auth'; 
   

    header("Location:index.php");
  }else
  {
        $msgerror = "Неверный Логин и(или) Пароль."; 
  }

        
    }else
    {
        $msgerror = "Заполните все поля!";
    } 
 }
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="" />
<link href="css/style-log.css" rel="stylesheet" type="text/css" />
	<title>Неназванный 6</title>
</head>
<div id="block-pass-login">
<?php
	if ($msgerror)
    {
	  echo('<p id="alert">'.$msgerror.'</p>'); 
	}
?>
<form method="post">
<ul id="pass-login">
<li><label>Логин</label><input type="text" name="input_login"/> </li>
<li><label>пароль</label><input type="password" name="input_pass"/> </li>
</ul>
<p id="red"><input  type="submit" name="submit_enter" id="submit_enter" value="вход"/></p>
</form>
</div>



<body>
</body>
</html>