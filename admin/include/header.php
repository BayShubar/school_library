<?php
	defined('mylibrary') or die('no acces!');
?>
<div id="">
<div id="basi">

<div id="basi1" >
<h3>E-SHOP. Панель Управления</h3>
<p id="link-nav"><?php echo $_SESSION['urlpage']; ?></p> 
</div>

<div id="basi2" >
<p align="right"><a href="administrators.php" >Администраторы</a> | <a href="?logout">Выход</a></p>
<p align="right">Вы - <span></span></p>
</div>

</div>

<div id="left-nav">
<ul>
<li><a href="tovar.php">книги</a></li>
<li><a href="reviews.php">Отзывы</a></li>
<li><a href="category.php">Категории</a></li>
<li><a href="news.php">Новости</a></li>
</ul>
</div>
</div>