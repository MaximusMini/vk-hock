<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
	<script src="../js/bootstrap.js"></script>
    <title>Сбор пользователей группы</title>
</head>
<body>
   <br><br>
   <div class="container">
      <div class="row">
          <div class="col-lg-4">
            <div class="panel panel-default panel-info">
                <div class="panel-heading ">Введите группу</div>
                <div class="panel-body">
                    <input type="text" class="form-control" id="id_group">
                    <br>
                    <button type="button" class="btn btn-success" onclick=getMembers()>собрать</button>
                </div>
            </div>    
          </div>
      </div>
       
        
       
       
       
   </div>
    
</body>
<script>
// сбор участников группы
function getMembers(){
    var id_group;
    id_group = $('#id_group').val();
    $.ajax({
        data:'id_group='+id_group,
        type:'GET',
        dataType:'html',
        url:'../script_ajax/get_members.php',
        success: function(data){
            //alert('Good');
            alert(data);
        }
    })
    //$('#id_group').val('');
}
</script>













</html>