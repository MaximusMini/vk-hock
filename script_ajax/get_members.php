<?php
//echo $_GET['id_group'];

$id_group = 'sports.ru_hockey';
//$id_group = 'fanat_khl';
//$id_group =$_GET['id_group'];

// глобальные переменные
$count_members; // количество участников группы
//$count_members = 3984; // количество участников группы
$id_members = Array(); // массив для хранения id участников группы


// функция определения количества участников группы
function get_count_members($id_group){
    global $count_members;
    // формируем url запроса
    $url = 'https://api.vk.com/method/groups.getById?group_ids='.$id_group.'&fields=members_count&v=5.69';
    // производим запрос
    $curl_result = curl_get ($url);
    //echo $curl_result;
    //echo '<br>'.$url;
    // преобразуем json в массив
    $array_curl_result = json_decode($curl_result, true);
    // присваиваем глобальной переменной количество участников
    $count_members = $array_curl_result['response'][0]['members_count'];
    echo '<br>Количество участников '.$array_curl_result['response'][0]['members_count'];
}

// фнкция сбора id участников группы
function get_id_members($id_group){
    global $id_members, $count_members;
    // определяем количество проходов
    $round = ceil($count_members / 1000);
    echo '<br>'.$round;
    // цикл запросов на получение id
    for($w=1; $w<=$round; $w++){
        // задаем смещение в зависимости от номера прохода
        $offset = ($w-1)*1000;
        // формируем запрос
        $url = 'https://api.vk.com/method/groups.getMembers?group_id='.$id_group.'&offset='.$offset.'&v=5.69';
        // производим запрос
        $curl_result = curl_get ($url);
        // преобразуем json в массив
        $array_curl_result = json_decode($curl_result, true);
        // добавляем id в массив - 
        array_push($id_members, $array_curl_result['response']['items']);
    }
    printArray($id_members);
}

// добавление id участников в БД
function add_id_members($id_members, $id_group){
    // соединени с БД
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'VK_hock');
        if($id_connect_DB){
            // определяем количество элементов массива - первый уровень
            for($f=0; $f<count($id_members); $f++){
                // определяем количество элементов массива - второй уровень
                for($q=0; $q<count($id_members[$f]); $q++){
                    //формируем запрос
                    $query = 'INSERT INTO id_members (id_members, name_group) VALUES ("'.$id_members[$f][$q].'","'.$id_group.'")';
                    //echo '<br>Запрос  '.$query;
                    // добавляем данные в таблицу
                    $id_connect_DB->query($query);    
                }
            }
        }else{
            echo '<br> соединение с БД не устанолвено';
        }
    
        // закрытие подключения к БД
        mysqli_close($id_connect_DB);
}





// вызовы функций---------------------------------------------------------
    $start = microtime(true);
    get_count_members($id_group);
    get_id_members($id_group);
    add_id_members($id_members, $id_group);
    echo 'Время выполнения скрипта: '.round(microtime(true) - $start, 4).' сек.';

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