<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{  
 include("conect.php");
 include("../function/function.php");

 $name = iconv("UTF-8", "Utf-8",tazalau($_POST['name']));
 $good = iconv("UTF-8", "Utf-8",tazalau($_POST['good']));
 $bad =  iconv("UTF-8", "Utf-8",tazalau($_POST['bad']));

    		mysql_query("INSERT INTO recomend(name,bookname,reason,date)
						VALUES(					
                            '".$name."',
                            '".$good."',
                            '".$bad."',
                             NOW()							
						)",$link);	

echo 'yes';
}
?>