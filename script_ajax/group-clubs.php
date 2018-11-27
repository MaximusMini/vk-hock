

<?php

/*
модуль для сбора последних пяти постов с заранее определенных групп (групп ХК клубов)


*/

$domen = $_POST['domen'];

$token_api = '33be01cf14cf4e807b075601e45972657fd2c7fd532da9e20a1b641f85b6c4a4bb22ff38b71167321b02b';

// функция получения постов
function getPosts($domain_group, $count_post){
    global $token_api;
    $query_api = 'https://api.vk.com/method/wall.get?domain='.$domain_group.'&count='.$count_post.'&filter=owner&extended=1&v=5.69&access_token='.$token_api;
    $result_query = curl_get($query_api);
    $arr_result = json_decode($result_query,true);
    
    for($i=0; $i<$count_post; $i++){
        $date_post ='<td>'.date('d.m.Y',$arr_result['response']['items'][$i]['date']).'</td>'; 
        $time_post ='<td>'.date('H:i',$arr_result['response']['items'][$i]['date']).'</td>';  
        $text_post ='<td>'.$arr_result['response']['items'][$i]['text'].'</td>'; 
        $link_post='https://vk.com/'.$domain_group.'?w=wall'.$arr_result['response']['items'][$i]['owner_id'].'_'.$arr_result['response']['items'][$i]['id'];
        $link_post ='<td><a href="'.$link_post.'" target=_blank>Ссылка</a></td>';  
       $aaa = $aaa.'<tr>'.$date_post.$time_post.$text_post.$link_post.'</tr>'; 
        
    }
    
    $head_table = '<table class="table table-striped table-bordered"><thead><tr><th>Дата</th><th>время</th><th>текст</th><th>ссылка</th></tr></thead><tbody>';
    $foot_head =  '</tbody></table>';
    $res_table = $head_table.$aaa.$foot_head;
    echo $res_table;
    return;

}







// вызовы функций ***********************************************************
        getPosts($domen, 10);

// **************************************************************************

// вспомогательные функции ***********************************************************    
    function printArray($arr){
        echo '<pre>'.print_r($arr,true).'</pre>';
    }
// функция для использования библиотеки curl
    function curl_get ($url, $referer = 'http://google.com'){
    $ch = curl_init();// инициализируем curl
    // задаем параметры (опции) curl 
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_HEADER,0);
    curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; rv:42.0) Gecko/20100101 Firefox/42.0');
    curl_setopt($ch, CURLOPT_REFERER,$referer);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); // результат работы curl возвращается, а не выводиться
    //  выполняем запрос curl
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
    }
// **************************************************************************



?>