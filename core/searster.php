<?php

	class Searster{
		function get_data($url) {
			$accountKey = 'qL+ZUfk35AHNMsD3O7kqZA+kucjhYxLhLEChut2pGf4';
			$process = curl_init($url);
			curl_setopt($process, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($process, CURLOPT_USERPWD,$accountKey.":" .$accountKey);
			curl_setopt($process, CURLOPT_TIMEOUT, 30);
			curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
			$response = curl_exec($process);
			if($response) return json_decode($response);
			else return false;
		}
		function search($mots,$type,$etape=null,$number=null,$last_result=null){
			$return = array('error'=>0);
			if(empty($mots)) $return['error'] = 1;
			if(empty($type)) $return['error'] = 2;
			if($return['error']!=0) return $return;
			if($etape == 0){
				$result_arr = array();
				$results = array();
				$s_url = 'https://api.datamarket.azure.com/Bing/Search/v1/Web?$format=json&Query=%27'.urlencode($mots).'%27';
				if(!empty($last_result) && is_numeric($last_result) && $last_result > 0) $s_url .= '&$skip='.$last_result;
				$result_arr = $this->get_data($s_url);
				if($result_arr != false) $result_arr = $result_arr->d->results;
				else return null;
				$i = 0;
				foreach($result_arr as $element){
					$results[$i] ='';
					$results[$i]['title'] = $element->Title;
					$results[$i]['url'] = $element->Url;
					$results[$i]['description'] = $element->Description;
					$i++;
				}
				if(count($results) > 0) $success = 1;
				else $success = 0;
				$function_arr = array('function'=> 'search_draw','q'=>$mots,'etape'=>$etape,'result_count'=>$last_result,'success'=>$success);
				array_unshift($results,$function_arr);
				return $results;
			}
		}
		function get($url,$id=null){
			if(empty($url)) return null;
			require_once('searsparser.php');
			$parser = new Searsparser();
			$result = $parser->parse($url);
			$result['function'] = 'show_result';
			if($id != null)$result['id'] = $id;
			return $result;
		}
		function resume($title,$html,$id=null){
			if(empty($html)) return null;
			require_once('searsummer.php');
			$summer = new Searsummer();
			$result = $summer->summ($title,$html);
			$resultat = array();
			$resultat['function'] = 'show_summary';
			$resultat['content'] = $result;
			if($id != null) $resultat['id'] = $id;
			return $resultat;
			
		}
		function get_http_response_code($url) {
			$headers = get_headers($url);
			return substr($headers[0], 9, 3);
		}
	}
	
	
?>