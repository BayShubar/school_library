$(document).ready(function() {

   $("#newstiker").jCarouselLite({
		vertical: true,
		btnPrev: "#news-prev",
		btnNext: "#news-next",
		visible: 3,
	});
    
//..................................................................    

   $("#photo-slide").jCarouselLite({
        hoverPause:true,
		visible:1,
        auto:1000,
		speed:500
	});

    
//..................................................................      
    
     $("#booknews").jCarouselLite({
        hoverPause:true,
        vertical: true,
		visible:1,
        auto:1,
		speed:1
	});
//..................................................................
 $('#block-category > ul > li > a').click(function(){
               	        
            if ($(this).attr('class') != 'active'){ //определяет на какую сылку нажали 
                
			$('#block-category > ul > li > ul').slideUp(400);  // закрывает
            $(this).next().slideToggle(400);    // открывает
            
                    $('#block-category > ul > li > a').removeClass('active');
					$(this).addClass('active');
                    $.cookie('select_cat', $(this).attr('id'));
                    
				}else
                {
    
                    $('#block-category > ul > li > a').removeClass('active');
                    $('#block-category > ul > li > ul').slideUp(400);
                    $.cookie('select_cat', '');   
                }                                  

        if($.cookie('select_cat') !='')
{
$('#block-category> ul > li > #'+$.cookie('select_cat')).addclass('active').next().show();               
}
});

$('#capcha_obnavid').click(function(){
$('#potverdit > img').attr("src","reg/reg_captcha.php?r="+ Math.random());
});


//..................................................................

$('.top-auth').toggle(
       function() {
           $(".top-auth").attr("id","active-button");
           $("#block-top-auth").fadeIn(200);
       },
       function() {
           $(".top-auth").attr("id","");
           $("#block-top-auth").fadeOut(200);  
       }
    );

//..................................................................   
//..................................................................

// в поле авторизация находиться блок где нужна указать пароль и этот код определяет вид букв


$('#button-pass-show-hide').click(function(){
 var statuspass = $('#button-pass-show-hide').attr("class");
  
    if (statuspass == "pass-show")
    {
       $('#button-pass-show-hide').attr("class","pass-hide");
       
     			            var $input = $("#auth_pass");
			                var change = "text";
			                var rep = $("<input placeholder='Пароль' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
        
    }else
    {
        $('#button-pass-show-hide').attr("class","pass-show");
        
     			            var $input = $("#auth_pass");
			                var change = "password";
			                var rep = $("<input placeholder='Пароль' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;        
       
    }
    


  }); 
  

//..................................................................    

//.......................................................................................................

//..........................................................................................................


$('#button-send-review').click(function(){
                
   var name = $("#name_review").val();
   var good = $("#good_review").val();
   var bad = $("#bad_review").val();
   var comment = $("#comment_review").val();
   var iid = $("#button-send-review").attr("iid");

    if (name != "")
     {
          name_review = '1';
          $("#name_review").css("borderColor","#DBDBDB");
      }else {
           name_review = '0';
           $("#name_review").css("borderColor","#FDB6B6");
      }
                  
    if (good != "")
       {
          good_review = '1';
          $("#good_review").css("borderColor","#DBDBDB");
      }else {
          good_review = '0';
          $("#good_review").css("borderColor","#FDB6B6");
      }
            
    if (bad != "")
     {
          bad_review = '1';
          $("#bad_review").css("borderColor","#DBDBDB");
     }else {
          bad_review = '0';
          $("#bad_review").css("borderColor","#FDB6B6");
     } 
                                         
            
            // Глобальная проверка и отправка отзыва
            
    if ( name_review == '1' && good_review == '1' && bad_review == '1')
      {
         $("#button-send-review").hide();
         $("#reload-img").show();
                  
      $.ajax({
         type: "POST",
         url: "include/comment_add.php",
         data: "id="+iid+"&name="+name+"&good="+good+"&bad="+bad+"&comment="+comment,
         dataType: "html",
         cache: false,
         success: function() {
         setTimeout("$.fancybox.close()", 1000);
         location.reload();
         }
         });  
         }         
});


//..........................................................................................................



$('#likegood').click(function(){
          
 var tid = $(this).attr("tid");
 
 $.ajax({
  type: "POST",
  url: "include/like.php",
  data: "id="+tid,
  dataType: "html",
  cache: false,
  success: function(data) {  
  
  if (data == 'no')
  {
    alert('Вы уже голосовали!');
  }  
   else
   {
    $("#likegoodcount").html(data);
   }

}
});
});





$('#button-send-review-news').click(function(){
                
   var name = $("#name_review").val();
   var good = $("#good_review").val();
   var bad = $("#bad_review").val();
    if (name != "")
     {
          name_review = '1';
          $("#name_review").css("borderColor","#DBDBDB");
      }else {
           name_review = '0';
           $("#name_review").css("borderColor","#FDB6B6");
      }
                  
    if (good != "")
       {
          good_review = '1';
          $("#good_review").css("borderColor","#DBDBDB");
      }else {
          good_review = '0';
          $("#good_review").css("borderColor","#FDB6B6");
      }
            
    if (bad != "")
     {
          bad_review = '1';
          $("#bad_review").css("borderColor","#DBDBDB");
     }else {
          bad_review = '0';
          $("#bad_review").css("borderColor","#FDB6B6");
     } 
                                         
            
            // Глобальная проверка и отправка отзыва
            
    if ( name_review == '1' && good_review == '1' && bad_review == '1')
      {
         $("#button-send-review-news").hide();
         $("#reload-img").show();
                  
      $.ajax({
         type: "POST",
         url: "include/idea_add.php",
         data: "name="+name+"&good="+good+"&bad="+bad,
         dataType: "html",
         cache: false,
         success: function() {
         setTimeout("$.fancybox.close()", 1000);
         location.reload();
         }
         });  
         }         
});





$('#likenews').click(function(){
          
 var tid = $(this).attr("tid");
 
 $.ajax({
  type: "POST",
  url: "include/likenews.php",
  data: "id="+tid,
  dataType: "html",
  cache: false,
  success: function(data) {  
  
  if (data == 'no')
  {
    alert('Вы уже голосовали!');
  }  
   else
   {
    $("#likegoodcount").html(data);
   }

}
});
});



});














