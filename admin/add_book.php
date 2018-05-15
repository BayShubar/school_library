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

  $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='tovar.php' >ы</a> \ <a>Добавление а</a>";
  
  include("include/db_connect.php");
  include("include/functions.php"); 

    if ($_POST["submit_add"])
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
                           
                  mysql_query("INSERT INTO book(title,year,author,publisher,minidescription,description,new,leader,language,type)
            VALUES(           
                            '".$_POST["form_title"]."',
                            '".$_POST["form_year"]."',
                             '".$_POST["form_author"]."',
                            '".$_POST["form_publish"]."',
                             '".$_POST["form_seo_description"]."',
                            '".$_POST["txt1"]."',
                            '".$chk_new."',
                            '".$chk_leader."',
                            '".$_POST["form_type"]."',
                            '".$_POST["form_category"]."'                               
            )",$link);
                   
      $_SESSION['message'] = "<p id='form-success'>Книга успешно добавлен!</p>";
      $id = mysql_insert_id();
                 
       if (empty($_POST["upload_image"]))
      {        
      include("action/upload-image.php");
      unset($_POST["upload_image"]);           
      } 
      
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

<form enctype="multipart/form-data" method="post">
<ul id="edit-tovar">

<li>
<label>Название книги</label>
<input type="text" name="form_title" />
</li>

<li>
<label>год</label>
<input type="text" name="form_year"  />
</li>
<li>
<label>Автор</label>
<input type="text" name="form_author"  />
</li>
<li>
<label>publisher</label>
<input type="text" name="form_publish"  />
</li>

<li>
<label>Краткое описание</label>
<textarea name="form_seo_description"></textarea>
</li>
<li>
<label>жанр книги</label>
<select name="form_type" id="type" size="1" >

<option value="kazakh" >Казахскии</option>
<option value="russian" >русский</option>
<option value="english" >English</option>

</select>
</li>

<li>
<label>Категория</label>
<select name="form_category" size="10" >

<?php
$category = mysql_query("SELECT * FROM category",$link);
    
If (mysql_num_rows($category) > 0)
{
$result_category = mysql_fetch_array($category);
do
{
  
  echo '
  
  <option value="'.$result_category[ganre].'" >'.$result_category["ganre"].'</option>
  
  ';
    
}
 while ($result_category = mysql_fetch_array($category));
}
?> 

</select>
</ul> 
<label class="stylelabel" >Основная картинка</label>

<div id="baseimg-upload">
<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
<input type="file" name="upload_image" />

</div>

<h3 class="h3click" >Краткое описание а</h3>
<div class="div-editor1" >
<textarea id="editor1" name="txt1" cols="100" rows="20"></textarea>
    <script type="text/javascript">
      var ckeditor1 = CKEDITOR.replace( "editor1" );
      AjexFileManager.init({
        returnTo: "ckeditor",
        editor: ckeditor1
      });
    </script>
 </div>       
     
<h3 class="h3title" >Настройки а</h3>   
<ul id="chkbox">
<li><input type="checkbox" name="chk_new" id="chk_new"  /><label for="chk_new" >Новый </label></li>
<li><input type="checkbox" name="chk_leader" id="chk_leader"  /><label for="chk_leader" >Популярный </label></li>
</ul> 


    <p align="right" ><input type="submit" id="submit_form" name="submit_add" value="Добавить "/></p>     
</form>


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