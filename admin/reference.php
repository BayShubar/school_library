<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth")
{       
       if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }

  $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='reference.php' >Ресурсы</a>";
  
include("include/db_connect.php");
include("include/functions.php");

 if ($_POST["submit_news"])
 {
     
    if ($_POST["news_title"] == "" || $_POST["news_text"] == ""|| $_POST["sylka"] == "")
    {
        $message = "<p id='form-error' >Заполните все поля!</p>";
    }
    else
    {
       	mysql_query("INSERT INTO sylka (title,mintext,reference)
						VALUES(	
                            '".$_POST["news_title"]."',
                            '".$_POST["news_text"]."',	
                            '".$_POST["sylka"]."',				                                                                 
						    )",$link); 
       $message = "<p id='form-success' >ресурс добавленa!</p>";                     
    }
         
 }
             
$id = clear_string($_GET["id"]);
$action = $_GET["action"];
if (isset($action))
{
   switch ($action) {
        
        case 'delete':
        $delete = mysql_query("DELETE FROM sylka WHERE id = '$id'",$link);             
	    break;
        
	} 
    
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css" />
    <link href="fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/script.js"></script> 
    <script type="text/javascript" src="jquery_confirm/jquery_confirm.js"></script>  
    <script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>    
<script type="text/javascript">
	$(document).ready(function(){
    $(".news").fancybox();  
});
</script>

	<title>Панель управление-новости</title>
</head>
<body>
<div id="block-body">
<?php
	include("include/block-header.php");
    $all_count = mysql_query("SELECT * FROM sylka",$link);
    $result_count = mysql_num_rows($all_count);
   
?>
<div id="block-content">
<div id="block-parameters">
<p id="count-client" >Нового новостей - <strong><?php echo $result_count; ?></strong></p>
<p align="right" id="add-style"><a class="news" href="#news" >добавить</a></p>
</div>
<?php
if (isset($msgerror)) echo '<p id="form-error" align="center">'.$msgerror.'</p>';

if ($message != "") echo $message;

$result = mysql_query("SELECT * FROM sylka ORDER BY id DESC",$link);
 
 If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{  
    
    echo '
    
<div class="block-news">

<h3>'.$row["title"].'</h3>
<p>'.$row["mintext"].'</p>
<p>'.$row["reference"].'</p>
<p class="links-actions" align="right" ><a class="delete" rel="reference.php?id='.$row["id"].'&action=delete" >удалить</a></p>
</div>
    
    ';
    
    
} while ($row = mysql_fetch_array($result));
} 	
?>
<div id="news">

<form method="post">
<div id="block-input">
 <label>Загаловк <input type="text" name="news_title" /></label>
 <label>Описание<textarea name="news_text" ></textarea></label>
  <label>ссылка<input type="text" name="sylka" /></label>
</div>
<p align="right">
<input type="submit" name="submit_news" id="submit_news" value="добавить" />
</p>
</form>

</div>
</div>
</div>
</body>
</html>
<?php
}else
{
    header("Location: login.php");
}
?>