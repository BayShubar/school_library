<div id="block-category">
<p class="header-title">пойск по языкам</p>
<ul class="languagesimage" >
<li><a id="index1"><img src="/library/www/images/kazakhstan.png" id="kazakh-image"/>Казахскии</a> 
<ul class="category-section">
<li><a><strong>по жанрам</strong></a> </li>

<?php


	$result=mysql_query("SELECT * FROM category WHERE language='Казахскии'",$link);
    if (mysql_num_rows($result)>0)
    {
    $row=mysql_fetch_array($result);
    do
    {
        echo '
       <li><a href="view.php?cat='.strtolower($row["ganre"]).'&language='.$row["language"].'">'.$row["ganre"].'</a></li>

        ';        
    }
    While ($row=mysql_fetch_array($result));
    }
    
?>


</ul>
</li>
</ul>


<ul class="languagesimage">
<li><a id="index2"><img src="/library/www/images/russia.png" id="russia-image"/>Русский</a> 
<ul class="category-section">
<li><a><strong>по жанрам</strong></a> </li>
<?php
	$result=mysql_query("SELECT * FROM category WHERE language='Русский'",$link);
    if (mysql_num_rows($result)>0)
    {
    $row=mysql_fetch_array($result);
    do
    {
        echo '
       <li><a href="view.php?cat='.strtolower($row["ganre"]).'&language='.$row["language"].'">'.$row["ganre"].'</a></li>

        ';     // выводить информацию равную на Руский   
    }
    While ($row=mysql_fetch_array($result));
    }
    
?>

</ul>
</li>
</ul>


<ul class="languagesimage">
<li><a id="index3" ><img src="/library/www/images/English.png" id="english-image"/>English</a> 
<ul class="category-section">
<li><a><strong>по жанрам</strong></a> </li>
<?php
	$result=mysql_query("SELECT * FROM category WHERE language='English'",$link);
    if (mysql_num_rows($result)>0)
    {
    $row=mysql_fetch_array($result);
    do
    {
        echo '
       <li><a href="view.php?cat='.strtolower($row["ganre"]).'&language='.$row["language"].'">'.$row["ganre"].'</a></li>

        ';        
    }
    While ($row=mysql_fetch_array($result));
    }
    
?>


</ul>
</li>


</ul>
</div>