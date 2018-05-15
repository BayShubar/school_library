<?php
	include("include/conect.php");  
     include("function/function.php"); 
     $search=tazalau($_GET["q"]);
?>


<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html"  />
	
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/jcarousellite_1.0.1.js"></script> 
    <script type="text/javascript" src="js/library-script.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.min.js"></script>

	<title>поиск-<?php  echo $search;?></title>
</head>

<body>
<div id="block-body">

<?php
	include("include/block-header.php");
?>

<div id="block-right">
<?php
	include("include/block-category.php");
  
?>
</div>




<div id="block-content">
<ul id="books">
    <?php
    $num =2; 
    $page =(int)$_GET['page'];
    $count = mysql_query("SElECT COUNT(*) FROM book WHERE title LIKE '%$search%' ",$link);
    $temp=mysql_fetch_array($count);
    If ($temp[0] > 0)
    {
        $temcount= $temp[0];
        $total = (($temcount-1)/ $num)+ 1;
        $total=intval($total);
        
        $page= intval($page);
        if(empty($page) or $page < 0) $page=1;
        
        if($page > $total) $page=$total;
        
        $start= $page * $num - $num;
        $query_start_num = " LIMIT $start, $num";
    }
     If ($temp[0] > 0)
    {   
    
         $result = mysql_query("SELECT * FROM book WHERE title LIKE '%$search%'  LIMIT $start, $num ",$link);
    if (mysql_num_rows($result) > 0)
    {
    $row = mysql_fetch_array($result); 
    do
    { 
 $query_reviews=mysql_query("SELECT * FROM comment WHERE book_id='{$row["idbook"]}' AND podtver='1'",$link);
$count_reviews=mysql_num_rows($query_reviews);
        echo  '
         <li> 
                 <div id="imagebook"> 
                 <img src="/library/www/bookimages/'.$row["image"].'"/>                
                 </div>
             <p class="stylebook"> <a href="content.php?id='.$row["idbook"].'">'.$row["title"].' </a></p>
             <ul class="comentbook">
             <li><img src="/library/www/images/comment-icon.png" /> <p>'.$count_reviews.'</p></li>
             </ul>
                 <ul class="features">
                 <li><p>author: '.$row["author"].'</p></li>
                 <li><p>language: '.$row["language"].'</p></li>
                 <li><p>genres: '.$row["type"].'</p></li>
                 <li><p>year:'.$row["year"].'</p></li>
                 </ul>
             <div id="minidesciption" > 
             <p><strong> Description: </strong>  '.$row["minidescription"].'...</p>
             </div>
         </li>
     ';   
    }
     while ($row = mysql_fetch_array($result));
}    

echo '</ul>';

if ($page != 1){ $pstr_prev = '<li><a class="pstr-prev" href="poisk.php?q='.$search.'&?page='.($page - 1).'">&lt;</a></li>';}
if ($page != $total) $pstr_next = '<li><a class="pstr-next" href="poisk.php?q='.$search.'&?page='.($page + 1).'">&gt;</a></li>';


if($page - 5 > 0) $page5left = '<li><a href="poisk.php?q='.$search.'&page='.($page - 5).'">'.($page - 5).'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="poisk.php?q='.$search.'&page='.($page - 4).'">'.($page - 4).'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="poisk.php?q='.$search.'&page='.($page - 3).'">'.($page - 3).'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="poisk.php?q='.$search.'&page='.($page - 2).'">'.($page - 2).'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="poisk.php?q='.$search.'&page='.($page - 1).'">'.($page - 1).'</a></li>';

if($page + 5 <= $total) $page5right = '<li><a href="poisk.php?q='.$search.'&page='.($page + 5).'">'.($page + 5).'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="poisk.php?q='.$search.'&page='.($page + 4).'">'.($page + 4).'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="poisk.php?q='.$search.'&page='.($page + 3).'">'.($page + 3).'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="poisk.php?q='.$search.'&page='.($page + 2).'">'.($page + 2).'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="poisk.php?q='.$search.'&page='.($page + 1).'">'.($page + 1).'</a></li>';


if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="poisk.php?q='.$search.'&page='.$total.'">'.$total.'</a></li>';
}else
{
    $strtotal = ""; 
}

if ($total > 1)
{
    echo '
    <div class="pstrnav">
    <ul>
    ';
    echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='poisk.php?q=".$search."&page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
    echo '
    </ul>
    </div>
    ';
}
} else {
    echo'<div id="alert"><h2>Ничего ни найдено </h2> </div>';
} 
    ?>
</div>





<?php
	include("include/block-footer.php")
 ?>
</div>

</body>
</html>