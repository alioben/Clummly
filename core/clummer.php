<?php 
	class Clummer{
	
		public $lang = array("en","fr");
		public $scat = array("laune","politique","economie","hightech","science","sport","sante","musique","cinema");
		
		function __construct(){
		header('Content-Type: text/html; charset=UTF-8');
			$username = "" // INSERT USERNAME OF BDD;
			$password = "" // INSERT PASSWORD OF BDD;
			$hostname = "" // INSERT HOSTNAME OF BDD; 
			$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
			$selected = mysql_select_db(""/*INSERT BDD NAME OF BDD*/,$dbhandle) or die("Could not select examples");
			mysql_query("SET NAMES 'utf8'");
		}
		
		function get_news($lang){
			if(!in_array($lang,$this->lang)) $lang = "fr";
			$table = $lang."_";
			$table_count = array();
			foreach($this->scat as $key=>$cat){
				$sql = "SELECT COUNT(id) as nbre FROM ".$table.$cat;
				$query = mysql_query($sql) or die(mysql_error());
				while ($row = mysql_fetch_assoc($query)) $table_count[$cat] = $row['nbre'];
			}
			$table_count['function'] = "show_categories";
			return $table_count;
		}
		
		function get_categorie($cat,$lang){
			if(!in_array($lang,$this->lang)) $lang = "fr";
			if(!in_array($cat,$this->scat)) $cat = "laune";
			$sql = "SELECT last_update FROM sources WHERE categorie = '".$cat."' AND langage = '".$lang."'";
			$query = mysql_query($sql) or die(mysql_error());
			$updated = 0;
			while ($row = mysql_fetch_assoc($query)){
				$now = strtotime(date("Y-m-d H:i:s"));
				$lastupdate = strtotime($row['last_update']);
				if(abs($now-$lastupdate)/3600 < 1){
					$updated = 1;
					break;
				}
				
			}
			$table = $lang."_".$cat;
			if($updated == 1){
				$query = mysql_query("SELECT * FROM ".$table." Order by date DESC limit 0,20") or die(mysql_error());
				$result = array();
				while ($row = mysql_fetch_assoc($query)){ unset($row['resume']); unset($row['images']); $result[] = $row; }
				$result['function'] = "show_news";
				$result['cat'] = $cat;
				return $result;
			}
			else return array('function'=>'update_categorie','categorie'=>$cat);
		}
		
		function update_categorie($cat,$lang){
			if(!in_array($lang,$this->lang) || !in_array($cat,$this->scat)) die('401');
			$sql = "SELECT last_update FROM sources WHERE categorie = '".$cat."' AND langage = '".$lang."'";
			$query = mysql_query($sql) or die(mysql_error());
			$updated = 0;
			while ($row = mysql_fetch_assoc($query)){
				$now = strtotime(date("Y-m-d H:i:s"));
				$lastupdate = strtotime($row['last_update']);
				if(abs($now-$lastupdate)/3600 < 1){
					$updated = 1;
					break;
				}
			}
			if($updated == 0){
				$sql = "SELECT lien, categorie, source FROM sources WHERE categorie = '".$cat."' AND langage = '".$lang."'";
				$query = mysql_query($sql) or die(mysql_error());
				while ($row = mysql_fetch_assoc($query)) $this->extract_form_rss($row['categorie'],$row['lien'],$lang,$row['source']);
				
			}
			return $this->get_categorie($cat,$lang);
		}
		
		function extract_form_rss($cat,$lien,$lang,$source){
			try{
				if(!@$fluxrss=simplexml_load_file($lien)) return false;
					if($fluxrss->channel->item){
						if(empty($fluxrss->channel->title) || empty($fluxrss->channel->description) || empty($fluxrss->channel->item->title)) return false;
						$results = array();
						$i=0;
						foreach($fluxrss->channel->item as $item){
							$results[$i] = array();
							$results[$i]['title'] = $item->title;
							$results[$i]['lien'] = $item->link;
							$results[$i]['source'] = $source;
							if(!empty($item->description)) $results[$i]['description'] = trim(str_replace('&nbsp;','',$item->description));
							else $results[$i]['description'] = '';
							if(!empty($item->pubDate)) $results[$i]['date'] = date('Y-m-d H:i:s',strtotime($item->pubDate));
							else $results[$i]['date'] = date("Y-m-d H:i:s");
							$i++;
						}
						foreach($results as $new){
							$table = $lang."_".$cat;
							$query = mysql_query("SELECT * FROM ".$table." WHERE lien = '".$new['lien']."'") or die(mysql_error());
							if(mysql_num_rows($query) == 0 && strlen(strip_tags($new['description'])) > 5) mysql_query("INSERT INTO ".$table." (titre,description,source,date,lien) VALUES('".mysql_real_escape_string($new['title'])."','".mysql_real_escape_string(strip_tags($new['description']))."','".mysql_real_escape_string($new['source'])."','".mysql_real_escape_string($new['date'])."','".mysql_real_escape_string($new['lien'])."')") or die(mysql_error());
						}
					}
					elseif($fluxrss->entry){
						$results = array();
						$i=0;
						foreach($fluxrss->entry as $item){
							$results[$i] = array();
							$results[$i]['title'] = $item->title;
							$results[$i]['lien'] = (string)$item->link->attributes()->href;
							$results[$i]['source'] = $source;
							if(!empty($item->summary)) $results[$i]['description'] = trim(str_replace('&nbsp;','',$item->summary));
							else $results[$i]['description'] = '';
							if(!empty($item->published)) $results[$i]['date'] = date('Y-m-d H:i:s',strtotime($item->published));
							else $results[$i]['date'] = date("Y-m-d H:i:s");
							$i++;
						}
						foreach($results as $new){
							$table = $lang."_".$cat;
							$query = mysql_query("SELECT * FROM ".$table." WHERE lien = '".$new['lien']."'") or die(mysql_error());
							if(mysql_num_rows($query) == 0 && strlen(strip_tags($new['description'])) > 5) mysql_query("INSERT INTO ".$table." (titre,description,source,date,lien) VALUES('".mysql_real_escape_string($new['title'])."','".mysql_real_escape_string(strip_tags($new['description']))."','".mysql_real_escape_string($new['source'])."','".mysql_real_escape_string($new['date'])."','".mysql_real_escape_string($new['lien'])."')") or die(mysql_error());
						}
					}
					
				mysql_query("UPDATE sources SET last_update = '".date("Y-m-d H:i:s")."' WHERE lien = '".$lien."' AND langage = '".$lang."'") or die(mysql_error());
			}
			catch(Exception $e){ return false;}
		}
		
		function get_img($cat,$id,$lang){
			$cat = str_replace('news_','',$cat);
			if(!in_array($lang,$this->lang) || !in_array($cat,$this->scat)) die('401');
			$table = $lang.'_'.$cat;
			$query = mysql_query("SELECT * FROM ".$table." WHERE id = '".$id."'") or die(mysql_error());
			if(mysql_num_rows($query) == 0) die('404');
			while ($row = mysql_fetch_assoc($query)) $result = $row;
			$images = $result['images'];
			if(strlen($images) == 0)  return(array('function'=>'show_image_article','categorie'=>$cat,'id'=>$id,'image'=>'[]'));
			$images = json_decode($result['images']);
			if(count($images) == 1){
				$resultats = array();
				$resultats['function'] = 'show_image_article';
				$resultats['categorie'] = $cat;
				$resultats['id'] = $id;
				$resultats['image'] = $images[0];
				return $resultats;
			}
			elseif(count($images) == 0) return(array('function'=>'show_image_article','categorie'=>$cat,'id'=>$id,'image'=>'[]'));
			foreach($images as $k=>$image){
				$sizes = @getimagesize(urldecode($image));
				if(!empty($sizes) && is_array($sizes) && count($sizes) >= 2){
					$width = $sizes[0];
					$height = $sizes[1];
					if($width > 242 && $height > 208) $images[$image] = $width*$height;
				}
				unset($images[$k]);
			}
			arsort($images);
			foreach($images as $k=>$v){$image_final = $k; break;}
			if(!empty($image_final)) $json = "[\"".$image_final."\"]";
			else $json = "[]";
			mysql_query('UPDATE '.$table.' SET images = "'.mysql_real_escape_string($json).'" WHERE id= "'.$id.'"') or die(mysql_error());
			return $this->get_img($cat,$id,$lang);
		}
		
		function get_article($cat,$id,$lang){
			$cat = str_replace('news_','',$cat);
			if(!in_array($lang,$this->lang) || !in_array($cat,$this->scat)) die('401');
			$table = $lang.'_'.$cat;
			$query = mysql_query("SELECT * FROM ".$table." WHERE id = '".$id."'") or die(mysql_error());
			if(mysql_num_rows($query) == 0) die('404');
			while ($row = mysql_fetch_assoc($query)) $result = $row;
			
			$query1 = mysql_query("SELECT * FROM sources WHERE source = '".mysql_real_escape_string($result['source'])."' AND langage = '".$lang."'") or die(mysql_error());
			if(mysql_num_rows($query1) != 0) while ($row = mysql_fetch_assoc($query1)) $result1 = $row;
			if(!empty($result1)) $icon = $result1['icon'];
			if(!empty($result['resume']) && !empty($result['tags'])){
				$results['id'] = $result['id'];
				$results['categorie'] = $cat;
				$results['titre'] = $result['titre'];
				$results['summary'] = $result['resume'];
				if(!empty($icon)) $results['icon'] = $icon;
				$results['hottags'] = $result['tags'];
				$results['images'] = $result['images'];
				$results['source'] = $result['source'];
				$results['date'] = $this->dte($result['date'],$lang);
				$results['function'] = "show_article";
				return $results;
			}
			require_once('core/searsparser.php');
			require_once('core/clummly.php');
			require_once('core/searsummer.php');
			$parser = new Searsparser();
			$informations = $parser->parse($result['lien'],$lang);
			
			if(strlen($informations['content'])<10) die('500');
			else{
				 $html = $informations['content'];
			 
				$summer = new Searsummer();
				$resultat = $summer->summ($result['titre'],$html,$lang);
				
				if(count($resultat) > 0 && $resultat != false){
					$str = "{";
					$tags = "[";
					$images = "[";
					foreach($resultat as $k=>$v) $str .= "\"".urlencode($k)."\":\"".$v."\",";
					foreach($informations['hottags'] as $k=>$v) $tags .= "\"".urlencode($k)."\",";
					foreach($informations['images'] as $k=>$v) $images .= "\"".urlencode($k)."\",";
					if(substr($str,-1,1) == ",")  $str = substr($str,0,-1);
					if(substr($tags,-1,1) == ",")  $tags = substr($tags,0,-1);
					if(substr($images,-1,1) == ",")  $images = substr($images,0,-1);
					$str .= "}";
					$tags .= "]";
					$images .= "]";
					$sql = "UPDATE ".$table." SET resume = '".mysql_real_escape_string($str)."', tags = '".mysql_real_escape_string($tags)."', images = '".mysql_real_escape_string($images)."' WHERE lien = '".$result['lien']."'";
					mysql_query($sql) or die(mysql_error());
					return $this->get_article($cat,$id,$lang);
				}
				else die('501');
			}
			
		}
		
		function getMois($month){
			$mois["00"] = "Janvier";
			$mois["01"] = "Janvier";
			$mois["02"] = "Février";
			$mois["03"] = "Mars";
			$mois["04"] = "Avril";
			$mois["05"] = "Mai";
			$mois["06"] = "Juin";
			$mois["07"] = "Juillet";
			$mois["08"] = "Août";
			$mois["09"] = "Septembre";
			$mois["10"] = "Octobre";
			$mois["11"] = "Novembre";
			$mois["12"] = "Décembre";
			return $mois[$month];
		}

		function dte($date,$lang){
			if($lang == "fr"){
				$dte1 = explode(' ',$date);
				$dte = "";
				if(count($dte1) != 0) $dte = explode('-',$dte1[0]);
				if(count($dte) == 3){
					$month = $dte[1];
					$day = $dte[2];
					$year = $dte[0];
					return strtolower($day." ".$this->getMois($month)." ".$year);
				}
			}
			elseif($lang == "en"){
				return date("M jS, Y", strtotime($date));
			}
		}
	
	}
?>
