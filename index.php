<?php
	include("include/conect.php");
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
    
	<title>library of nis</title>
</head>

<body>
<div id="block-body">

<?php
	include("include/block-header.php");
?>

            <div id="indexcontent">
            <div id="photo-slide">
            <ul>
                    <?php
                    $result = mysql_query("SELECT * FROM main ORDER BY id desc",$link);
                    if (mysql_num_rows($result)>0)
                    {
                    $row= mysql_fetch_array($result);
                    do
                    {
                    
                    echo '<li><center><img id="mainimage" src="/library/www/main/'.$row["image"].'"/></center></li> ';
                    
                    }
                    while ($row=mysql_fetch_array($result)); 
                    }	
                    ?>
                    </ul>
             </div>
            </div>
 <div>  
 
 <ul id="best">     
  <li>       
<div id="newsmain" >
 <ul>
<?php
	$result = mysql_query("SELECT * FROM libnews ORDER BY id desc",$link);
    if (mysql_num_rows($result)>0)
    {
        $row= mysql_fetch_array($result);
        {
          echo '
                <li>
                <span>'.$row["date"].'</span>
                <a href="">'.$row["title"].'</a>
                <p>'.$row["mintext"].'</p>
                </li>
          ';  
            
   } 
   }
?>      
</ul>
</div>
</li>   

<li>

<p id="game" align="center">Какую книгу читать</p>

<div id="booknews">
<ul>

<?php
	$result = mysql_query("SELECT * FROM book",$link);
    if (mysql_num_rows($result)>0)
    {
        $row= mysql_fetch_array($result);
        do
        {
          echo '
           <li><a href="content.php?id='.$row["idbook"].'"><img id="news-images" src="/library/www/bookimages/'.$row["image"].'"/></a></li>     
          ';  
            
   } 
  while ($row=mysql_fetch_array($result)); 
   }
?>

</ul>
</div>
</div>
</li>
</ul> 



            
            <?php
            	include("include/block-footer.php")
             ?>

             
            </div>

            </body>
</html>