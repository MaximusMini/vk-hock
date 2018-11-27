<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
	<script src="../js/bootstrap.js"></script>
    <title>Добавление друзей</title>
</head>
<body>
   <br>
   <div class="container">
       <button onclick='addFriends()'>Запуск</button>
   </div>
   
    
</body>

<script>
   $(document).ready(function(){
       //alert();
   })
    
// функция добавления друзей
function addFriends(){
    var number_element;
    $.ajax({
        url:'../script_ajax/friends_add.php',
        type:'GET',
        data:'number_element='+number_element,
        success:function(data){
            alert();
        }
    })
}
    
    
    
</script>






</html>