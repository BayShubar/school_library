<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
session_start();

if ($_SESSION['likeid'] != (int)$_POST["id"])
{
	 include("conect.php");
  
     $id = (int)$_POST["id"];	
	
$result = mysql_query("SELECT * FROM book WHERE idbook = '$id'",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result); 
   
$new_count = $row["yes_like"] + 1;
$update = mysql_query ("UPDATE book SET yes_like='$new_count' WHERE idbook='$id'",$link);
echo $new_count;
   
}
$_SESSION['likeid'] = (int)$_POST["id"]; 
}
else
{
    echo 'no';
}
}
?>