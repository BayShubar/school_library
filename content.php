<?php
	include("include/conect.php");  
	include("function/function.php"); 
    $id = tazalau ($_GET["id"]); 
?>


<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="cp1251" />
	
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/jcarousellite_1.0.1.js"></script> 
    <script type="text/javascript" src="js/library-script.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.min.js"></script>
     <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css" />
   <script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
   <script type="text/javascript" src="js/jTabs.js"></script>
	<title>library of nis</title>
    
        <script type="text/javascript">
        $(document).ready(function(){
        $("ul.tabs").jTabs({content: ".tabs_content", animate: true, effect:"slide"}); 
        $(".send-review").fancybox();
        });	
        </script>    
    
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
<?php
$result1 = mysql_query("SELECT * FROM book WHERE idbook='$id'",$link);
If (mysql_num_rows($result1) > 0)
{
$row1 = mysql_fetch_array($result1);
do
{   
if  (strlen($row1["image"]) > 0 && file_exists("./bookimages/".$row1["image"]))
{
        $img_path = './bookimages/'.$row1["image"];
        $max_width = 300; 
        $max_height = 300; 
         list($width, $height) = getimagesize($img_path); 
        $ratioh = $max_height/$height; 
        $ratiow = $max_width/$width; 
        $ratio = min($ratioh, $ratiow); 
        
        $width = intval($ratio*$width); 
        $height = intval($ratio*$height);    
        }else
        {
        $img_path = "/library/www/images/no-image.png";
        $width = 110;
        $height = 200;
}     

$query_reviews=mysql_query("SELECT * FROM comment WHERE book_id='{$row1["idbook"]}' AND podtver='1'",$link);
$count_reviews=mysql_num_rows($query_reviews);

echo  '

        <div id="block-rating">
        <p id="nad-rating"><a href="search.php?type=mobile">Все книги</a> \ <span>'.$row1["type"].'</span></p>

        <div id="block-like">
        <p id="likegood" tid="'.$id.'" >Нравится</p><p id="likegoodcount" >'.$row1["yes_like"].'</p>
        </div>
        
        </div>

        <div id="content-detail">
        <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
        <div id="block-description">
        <p id="content-title">'.$row1["title"].'</p>
        <ul class="features-big">
                         <li><img src="/library/www/images/comment-icon.png" /> <h4>'.$count_reviews.'</h4> </li>
                         <li><p>author: '.$row1["author"].'</p></li>
                         <li><p>language: '.$row1["language"].'</p></li>
                         <li><p>genres: '.$row1["type"].'</p></li>
                         <li><p>year:'.$row1["year"].'</p></li>
                         <li><p>publisher:'.$row1["publisher"].'</p></li>
                         </ul>
        <p id="content-text">'.$row1["minidescription"].'</p>
        </div>
  </div>
 
  ';
  } 
 while ($row1 = mysql_fetch_array($result1));

$result= mysql_query("SELECT * FROM book WHERE idbook='$id'",$link);
$row=mysql_fetch_array($result);
   echo '
        <ul class="tabs">
        <li><a class="active" href="#" >Описание</a></li>
        <li><a href="#" >Отзывы</a></li>   
        </ul>

<div class="tabs_content">
<div>'.$row["description"].'</div>
<div>
<p id="link-send-review" ><a class="send-review" href="#send-review" >Написать отзыв</a></p>
';

$query_reviews = mysql_query("SELECT * FROM comment WHERE book_id='$id' AND podtver='1' ORDER BY comment_id DESC",$link);

If (mysql_num_rows($query_reviews) > 0)
{
$row_reviews = mysql_fetch_array($query_reviews);
do
{
 
 echo '
         <div class="block-reviews" >
        <p class="author-date" ><strong>'.$row_reviews["name"].'</strong>, '.$row_reviews["date"].'</p>
        <img src="/library/www/images/plus-reviews.png" />
        <p class="textrev" >'.$row_reviews["good"].'</p>
        <img src="/library/www/images/minus-reviews.png" />
        <p class="textrev" >'.$row_reviews["bad"].'</p>
        <p class="text-comment">'.$row_reviews["comment"].'</p>
        </div>
 ';   
    
}
 while ($row_reviews = mysql_fetch_array($query_reviews));
}

else 
{
    echo'<p class=" title-no-info">no comment</p> ';
}

echo '
</div>
</div>
<div id="send-review" >
<p align="right" id="title-review">Публикация отзыва производится после предварительной модерации.</p>
<ul>
<li><p align="right"><label id="label-name" >Имя<span>*</span></label><input maxlength="20" type="text"  id="name_review" /></p></li>
<li><p align="right"><label id="label-good" >Достоинства<span>*</span></label><textarea id="good_review" name="good_review" ></textarea></p></li>       
<li><p align="right"><label id="label-bad" >Недостатки<span>*</span></label><textarea id="bad_review" name="bad_review" ></textarea></p></li>     
<li><p align="right"><label id="label-comment" >Комментарий</label><textarea id="comment_review" name="comment_review"  ></textarea></p></li>     
</ul>
<p id="reload-img"><img src="images/loading.gif"/></p> <p id="button-send-review" iid="'.$id.'" ></p>
</div>
';    
 } 
 ?>

</div>

<?php
	include("include/block-footer.php")
 ?>
</div>

</body>
</html>