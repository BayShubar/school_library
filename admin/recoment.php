<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth")
{       
       if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }

  $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='news.php' >Рекомендации</a>";
  
include("include/db_connect.php");
include("include/functions.php");
$id = clear_string($_GET["id"]);
$action = $_GET["action"];
if (isset($action))
{

   switch ($action) {

      case 'accept':

        $update = mysql_query("UPDATE recomend SET acces='1' WHERE id = '$id'",$link);  
      break;
        case 'delete':
        $delete = mysql_query("DELETE FROM recomend WHERE id = '$id'",$link);      
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
    $all_count = mysql_query("SELECT * FROM recomend",$link);
    $result_count = mysql_num_rows($all_count);
   
?>
<div id="block-content">
<div id="block-parameters">
<p id="count-client" >Нового рекомендации- <strong><?php echo $result_count; ?></strong></p>
</div>
<?php
if (isset($msgerror)) echo '<p id="form-error" align="center">'.$msgerror.'</p>';

if ($message != "") echo $message;

$result = mysql_query("SELECT * FROM recomend ORDER BY id DESC",$link);
 
 If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{  

    if ($row["acces"] == '0'){ $link_accept = '<a class="green" href="recoment.php?id='.$row["id"].'&action=accept" >Принять</a> | ';  } else { $link_accept = '';  }
    
    echo '
    
<div class="block-news">

<h3>'.$row["bookname"].'</h3>
<span>'.$row["date"].' , '.$row["name"].'</span>
<p>'.$row["reason"].'</p>
 <p class="links-actions" align="right" >'.$link_accept.'<a class="delete" rel="recoment.php?id='.$row["id"].'&action=delete" >Удалить</a> </p>


</div>
    
    ';    
} while ($row = mysql_fetch_array($result));
} 	
?>
<div id="news">
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