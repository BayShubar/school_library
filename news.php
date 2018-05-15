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

<div id="block-news"> 
<center><img id="news-prev" src="/library/www/images/news-prev.png" /></center>
<ul id="newsdevide">
<div id="newstiker">
<ul>

<?php
	$result = mysql_query("SELECT * FROM libnews ORDER BY id desc",$link);
    if (mysql_num_rows($result)>0)
    {
        $row= mysql_fetch_array($result);
        do
        {
          echo '
                <li>
                <span>'.$row["date"].'</span>
                <a href="">'.$row["title"].'</a>
                <p>'.$row["mintext"].'...</p>
                </li>
          ';  
            
   } 
  while ($row=mysql_fetch_array($result)); 
   }
?>

</ul>
</div>
<center><img id="news-next" src="/library/www/images/news-next.png" /></center>
</div>

<?php
	include("include/block-footer.php")
 ?>
 
</div>

</body>
</html>