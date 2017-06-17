<?php
	$link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/leads/list';
	$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
	#Устанавливаем необходимые опции для сеанса cURL
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
	curl_setopt($curl,CURLOPT_URL,$link);
	curl_setopt($curl,CURLOPT_HEADER,false);
	curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
	curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
	curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

	$out_deal=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
	$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
	curl_close($curl);

	$link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/tasks/list';
	$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
	#Устанавливаем необходимые опции для сеанса cURL
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
	curl_setopt($curl,CURLOPT_URL,$link);
	curl_setopt($curl,CURLOPT_HEADER,false);
	curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
	curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
	curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

	$out_task=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
	$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
	curl_close($curl);


	$deal = json_decode($out_deal);
	$task = json_decode($out_task);
	

	
	function add_task($deal_id){
		$tasks_array['request']['tasks']['add']=array(

		  array(
		    'element_id'=>$deal_id, #ID сделки
		    'element_type'=>2, #Показываем, что это - сделка, а не контакт
		    'task_type'=>1, #Звонок
		    'text'=>'Сделка без задачи',
		    'responsible_user_id'=>109999,
		    'complete_till'=>1375285346
		  ));

		$subdomain='new5942464b8eeed';
		$link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/tasks/set';
		$curl=curl_init(); 
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
		curl_setopt($curl,CURLOPT_URL,$link);
		curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
		curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($tasks_array));
		curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
		curl_setopt($curl,CURLOPT_HEADER,false);
		curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
		curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
		 
		$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
		$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
	}
	
	
	$i = 0;
	do{
		$j = 0;
		while($deal->response->leads[$i]->id != $task->response->tasks[$j]->element_id){
			
			if($task->response->tasks[$j+1]->element_id == null){
				add_task($deal->response->leads[$i]->id);
				break;
			}
			$j++;
		}

		$i++;
	}while($deal->response->leads[$i]->id != null);

	

?>