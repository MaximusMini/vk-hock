<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
	<script src="../js/bootstrap.js"></script>
    <title>Сбор информации о группах по хэш-тэгу</title>
</head>
<body>
    <nav>
        <div class="container"></div>
    </nav>
    <div class="container">
        <code>перед началом анализа необходимо в файл temp_file/hash-info поместить html-код полученный в результате выдачи по запросу</code>
    <hr>
    <a href="#" class="btn btn-success" onclick=analizGroup()>Вывести все группы</a>
    <a href="#" class="btn btn-success" onclick=top50_member()>TOP 50 (участники)</a>
    <hr>
    <div class="table_group col-lg-6">

    </div>
    </div>
    <!-- блок прелоадера    -->
    <div id='block-preloader' style="display:none; z-index:9999; background-color:gray; position:absolute; top:0px; left:0px; opacity:0.4;"><img id='img_preloader' style='position:absolute; top:50px; left:50px; ' src="../img/476.gif" alt="" class="src"></div>
    <!--  ***********************  -->
</body>

<script>
    
     $(document).ready(function(){
         //alert(document.documentElement.clientWidth);
         $('#block-preloader').width(document.documentElement.clientWidth);
         $('#block-preloader').height(document.documentElement.clientHeight);
         var imgTop = (Math.round(document.documentElement.clientHeight / 2))-32;
         var imgLeft = (Math.round(document.documentElement.clientWidth / 2))-32;
         $('#img_preloader').offset({top:imgTop,left:imgLeft});
     })
    
    
    // ajax запрос на вывод всех групп 
    function analizGroup(){
        $.ajax({
            // перед отправкой запроса
            beforeSend: function(){
	           $('#block-preloader').css({'display':'block'});
			},
            data:'',
            type:'GET',
            dataType:'html',
            url:'../script_ajax/hash-info.php',
            success: function(date){
                alert('успешно');
                // убираем блок прелоадера
                $('#block-preloader').css({'display':'none'});
                // добавляем данные полученные из запроса на страницу
                $('div.table_group').append(date);
            }   
        });
    };
    
        
    // ajax запрос на вывод тор 50 по количеству участников
    function top50_member(){
        $.ajax({
            // перед отправкой запроса
            beforeSend: function(){
	           $('#block-preloader').css({'display':'block'});
			},
            data:'',
            type:'GET',
            dataType:'html',
            url:'../script_ajax/top50_member.php',
            success: function(date){
                alert('успешно');
                // убираем блок прелоадера
                $('#block-preloader').css({'display':'none'});
                // добавляем данные полученные из запроса на страницу
                $('div.table_group').empty();
                $('div.table_group').append(date);
            }
                
        });
    };
    
    
</script>




</html>