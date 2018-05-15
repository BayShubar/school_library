<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{  
 include("conect.php");
 include("../function/function.php");

 $id = tazalau($_POST['id']);
 $name = iconv("UTF-8", "Utf-8",tazalau($_POST['name']));
 $good = iconv("UTF-8", "Utf-8",tazalau($_POST['good']));
 $bad =  iconv("UTF-8", "Utf-8",tazalau($_POST['bad']));
 $comment =  iconv("UTF-8", "Utf-8",tazalau($_POST['comment']));

    		mysql_query("INSERT INTO comment(book_id,name,good,bad,comment,date)
						VALUES(						
                            '".$id."',
                            '".$name."',
                            '".$good."',
                            '".$bad."',
                            '".$comment."',
                             NOW()							
						)",$link);	

echo 'yes';
}
?>