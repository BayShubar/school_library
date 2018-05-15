<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth")
{

       
       if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }

  $_SESSION['urlpage'] = "<a href='index.php' >Главная</a>";
  include("include/db_connect.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
	<title>Панель Управления</title>
</head>
<body>
<div id="block-body">
<?php
	include("include/block-header.php");
 // Общее количество книг
 $query2 = mysql_query("SELECT * FROM book",$link);
 $result2 = mysql_num_rows($query2);   
 // Общее количество отзывов 
 $query3 = mysql_query("SELECT * FROM comment",$link);
 $result3 = mysql_num_rows($query3);
  // Общее количество рекомендации 
 $query4 = mysql_query("SELECT * FROM recomend",$link);
 $result4 = mysql_num_rows($query4);

?>
<div id="block-content">
<div id="block-parameters">
<p id="title-page">main</p>
</div>
<ul id="general-statistics">
<li><p>Книги - <span><?php echo $result2; ?></span></p></li>
<li><p>Отзывы - <span><?php echo $result3; ?></span></p></li>
<li><p>Рекомендации - <span><?php echo $result4; ?></span></p></li>
</ul>

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