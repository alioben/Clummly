<?php 

	class Searsummer{
	
		public $paragraphs = array();
		public $titles = array();
		public $lang = "";
		
		function summ($title,$html,$lang,$delimiter='<p>'){
			$this->lang = $lang;
			if(strlen(trim($html)) < 100) return 0;
			require_once('html_parse.php');
			$html = str_get_html($html);
			if($html){
				$html = $this->fetch_titles($html);
				$this->fetch_paragraphs($html);
				if(count($this->paragraphs)<1) return 0;
				else return $this->clummly($title,$this->paragraphs);
			}
			else return 0;
		}
		
		function fetch_titles($html){
			foreach($html->find('h1,h2,h3') as $element){
				$el = $element;
				$this->titles[$element->innertext.'{htype~'.$element->tag.'}'] = explode($el->outertext,$html->outertext);
				$html->outertext = str_replace($element->outertext,'',$html->outertext);
			}
			return $html;
			print_r($this->titles);
			die();
		}
		
		function fetch_paragraphs($html){
			if(!$html) return false;
			foreach($html->find('div,p') as $element){
				if(preg_match('#<(div|p)(.*?)>#iu',$element->innertext) != 1) $this->paragraphs[] = $element->innertext;
			}
			foreach($this->paragraphs as $key=>$innertext){
				if(!empty($innertext)){
					$ht = str_get_html($innertext);
					if(strlen($ht->plaintext)<5) unset($this->paragraphs[$key]);
					else{
						$this->paragraphs[$key] = $ht->plaintext;
						unset($ht);
					}
				}
				else unset($this->paragraphs[$key]);
			}
			foreach($this->paragraphs as $title=>$text) if($title == $text) unset($this->paragraphs[$title]);
		}
		
		function clummly($title,$paragraphs){
			require_once('clummly.php');
			$clummer = new Clummly();
			$text = '';
			$npars = $paragraphs;
			foreach($this->titles as $title=>$arr){
				foreach($paragraphs as $key=>$html){
					if(strrpos(trim(strip_tags($arr[0])),trim(strip_tags($html))) == strlen(trim(strip_tags($arr[0])))-strlen(trim(strip_tags($html)))){
						foreach($npars as $k=>$h){
							$npars[] = $h;
							if($h == $html) $npars[] = preg_replace('#(.*?)\{htype~(h[1-3])\}#u','<$2>$1</$2>',$title);
							unset($npars[$k]);
						}
					}
				}
			}
			foreach($npars as $key=>$html) $text .= '<p>'.$html.'</p>';
			$resume = $clummer->clumme($title,$text,'p',$this->lang,0);
			return $resume;
		}
		
	}
?>