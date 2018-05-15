<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth")
{
  define('myeshop', true);
       
       if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }

  $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='tovar.php' >ы</a> \ <a>Изменение а</a>";
  
  include("include/db_connect.php");
  include("include/functions.php"); 
 $id = clear_string($_GET["id"]);
 $action = clear_string($_GET["action"]);
  if (isset($action))
{
  switch ($action) {
      case 'delete':
             
         if (file_exists("../bookimages/".$_GET["img"]))
        {
          unlink("../bookimages/".$_GET["img"]);  
        }
            
      break;

  } 
}
   if ($_POST["submit_save"])
    {
      $error = array();
    
    // Проверка полей
        
       if (!$_POST["form_title"])
      {
         $error[] = "Укажите название а";
      }
      
       if (!$_POST["form_year"])
      {
         $error[] = "Укажите год";
      }

 if (!$_POST["form_author"])
      {
         $error[] = "Укажите автора";
      }
       if (!$_POST["form_publish"])
      {
         $error[] = "Укажите публикацию";
      }

          
       if (!$_POST["form_category"])
      {
         $error[] = "Укажите категорию";         
      }else
      {
        $result = mysql_query("SELECT * FROM category WHERE id='{$_POST["form_category"]}'",$link);
        $row = mysql_fetch_array($result);
        $selectbrand = $row["brand"];

      }

        if (empty($_POST["upload_image"]))
      {        
      include("action/upload-image.php");
      unset($_POST["upload_image"]);           
      } 
      
      
 // Проверка чекбоксов
      
       if ($_POST["chk_visible"])
       {
          $chk_visible = "1";
       }else { $chk_visible = "0"; }
      
       if ($_POST["chk_new"])
       {
          $chk_new = "1";
       }else { $chk_new = "0"; }
      
       if ($_POST["chk_leader"])
       {
          $chk_leader= "1";
       }else { $chk_leader = "0"; }
      
       if ($_POST["chk_sale"])
       {
          $chk_sale = "1";
       }else { $chk_sale = "0"; }                   
      
                                      
       if (count($error))
       {           
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
            
       }else
       {
                           
                  $querynew = "title='{$_POST["form_title"]}',year='{$_POST["form_year"]}',publisher='{$_POST["form_publish"]}',author='{$_POST["form_author"]}',minidescription='{$_POST["form_seo_description"]}',description='{$_POST["txt1"]}',new='$chk_new',leader='$chk_leader',language='{$_POST["form_type"]}',type='{$_POST["form_category"]}'"; 
           
       $update = mysql_query("UPDATE book SET $querynew WHERE idbook = '$id'",$link); 
           
                   
      $_SESSION['message'] = "<p id='form-success'>Книга успешно изменен!</p>";                 
}
          
}   

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/script.js"></script>   
    <script type="text/javascript" src="./ckeditor/ckeditor.js"></script>  
  <title>Панель Управления</title>
</head>
<body>
<div id="block-body">
<?php
  include("include/block-header.php");
?>
<div id="block-content">
<div id="block-parameters">
<p id="title-page" >Добавление книги</p>
</div>
<?php
if (isset($msgerror)) echo '<p id="form-error" align="center">'.$msgerror.'</p>';

     if(isset($_SESSION['message']))
    {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    }

?>
<?php
$result = mysql_query("SELECT * FROM book WHERE idbook='$id'",$link);
    
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{


echo '
<form enctype="multipart/form-data" method="post">
<ul id="edit-tovar">

<li>
<label>Название книги</label>
<input type="text" name="form_title"  value="'.$row["title"].'" />
</li>

<li>
<label>год</label>
<input type="text" name="form_year" value="'.$row["year"].'"  />
</li>
<li>
<label>Автор</label>
<input type="text" name="form_author"  value="'.$row["author"].'"/>
</li>
<li>
<label>publisher</label>
<input type="text" name="form_publish" value="'.$row["publisher"].'"  />
</li>

<li>
<label>Краткое описание</label>
<textarea name="form_seo_description">'.$row["minidescription"].'</textarea>
</li>
<li>



';

$category = mysql_query("SELECT * FROM category",$link);
    
If (mysql_num_rows($category) > 0)
{
$result_category = mysql_fetch_array($category);
if ($row["language"] == "Казахскии") $type_kazakh = "selected";
if ($row["language"] == "Русский") $type_russian = "selected";
if ($row["language"] == "english") $type_english = "selected";
echo '
<label>жанр книги</label>
<select name="form_type" id="type" size="1" >


<option '.$type_english.' value="Казахскии" >Казахскии</option>
<option '.$type_russian.' value="Русский" >русский</option>
<option '.$type_english.' value="english" >English</option>

</select>
</li>

<li>
<label>Категория</label>
<select name="form_category" size="10" >

';


do
{echo '
<option value="'.$result_category[ganre].'" >'.$result_category["language"].'-'.$result_category["ganre"].'</option>
  
  ';
    
}
 while ($result_category = mysql_fetch_array($category));
}

echo '

</select>
</ul> 
';


if  (strlen($row["image"]) > 0 && file_exists("../bookimages/".$row["image"]))
{
$img_path = '../bookimages/'.$row["image"];
$max_width = 110; 
$max_height = 110; 
 list($width, $height) = getimagesize($img_path); 
$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 
// New dimensions 
$width = intval($ratio*$width); 
$height = intval($ratio*$height); 
echo '
<label class="stylelabel" >Основная картинка</label>
<div id="baseimg">
<img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
<a href="edit_product.php?id='.$row["products_id"].'&img='.$row["image"].'&action=delete" ></a>
</div>

';
   
}else
{
  echo '
<label class="stylelabel" >Основная картинка</label>

<div id="baseimg-upload">
<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
<input type="file" name="upload_image" />

</div>
';
}
echo '
<h3 class="h3click" >полное описание</h3>
<div class="div-editor1" >
<textarea id="editor1" name="txt1" cols="100" rows="20">'.$row["description"].'</textarea>
    <script type="text/javascript">
      var ckeditor1 = CKEDITOR.replace( "editor1" );
      AjexFileManager.init({
        returnTo: "ckeditor",
        editor: ckeditor1
      });
    </script>
 </div>       
  ';
if ($row["new"] == '1') $checked1 = "checked";
if ($row["leader"] == '1') $checked2 = "checked";
  echo' 
<h3 class="h3title" >Настройки а</h3>   
<ul id="chkbox">
<li><input type="checkbox" name="chk_new" id="chk_new" '.$checked1 .' /><label for="chk_new" >Новый </label></li>
<li><input type="checkbox" name="chk_leader" id="chk_leader" '.$checked2 .' /><label for="chk_leader" >Популярный </label></li>
</ul> 


    <p align="right" ><input type="submit" id="submit_form" name="submit_save" value="сохранить"/></p>     
</form>


';
}while ($row = mysql_fetch_array($result));
}
?> 


</div>
</div>
</body>
</html>
<?php
}else
{
    header("Location: login.php");
}
?>