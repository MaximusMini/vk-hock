﻿<?php
/*
модуль для автоматического добавления в друзья

1. необходимо получить массив id пользователей - $id_users_array
    можно использовать https://vk.com/dev/groups.getMembers

2. данный скрипт будет вызываться через ajax из файла script_ajax/friends_add.php

3. при вызове через ajax будет передаваться цифра - номер элемента массива с id пользователями, которому на данном этапе будет отправлена заявка в друзья

4. вызов через ajax будет осуществляться через таймер - каждую минуту

5. обратно в script_ajax/friends_add.php будет передаваться информация об успехе/неуспехе заявки в друзья


*/




$id_users_array=[3935684, 3935698, 3935773, 3935788, 3935828, 3935851, 3935870, 3935879, 3935889, 3935900, 3935964, 3935990, 3935993, 3935996, 3936011, 3936113, 3936196, 3936329, 3936375, 3936398, 3936445, 3936459, 3936512, 3936549, 3936551, 3936563, 3936679, 3936724, 3936761, 3936800, 3936811, 3936921, 3937044, 3937073, 3937096, 3937097, 3937099, 3937103, 3937131, 3937141, 3937173, 3937190, 3937301, 3937322, 3937345, 3937380, 3937385, 3937395, 3937421, 3937561, 3937578, 3937620, 3937703, 3937726, 3937729, 3937733, 3937739, 3937745, 3937820, 3937844, 3937879, 3938026, 3938134, 3938177, 3938205, 3938206, 3938242, 3938300, 3938349, 3938503, 3938583, 3938599, 3938717, 3938808, 3938884, 3939015, 3939076, 3939092, 3939120, 3939133, 3939139, 3939193, 3939201, 3939214, 3939231, 3939257, 3939293, 3939299, 3939305, 3939368, 3939404, 3939424, 3939434, 3939464, 3939575, 3939597, 3939676, 3939780, 3939787, 3939805];

$access_token='becd4bcefcec33bcccf43e85758c821af2bded8ba847177378508a03a7751d3e633b593ebc138e7129f76';
$offset=0; //смещение, для выборки определенного подмножества заявок
$count_req=100; //максимальное количество заявок на добавление в друзья, которые необходимо получить (не более 1000). По умолчанию — 100.
$extended=0; //требуется ли возвращать в ответе сообщения от пользователей
$need_mutual=0; //требуется ли возвращать в ответе список общих друзей, если они есть
$out=1;// 0-возвращать полученные заявки в друзья (по умолчанию), 1 — возвращать отправленные пользователем заявки
$sort=0;//0 — сортировать по дате добавления, 1 — сортировать по количеству общих друзей.

// проверка таймера
function timer_php(){

	}

// функция автоматическиго добавления в друзья
function add_friends($user_id,$access_token){
    $req_api='https://api.vk.com/method/friends.add?user_id='.$user_id.'&text=&follow=0&access_token='.$access_token.'&v=5.69';
    $req_curl = curl_get ($req_api);
    $result_req = json_decode($req_curl, true);
    printArray($result_req);
    // обработка положительного ответа запроса
    if($result_req['response'] == 1){$answer = '<br>заявка на добавление данного пользователя в друзья отправлена';};
    if($result_req['response'] == 4){$answer = '<br>повторная отправка заявки';};
    // обработка отрицательного ответа запроса
    if (is_array($result_req['error'])){$answer = '<br>ошибка запроса - '. $result_req['error']['error_msg'];};
    
    echo $answer;
    
    echo '<br>'.$user_id;
  
}




// вызовы функций---------------------------------------------------------
    echo 'Проверка таймера';
	add_friends($id_users_array[90],$access_token);
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