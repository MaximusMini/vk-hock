<?

// соединени с БД
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'VK_hock');
        if($id_connect_DB){
            //формируем запрос
                 $query = 'SELECT * FROM group_query_hockey ORDER BY count_member DESC LIMIT 50';
                 //echo '<br>Запрос'.$query;
                // добавляем данные в таблицу
                $result =  $id_connect_DB->query($query);

// формируем таблицу
$table_header = <<<table_header
<table class="table table-striped table-condensed">
    <!--<thead><tr>
            <th>№</th>
            <th>логотип</th>
            <th>название группы</th>
            <th>количество участников</th>
            <th>ссылка на группу</th>
    </tr></thead> -->
<tbody>
table_header;
                
$table_footer='</tbody></table>';

        
        $count_group=1;                
        while($row = mysqli_fetch_array($result)) 
                {
                $table_new_content = "<tr>
                    <td>".$count_group."</td>
                    <td><img class='img-responsive img-circle' width='70' src='".$row['link_img_group']."'></td>
                    <td class='text-center text-danger'><strong>".$row['name_group']."</strong></td>
                    <td>".$row['count_member']."</td>
                    <td><a href='".$row['link_group']."'>ссылка</a></td>
                </tr>";

                $table_content = $table_content.$table_new_content;
                $count_group++;
                
                $text.= '<br>'.($count_group-1).'. '.$row['name_group'].' - '.$row['count_member'].'<br>'.$row['link_group'];
            
                } 
            
        }else{
            echo '<br> соединение с БД не устанолвено';
        }
    
        // закрытие подключения к БД
        mysqli_close($id_connect_DB);
        
        echo $text;

        // выводи таблицу
        echo $table_header.$table_content.$table_footer;









function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}
?>