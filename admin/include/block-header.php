<?php

$result1 = mysql_query("SELECT * FROM comment WHERE podtver='0'",$link);
    $count1 = mysql_num_rows($result1);
    
    if ($count2 > 0) { $count_str2 = '<p>+'.$count2.'</p>'; } else { $count_str2 = ''; }
 
    $result2 = mysql_query("SELECT * FROM recomend WHERE acces='0'",$link);
    $count2 = mysql_num_rows($result2);
    
    if ($count2 > 0) { $count_str2 = '<p>+'.$count2.'</p>'; } else { $count_str2 = ''; }
?>
<div id="block-header">
<div id="block-header1" >
<h3>BOOK. Панель Управления</h3>
<p id="link-nav" ><?php echo $_SESSION['urlpage']; ?></p> 
</div>

<div id="block-header2" >
<p align="right"><a href="administrators.php" >Администраторы</a> | <a href="?logout">Выход</a></p>
<p align="right">Вы - <span>admin</span></p>
</div>

</div>

<div id="left-nav">
<ul>
<li><a href="book.php">Kниги</a></li>
<li><a href="acceptcoment.php">Отзывы</a><?php echo $count_str1; ?></li>
<li><a href="recoment.php">рекомендации</a><?php echo $count_str2; ?></li>
<li><a href="reference.php">ресурсы</a></li>
<li><a href="news.php">Новости</a></li>
</ul>
</div>