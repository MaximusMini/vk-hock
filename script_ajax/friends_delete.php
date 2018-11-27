<?php
/*
модуль отмены заявок в друзья

1. для того чтобы отменить поданные заявки в друзья нужно получить сначало id пользователей, которым были поданы заявки в друзья
    используется метод API ВКонтакте friends.getRequests
    function get_requests() - вернет массив id пользователей
2. непосредственно сама отмена заявок осуществляется методом API ВКонтакте friends.delete, которому нужно передать id пользователя
    function friends_delete($id_users)
*/

$access_token='becd4bcefcec33bcccf43e85758c821af2bded8ba847177378508a03a7751d3e633b593ebc138e7129f76';
$offset=0; //смещение, для выборки определенного подмножества заявок
$count_req=200; //максимальное количество заявок на добавление в друзья, которые необходимо получить (не более 1000). По умолчанию — 100.
$extended=0; //требуется ли возвращать в ответе сообщения от пользователей
$need_mutual=0; //требуется ли возвращать в ответе список общих друзей, если они есть
$out=1;// 0-возвращать полученные заявки в друзья (по умолчанию), 1 — возвращать отправленные пользователем заявки
$sort=0;//0 — сортировать по дате добавления, 1 — сортировать по количеству общих друзей.



// получения id пользователей, которым были поданы заявки в друзья
function get_requests($offset,$count_req,$extended,$need_mutual,$out,$sort,$access_token){
    $req_api = 'https://api.vk.com/method/friends.getRequests?offset='.$offset.'&count='.$count_req.'&extended='.$extended.'&need_mutual='.$need_mutual.'&out='.$out.'&sort='.$sort.'&access_token='.$access_token.'&v=5.69';
    //echo $req_api;
    $res_curl = curl_get ($req_api);
    $id_users_for_delete = json_decode($res_curl, true);
    //printArray($id_users_for_delete);
    //for($w=0; $w<count($id_users_for_delete['response']['items']);$w++){
        //echo '<br>'.($w+1).' - '.$id_users_for_delete['response']['items'][$w];
    //}
    friends_delete($id_users_for_delete,$access_token); // вызов функции удаления заявок
}

// удаления заявок в друзья count($id_users['response']['items']
function friends_delete($id_users,$access_token){
    for($w=0; $w<count($id_users['response']['items']);$w++){
        $req_api = 'https://api.vk.com/method/friends.delete?user_id='.$id_users['response']['items'][$w].'&v=5.69&access_token='.$access_token;
        $res_curl = curl_get ($req_api);
        $answer_api = json_decode($res_curl,true);
        // обработка ответа API
        if ($answer_api['response']['success'] == 1){
            echo '<br><h3 style="color:green">Запрос выполнен удачно!</h3>';
            echo '<br>'.($w+1).' - пользователь '.$id_users['response']['items'][$w].' удален!';
        }else{
             echo '<br><h3 style="color:red">Ошибка запроса!</h3>';
        }
    } 
}





// вызовы функций---------------------------------------------------------
    get_requests($offset,$count_req,$extended,$need_mutual,$out,$sort,$access_token);
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