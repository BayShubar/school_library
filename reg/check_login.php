<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
include("../include/conect.php");
include("../function/function.php");

$login = tazalau($_POST['login-reg']);

$result = mysql_query("SELECT Login FROM user_registr WHERE Login = '$login'",$link);
If (mysql_num_rows($result) > 0)
{
   echo 'false';
}
else
{
   echo 'true'; 
}
}
?>