<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
	<script src="../js/bootstrap.js"></script>
    <title>Сбор постов с групп</title>
</head>
<style>
    div.butt span{
        font-size: 15px;
        cursor: pointer;
        font-weight: 10;
    }
</style>
<body>
   <nav class="container alert alert-success">
      <h2 style="margin:0; padding:0px;">Сбор постов с групп за сегодня</h2> 
   </nav>
   
   <div class="container">
      <div class="col-lg-9 butt">
          <span class="label label-default" data-domen='hc_avangardomsk'><img src="../img/1.gif" alt="" width="25">Авангард</span>
      </div>
        <div class="col-lg-3">
        </div>
   </div>
         <br><hr><br>
         
    <button id='butt'>Начать</button>
              
   <div class="container">
   <h3 id='name-team'><img src="" alt="" width="50"><span></span></h3>
   <div class="col-lg-12" id='insert'></div>
   </div>
   
   
   
<script>
    $(document).ready(function(){
        //alert();
    })
    
        
    $('button#butt').on('click',function(event){
         $.ajax({
            url:'../script_ajax/posts_day.php',
            //data:'domen='+domen,
            dataType:'json',
            type:'POST',
            success:function(data){
                    //alert('data - '+data);
                    //$('div#insert').append(data);
                    // обработка ответа
                    viewAnswer(data);
            },
            error:function(){
                alert('error');
            }
        });
        
    function viewAnswer(data){}
        
        
        
        
        
        
    }
        
        
        
        
    });
    
    
</script>  
    
</body>
</html>