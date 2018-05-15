        <?php      
        include("include/conect.php");
        include("function/function.php");
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
<title>Панель управление-новости</title>

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
            $all_count = mysql_query("SELECT * FROM recomend where acces='1'",$link);
            $result_count = mysql_num_rows($all_count);
        ?>

        <div id="block-content">
        <div id="block-parameters">
        <p id="count-recoment" >Количества рекомендаций - <strong><?php echo $result_count; ?></strong></p>
       
     <p  id="link-send-review"><a class="send-review" href="#send-review" >добавить</a></p>
        </div>
        <center><img id="news-prev" src="/library/www/images/news-prev.png" /></center>
        <div id="newstiker">
        <ul>

                <?php
                
                $result = mysql_query("SELECT * FROM recomend WHERE acces='1' ORDER BY id DESC",$link);
                If (mysql_num_rows($result) > 0)
                {
                $row = mysql_fetch_array($result);
                $id= '.$row["id"].';
                do{echo '   <li> 
                    <div class="block-news">
                    <p> <span>'.$row["date"].', '.$row["name"].' </span></p>
                    <p align="left"><div id="likenews" tid='.$id.'><img src="/library/www/images/like.png"/> : '.$row["likenews"].'</div></p>
                    <h3>'.$row["bookname"].'</h3>
                    <p>'.$row["reason"].'</p>
                    </div>   </li>' ;
                } while ($row = mysql_fetch_array($result));}   

  ?>
 </ul>
                </div>
                <center><img id="news-next" src="/library/www/images/news-next.png" /></center>
<?php
echo '


    <div id="send-review" >
    
    <p align="right" id="title-review">Публикация отзыва производится после предварительной модерации.</p>
    
    <ul>
    <li><p align="right"><label id="label-name" >Имя<span>*</span></label>                 <input maxlength="15" type="text"  id="name_review" /></p></li>
    <li><p align="right"><label id="label-good" >Название книги<span>*</span></label>      <textarea id="good_review" ></textarea></p></li>    
    <li><p align="right"><label id="label-bad" >Причина<span>*</span></label><textarea id="bad_review" >    </textarea></p></li>          
    </ul>
    <p id="reload-img"><img src="/images/loading.gif"/></p> <p id="button-send-review-news"  ></p>
    </div>
';   ?>
               
                </div>
        </div>
        </div>
</body>
</html>
<?php
?>