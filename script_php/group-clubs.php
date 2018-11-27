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
      <h2 style="margin:0; padding:0px;">Сбор постов с групп</h2> 
   </nav>
   
   <div class="container">
      <div class="col-lg-9 butt">
          <span class="label label-default" data-domen='hc_avangardomsk'><img src="../img/1.gif" alt="" width="25">Авангард</span>
          <span class="label label-default" data-domen='hcadmiral'><img src="../img/3.gif" alt="" width="25">Адмирал</span>
          <span class="label label-default" data-domen='hcamur'><img src="../img/5.gif" alt="" width="25">Амур</span>
          <span class="label label-default" data-domen='hcbarys'><img src="../img/6.gif" alt="" width="25">Барыс</span>
          <span class="label label-default" data-domen='club127066914'><img src="../img/12.gif" alt="" width="25">Кунлунь РС</span>
          <span class="label label-default" data-domen='hcsalavat'><img src="../img/17.gif" alt="" width="25">Салават Юлаев</span>
          <span class="label label-default" data-domen='hcsibir1962'><img src="../img/19.gif" alt="" width="25">Сибирь</span>
          <p></p>
          <span class="label label-primary" data-domen='hc_dinamominsk'><img src="../img/9.gif" alt="" width="25">Динамо Мн</span>
          <span class="label label-primary" data-domen='hcdinamoriga'><img src="../img/10.gif" alt="" width="25">Динамо Р</span>
          <span class="label label-primary" data-domen='jokerit'><img src="../img/11.gif" alt="" width="25">Йокерит</span>
          <span class="label label-primary" data-domen='ska'><img src="../img/20.gif" alt="" width="25">СКА</span>
          <span class="label label-primary" data-domen='hcslovan'><img src="../img/21.gif" alt="" width="25">Слован</span>
          <span class="label label-primary" data-domen='spartakhc'><img src="../img/23.gif" alt="" width="25">Спартак</span>
          <p></p>
          <span class="label label-warning" data-domen='hcvityaz'><img src="../img/7.gif" alt="" width="25">Витязь</span>
          <span class="label label-warning" data-domen='dynamo_ru'><img src="../img/8.gif" alt="" width="25">Динамо М</span>
          <span class="label label-warning" data-domen='hclokomotiv_official'><img src="../img/14.gif" alt="" width="25">Локомотив</span>
          <span class="label label-warning" data-domen='hcseverstal'><img src="../img/18.gif" alt="" width="25">Северсталь</span>
          <span class="label label-warning" data-domen='torpedonn'><img src="../img/24.gif" alt="" width="25">Торпедо</span>
          <span class="label label-warning" data-domen='hcsochi'><img src="../img/22.gif" alt="" width="25">ХК Сочи</span>
          <span class="label label-warning" data-domen='hccska'><img src="../img/26.gif" alt="" width="25">ЦСКА</span>
          <p></p>
          <span class="label label-success" data-domen='hcavtomobilist'><img src="../img/2.gif" alt="" width="25">Автомобилист</span>
          <span class="label label-success" data-domen='hcakbars'><img src="../img/4.gif" alt="" width="25">АК Барс</span>
          <span class="label label-success" data-domen='hc_lada'><img src="../img/13.gif" alt="" width="25">Лада</span>
          <span class="label label-success" data-domen='hcmetallurg'><img src="../img/15.gif" alt="" width="25">Металлург Мг</span>
          <span class="label label-success" data-domen='h.c.neftekhimik'><img src="../img/16.gif" alt="" width="25">Нефтехимик</span>
          <span class="label label-success" data-domen='traktor_chelyabinsk'><img src="../img/25.gif" alt="" width="25">Трактор</span>
          <span class="label label-success" data-domen='ugrahc'><img src="../img/27.gif" alt="" width="25">Югра</span>
      </div>
        <div class="col-lg-3">
        </div> hcakbars
   </div>
         <br><hr><br>
   <div class="container">
   <h3 id='name-team'><img src="" alt="" width="50"><span></span></h3>
   <div class="col-lg-12" id='insert'></div>
   </div>
   
   
   
<script>
    $(document).ready(function(){
        //alert();
    })
    
    function getPosts(domen){
        var domen = domen || 'hc_avangardomsk';
        $('h3#name-team span').empty('');
        $('h3#name-team img').removeAttr('src');
        $('div#insert').empty();
        $.ajax({
            url:'../script_ajax/group-clubs.php',
            data:'domen='+domen,
            type:'POST',
            success:function(data){
                    //alert(data);
                    $('div#insert').append(data);
            },
            error:function(){
                alert('error');
            }
        });
    }
    
    $('div.butt span').on('click',function(event){
        var domen = $(this).data('domen');
        var nameTeam = $(this).text();
        var imgSrc = $(this).find('img').attr('src');
        //alert(imgSrc);
        getPosts(domen);
        $('h3#name-team img').attr('src', imgSrc);
        $('h3#name-team span').text('Группа команды '+ nameTeam);
    });
    
    
</script>  
    
</body>
</html>