<?php

// подключение phphQuery
include_once('..\script_php\phpQuery.php');

// получаем содержимое файла temp_file/hash-info
    $text_file = file_get_contents('..\temp_file/hash-info');
//создание объекта phpQuery
    $doc_Dom = phpQuery::newDocument($text_file);

//echo $text_file;


    // поиск
    $res = $doc_Dom->find('div.groups_row.search_row.clear_fix');

    // соединени с БД
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'VK_hock');
    // очистка таблицы
    $query_truncate = 'TRUNCATE TABLE group_query_hockey';
    $id_connect_DB->query($query_truncate);
        if($id_connect_DB){
            // поиск
            $res = $doc_Dom->find('div.groups_row.search_row.clear_fix');
            // обход массива и внесение данных в таблицу
            $cc=1;
            foreach($res as $val){
                //echo '<br>Название группы - '.pq($val)->find('div.labeled.title a')->text();
                $count_memb = explode(' ', pq($val)->find('div.labeled:nth-child(3)')->text());
                array_pop($count_memb);
                //echo '<br><h2>'.$cc.'</h2>';
                //$cc++;
                //echo '<br>Количество участников - '.implode('',$count_memb);
                //echo '<br>Адрес страницы группы - https://vk.com/'.pq($val)->find('div.labeled.title a')->attr('href');
                //echo '<br>Ссылка на логотип - '.pq($val)->find('div.img img')->attr('src');
                
                $name_group	= pq($val)->find('div.labeled.title a')->text();//название группы
                $link_group	= 'https://vk.com'.pq($val)->find('div.labeled.title a')->attr('href'); //ссылка на страницу группы
                $count_member	= implode('',$count_memb);//количество участников группы
                $link_img_group	= pq($val)->find('div.img img')->attr('src'); //ссылка на логотип группы
                
                //формируем запрос
                 $query = 'INSERT INTO group_query_hockey (name_group, link_group, count_member, link_img_group) VALUES ("'.$name_group.'","'.$link_group.'",'.$count_member.',"'.$link_img_group.'")';
                 //echo '<br>Запрос'.$query;
                // добавляем данные в таблицу
                 $id_connect_DB->query($query);
            }
                
                
                //извлекаем данные из таблицы
                $query = 'SELECT * FROM group_query_hockey';
                $result = $id_connect_DB->query($query);
                // форматирование данных из БД
                $row = mysqli_fetch_array($result);
                //printArray($row);
                
// формируем таблицу
$table_header = <<<table_header
<table class="table">
    <thead>
        <tr>
            <th>№</th>
            <th>логотип</th>
            <th>название группы</th>
            <th>количество участников</th>
            <th>ссылка на группу</th>
        </tr>
    </thead>
    <tbody>
table_header;
                
$table_footer= <<<table_footer
    </tbody>
</table>
table_footer;
                
                

        $count_group=1;                
        while($row = mysqli_fetch_array($result)) 
                {
                $table_new_content = "<tr>
                    <td>".$count_group."</td>
                    <td><img src='".$row['link_img_group']."'></td>
                    <td>".$row['name_group']."</td>
                    <td>".$row['count_member']."</td>
                    <td><a href='".$row['link_group']."'>ссылка</a></td>
                </tr>";

                $table_content = $table_content.$table_new_content;
                
            //echo '<br>table_content'.$table_content;
            //echo '<br>table_new_content'.$table_new_content;
            
                
                $count_group++;
            
                }                
                
                
  
        }else{
            echo '<br> соединение с БД не устанолвено';
        }
    
        // закрытие подключения к БД
        mysqli_close($id_connect_DB);
        
        // выводи таблицу
        echo $table_header.$table_content.$table_footer;




function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}
?>






