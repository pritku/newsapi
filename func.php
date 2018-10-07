<?php

	/**
     * @file Global Helper Functions
     * 
     */

	if(!function_exists('get_news_api_info'))
    {
    	function get_news_api_info($url){
			//pre($start_date." ".$end_date);
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET"
			  
			));
			$response = curl_exec($curl);
			//pre($response);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
			  return "cURL Error #:" . $err;
			} else {
			 	return json_decode($response,true);
			}
		}
    }
	if(!function_exists('get_cookie'))
    {
	    function get_cookie($param){
			return !empty($_COOKIE[$param]) ? $_COOKIE[$param] : '';
		}
	}	
	
	if(!function_exists('jsonval'))
    {
		function jsonval($jsonArray,$json_param = '',$str_type = 'str',$default_val = ''){
		
			if($str_type == 'str'){
				if($default_val == ''){
					if(isset($jsonArray[$json_param])){
						if(!empty($jsonArray[$json_param])){
							return trim(str_replace("'","''",$jsonArray[$json_param]));
						}else{
							return '';
						}
					}else{
						return '';
					}
					
				}else{
					if(isset($jsonArray[$json_param])){
						if(!empty($jsonArray[$json_param])){
							return trim(str_replace("'","''",$jsonArray[$json_param]));
						}else{ 
							return $default_val;
						}
					}else{
						return '';
					}
					
					/*return isset($jsonArray[$json_param]) ? trim($jsonArray[$json_param])	 : $default_val;*/
				}
				
			}elseif($str_type == 'int'){
				if($default_val == ''){
					return isset($jsonArray[$json_param]) ? intval($jsonArray[$json_param])	 : '';
				}else{
					return isset($jsonArray[$json_param]) ? intval($jsonArray[$json_param])	 : $default_val;
				}
				
			}elseif($str_type == 'float'){
				if($default_val == ''){
					return isset($jsonArray[$json_param]) ? floatval($jsonArray[$json_param])	 : '';
				}else{
					return isset($jsonArray[$json_param]) ? floatval($jsonArray[$json_param])	 : $default_val;
				} 
			}
		}
	}	
	if(!function_exists('get_api_info'))
    {
		function get_api_info($api_name,$json_arr =array()){
			$json = json_encode($json_arr);
			/*echo $json;
			die();  */
			//pre(BASE_URL.$api_name);
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => BASE_URL.$api_name,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => $json,
			  CURLOPT_HTTPHEADER => array(
				"Cache-Control: no-cache",
				"Content-Type: application/json",
				"Postman-Token: 4dfcb688-6ace-4dd0-9a72-5f754afd2a5b"
			  ),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
			  return "cURL Error #:" . $err;
			} else {
			  return $response;
			}
		}
	}
	 
	 if(!function_exists('pre'))
    {
      function pre($value){
			echo "<pre>";
			print_r($value);
			echo "</pre>";
      }
    }

   
	
	if(!function_exists('e'))
    {
		function e($str){
			echo $str;
		}
	}
	
	
 ?>