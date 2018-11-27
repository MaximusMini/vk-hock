<?php
echo 'hello';




function get_count_friends(){
    // соединени с БД
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'VK_hock');
        if($id_connect_DB){
          
        }else{
            echo '<br> соединение с БД не устанолвено';
        }
    
        // закрытие подключения к БД
        mysqli_close($id_connect_DB);
    
    
    
}















// вызовы функций---------------------------------------------------------
    //$start = microtime(true);
    get_count_friends();
    //get_id_members($id_group);
    //add_id_members($id_members, $id_group);
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