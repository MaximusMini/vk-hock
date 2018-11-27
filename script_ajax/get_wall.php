<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
	<script src="../js/bootstrap.js"></script>
    <title>Получение информации о количестве друзей пользователя</title>
</head>


<?php


$domain_group = 'fhr';
$count_posts = 100;

// получение записей со стены 
function wall($domain_group,$count_posts){
    $curl_url = 'https://api.vk.com/method/wall.get?domain='.$domain_group.'&count='.$count_posts.'&extended=0&fields=text,comments&v=5.69&access_token=33be01cf14cf4e807b075601e45972657fd2c7fd532da9e20a1b641f85b6c4a4bb22ff38b71167321b02b';
    //echo '<br>'.$curl_url;
    $result_curl = curl_get ($curl_url);
     //echo '<br>'.$result_curl;
    //echo '<br><br><br>'.printArray(json_decode($result_curl, true));
    $ar = json_decode($result_curl, true);
    
    for ($t=0; $t<$count_posts; $t++){
    //        echo '<br>id записи -'.$ar['response']['items'][$t]['id'];
    //        echo '<br>Дата -'.date('d.m.Y',$ar['response']['items'][$t]['date']);
    //        echo '<br>Текст поста -'.$ar['response']['items'][$t]['text'];
    //        echo '<br>Лайки -'.$ar['response']['items'][$t]['likes']['count'];
    //        echo '<br>Репосты -'.$ar['response']['items'][$t]['reposts']['count'];
    //        echo '<br>Просмотры -'.$ar['response']['items'][$t]['views']['count'];
    //        echo '<br>Комментарии -'.$ar['response']['items'][$t]['comments']['count'];
        $tbody.= '<tr>';
        $tbody.= '<td>'.($t+1).'</td>';
        $tbody.= '<td>'.$ar['response']['items'][$t]['id'].'</td>';
        $tbody.= '<td>'.date('d.m.Y',$ar['response']['items'][$t]['date']).'</td>';
        $tbody.= '<td>'.$ar['response']['items'][$t]['text'].'</td>';
        $tbody.= '<td>'.$ar['response']['items'][$t]['likes']['count'].'</td>';
        $tbody.= '<td>'.$ar['response']['items'][$t]['reposts']['count'].'</td>';
        $tbody.= '<td>'.$ar['response']['items'][$t]['views']['count'].'</td>';
        $tbody.= '<td>'.$ar['response']['items'][$t]['comments']['count'].'</td>';
        $tbody.= '<td><a href="https://vk.com/'.$domain_group.'?w=wall'.$ar['response']['items'][$t]['owner_id'].'_'.$ar['response']['items'][$t]['id'].'" target="_blank">ссылка</a></td>';
        $tbody.= '</tr>';
        
    }
    
    table_wall($tbody);
    
    
}


// формирование таблицы для вывода полученных записей
function table_wall($tbody){
    echo '<div class="container">';
    echo '<table class="table table-striped"><thead>';
    echo '<tr><th>№</th><th>id записи</th><th>Дата</th><th>Текст поста</th><th>Лайки</th><th>Репосты</th><th>Просмотры</th><th>Комментарии</th><th>ссылка</th></tr></thead>';
    echo '<tbody>'.$tbody.'</tbody>';
    echo '</table>';
    echo '</div>';
}



// вызовы функций---------------------------------------------------------
    //$start = microtime(true);
    wall($domain_group,$count_posts);
    //echo 'Время выполнения скрипта: '.round(microtime(true) - $start, 4).' сек.';

    //echo'<br>'.count($id_members[2]);
//========================================================================



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

function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}
?>
