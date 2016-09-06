<?php 

	class Searsparser{
		
		public $divs = array();
		public $s_divs = array();
		public $tags = array();
		public $hot_tags = array();
		public $images = array();
		public $content = '';
		public $diffrence_word = 0;
		public $word_freq = 0;
		public $url = '';
		public $domaine = '';
		public $lang = "";
		
		function check_utf8($str) { 
			$len = strlen($str); 
			for($i = 0; $i < $len; $i++){ 
				$c = ord($str[$i]); 
				if ($c > 128) { 
					if (($c > 247)) return false; 
					elseif ($c > 239) $bytes = 4; 
					elseif ($c > 223) $bytes = 3; 
					elseif ($c > 191) $bytes = 2; 
					else return false; 
					if (($i + $bytes) > $len) return false; 
					while ($bytes > 1) { 
						$i++; 
						$b = ord($str[$i]); 
						if ($b < 128 || $b > 191) return false; 
						$bytes--; 
					} 
				} 
			} 
			return true; 
		}
		function get_data( $url ) {
			$res = array();
			$options = array( 
				CURLOPT_RETURNTRANSFER => true,     // return web page 
				CURLOPT_HEADER         => false,    // do not return headers 
				CURLOPT_FOLLOWLOCATION => true,     // follow redirects 
				CURLOPT_USERAGENT      => "Clummly", // who am i 
				CURLOPT_AUTOREFERER    => true,     // set referer on redirect 
				CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect 
				CURLOPT_TIMEOUT        => 120,      // timeout on response 
				CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects 
			); 
			$ch      = curl_init( $url ); 
			curl_setopt_array( $ch, $options ); 
			$content = curl_exec( $ch ); 
			$err     = curl_errno( $ch ); 
			$errmsg  = curl_error( $ch ); 
			$header  = curl_getinfo( $ch ); 
			curl_close( $ch );
			if(!$this->check_utf8($content)) return utf8_encode($content);  
			else return $content;
			
		}  

		function close_xhtml($xhtml){
			$tags = array();
			for ($i = 0; preg_match('`<(/?)([a-z]+)(?:\s+[a-z]+="[^"]*")*>`iu', $xhtml, $tag, PREG_OFFSET_CAPTURE, $i); $i = strlen($tag[0][0]) + $tag[0][1]){
				if ($tag[1][0] != '/') $tags[] = $tag[2][0];
					elseif ($tag[2][0] == end($tags))  array_pop($tags);
					else $xhtml = substr_replace($xhtml, '',  $tag[0][1], strlen($tag[0][0]));
			}
			$xhtml = preg_replace('`<[^>]*$`', '', $xhtml);
			while ($tag = array_pop($tags)) $xhtml .= '</'.$tag.'>';
			return $xhtml;
		}
 
		function parse($url,$lang="en"){
		
			require_once('html_parse.php');
			if($url) $this->url = $url;
			else return '400';
			$this->lang = $lang;
			preg_match('@^(?:http://)?([^/]+)@iu',utf8_encode($url), $matches);
			$this->domaine = $matches[0];
			if(substr($this->domaine,-1) == '/') $this->domaine = substr($this->domaine,0,-1);
			$source = $this->get_data($url);
			
			if(!$source) return '404';
			$source = preg_replace('#<article(.*?)>(.*?)<\/article>#su','<div$1>$2</div>',$source);
			$html = str_get_html($source);
			if($html){
				$title = ($html->find('title',0)) ?  $html->find('title',0)->plaintext : '' ;
				if(count(explode('-',$title))==2 && strlen(reset(explode('-',$title)))> strlen(end(explode('-',$title)))) $title = reset(explode('-',$title));
				elseif(count(explode('|',$title))==2 && strlen(reset(explode('|',$title)))> strlen(end(explode('|',$title)))) $title = reset(explode('|',$title));
				$important_informations = $html->find('h1,h2');
				$description = ($html->find('meta[name=description]',0)) ? $html->find('meta[name=description]',0)->plaintext : ''  ;
				$html = $this->generate_tree_dom($html);
				foreach($html->find('div') as $el) $this->generate_tags($el);
				if(!empty($this->tags)) $this->generate_hot_tags($this->tags,$title,$description,$important_informations);
				else return '402';
				if(!empty($this->hot_tags)) $this->fetch_content($html,$title,$description,$important_informations);
				else return '401';
				$html->clear(); 
				unset($html);
				foreach($this->hot_tags as $tags=>$v){
					$domaine = explode('.',str_replace('www.','',str_replace('http://','',$this->domaine)));
					if(count($domaine) > 1) $domaine = $domaine[0];
					else $domaine = str_replace('www.','',str_replace('http://','',$this->domaine));
					if(substr_count($tags,$domaine)>0) unset($this->hot_tags[$tags]);
				}
				if(!empty($this->content)){
					$title = $this->get_title($title, $this->hot_tags, $this->content);
					$html = str_get_html($this->content);
					foreach($html->find('div') as $el) $this->generate_tags($el);
					$this->generate_hot_tags($this->tags,$title,$description,$important_informations);
					foreach($this->hot_tags as $tag=>$value){
							$freq_word = count(explode($tag,$this->content));
							foreach($this->hot_tags as $t=>$v){
								if($t != $tag){
									$freq_words = 0;
									$freq_words_a = 0;
									$freq_words_b = 0;
									$freq_words_a += count(explode($t." ".$tag,$this->content));
									$freq_words_b += count(explode($tag." ".$t,$this->content));
									$freq_words = $freq_words_a+$freq_words_b;
									if($freq_words>$freq_word/2 && $freq_words>2){
										unset($this->hot_tags[$tag]);
										unset($this->hot_tags[$t]);
										if($freq_words_a>=$freq_words_b){
											foreach($this->hot_tags as $ta=>$va) if(substr_count($ta,$t." ".$tag)>0) unset($this->hot_tags[$ta]);
											$this->hot_tags[$t." ".$tag] = $value+$v;
										}
										else{
											foreach($this->hot_tags as $ta=>$va) if(substr_count($ta,$tag." ".$t)>0) unset($this->hot_tags[$ta]);
											$this->hot_tags[$tag." ".$t] = $value;
										}
									}
								}
							}
					}
					arsort($this->hot_tags);
					$html->clear(); 
					unset($html);
				}
				return array('title'=>$title,'url'=>$url,'description'=>$description,'content'=>$this->content,'images'=>$this->images,'hottags'=>$this->hot_tags);
			}
			else return '403';
			
		}
			
		function get_title($title,$tags,$content){
			$title = preg_replace('#(.*?)[\|-](.*?)#u','$1',$title);
			$html = str_get_html($content);
			$titles = array();
			foreach($html->find('h1,h2,h3') as $element){
				switch($element->tag){
					case 'h1':
						$titles[$element->plaintext] = array_sum($tags)/count($tags);
						break;
					case 'h2':
						$titles[$element->plaintext] = (array_sum($tags)/count($tags))/2;
						break;
					case 'h3':
						$titles[$element->plaintext] = (array_sum($tags)/count($tags))/3;
						break;
				}
			}
			$html->clear(); 
			unset($html);
			if(count($titles)>0){
				$title_mots = $this->delete_stop_words($title);
				foreach($titles as $titre=>$value){
					$mots = $this->delete_stop_words($titre);
					foreach($mots as $mot) if(array_key_exists($mot,$tags)) $titles[$titre] += $tags[$mot];
					foreach($mots as $mot) if(array_key_exists($mot,$title_mots)) $titles[$titre] += array_sum($tags)/count($tags);
				}
				arsort($titles);
				$titless = array_values($titles);
				$titles = array_keys($titles);
				$val_titre = $titless[0];
				$val_title = array_sum($tags)/count($tags);
				foreach($title_mots as $mot) if(array_key_exists($mot,$tags)) $val_title += $tags[$mot];
				if($val_title<$val_titre || $val_titre*1.1 > $val_title) $title = $titles[0];
			}
	
			return $title;
		}
		
		function fetch_content($html,$title,$description,$impos){
				
			$hot_tags = $this->hot_tags;
			$divs = array();
			if(!empty($title)) $title = $this->delete_stop_words($title);
			if(!empty($description)) $description = $this->delete_stop_words($description);
			if(!empty($impos)){
				foreach($impos as $el){
					$words = $el->plaintext;
					$words = $this->delete_stop_words($words);
				}
			}
			foreach($html->find('div') as $element){
				$text = strtolower($element->plaintext);
				$divs[$element->class] = strlen($element->plaintext);
				foreach($hot_tags as $tag=>$val) if(substr_count($text,$tag)>0) $divs[$element->class] += $val;
			}
			foreach($divs as $class=>$score) if($score == strlen($this->s_divs[$class])) unset($divs[$class]);
			$summ = array_sum($divs)/count($divs);
			
			foreach($divs as $class=>$val){
				$score = 0;
				if(!empty($title) && is_array($title)) foreach($title as $word) if(substr_count($text,$word)>0) $score += $summ*3;
				if(!empty($description) && is_array($description)) foreach($description as $word) if(substr_count($text,$word)>0) $score += $summ*2;
				if( !empty($words) && is_array($words)) foreach($words as $word) if(substr_count($text,$word)>0) $score += $summ;
				$divs[$class] += $score;
			}
			arsort($divs);
			foreach($divs as $class=>$score) if($score == 0) unset($divs[$class]);
			$summ = array_sum($divs)/count($divs);
			foreach($divs as $class=>$score) if($score<$summ) unset($divs[$class]);
			$sdivs = array();
			$vdivs = array();
			foreach($divs as $class=>$score){$sdivs[$class] = $this->s_divs[$class]; $vdivs[$class] = $score; }
			foreach($sdivs as $class=>$source) foreach($sdivs as $c=>$s) if($this->s_divs[$c] != $source && substr_count($source,$this->s_divs[$c])>0) $vdivs[$class] += $s;
			arsort($vdivs);
			
			$sums = array_sum($vdivs)/count($vdivs);
			foreach($vdivs as $class=>$val) if($val<=$sums) unset($vdivs[$class]);
			$sums = array_sum($vdivs)/count($vdivs);
			
			$strlens = array();
			foreach($vdivs as $class=>$val) $strlens[$class] = strlen(strip_tags($this->s_divs[$class]));
			$summ = array_sum($strlens)/count($strlens);
			
			foreach($vdivs as $class=>$val) if($val>=$sums && $strlens[$class]>=$summ) $source_article = $this->s_divs[$class];
			if(empty($source_article)) foreach($strlens as $class=>$val) if($val>=$sums) $source_article = $this->s_divs[$class];
			if(empty($source_article)) foreach($vdivs as $class=>$val){ $source_article = $this->s_divs[$class]; break; }
			
			if(!empty($source_article)) $this->fetch_article($source_article);
			else return false;
		}
		
		function fetch_article($source){
			ini_set('pcre.backtrack_limit', 1000000000000);
			$pattern = array('#<form(.*?)>(.*?)<\/form>#su','#<aside(.*?)>(.*?)<\/aside>#su','#<blockquote(.*?)>(.*?)<\/aside>#su','#<button(.*?)>(.*?)<\/button>#su','#<code(.*?)>(.*?)<\/code>#su','#<commment(.*?)>(.*?)<\/commment>#su','#<embed(.*?)>(.*?)<\/embed>#su','#<iframe(.*?)>(.*?)<\/iframe>#su','#<label(.*?)>(.*?)<\/label>#su','#<object(.*?)>(.*?)<\/object>#su','#<pre(.*?)>(.*?)<\/pre>#su','#<script(.*?)>(.*?)<\/script>#su','#<pre(.*?)>(.*?)<\/pre>#su','#<style(.*?)>(.*?)<\/style>#su','#<ol(.*?)>(.*?)<\/ol>#su','#<input(.*?)>#us','#<textarea(.*?)>(.*?)<\/textarea>#su');
			$source = preg_replace('#\s{2,}#u',' ',$source);
			$pattern2 = array('#<span(.*?)>(.*?)<\/span>#su','#<a(.*?)>(.*?)<\/a>#su');
			$pattern3 = array('#<(div)(.*?)>(.*?)<\/div>#su','#<(p)(.*?)>(.*?)<\/p>#su','#<(h[1-6])(.*?)>(.*?)<\/\1>#su');
			$source = preg_replace($pattern,'',$source);
			$source = preg_replace($pattern2,'$2',$source);
			$source = preg_replace('#<ul(.*?)>(.*?)<\/ul>#us','$2',$source);
			$source = preg_replace('#<li(.*?)>(.*?)<\/li>#u','<p>$2</p>',$source);
			$source = preg_replace($pattern3,'<$1>$3</$1>',$source);
			$source = strip_tags($source,'<table><div><p><h1><h2><h3><h4><h5><h6><strong><i><em><b><img>');
			$images = array();
			$html = str_get_html($source);
			foreach($html->find('img') as $element):
				if(substr($element->src,0,1)=='/'){
					$url = $this->domaine.$element->src;
					$source = str_replace($element->src,$url,$source);
					$element->src = $url;
				}
				else $url = $element->src;
				if(!empty($url)){
					$parse = explode($element->outertext,$source);
					$images[$url] = $element->getAttribute('width')*$element->getAttribute('height')+(strlen(end($parse))/strlen(reset($parse)))*100;
				}
			endforeach;
			
			foreach($html->find('h1,h2,h3') as $el){
				$words = $this->delete_stop_words($el->plaintext);
				if(count($words)>0){
					$valeur = 0;
					foreach($words as $word) if(array_key_exists($word,$this->hot_tags)) $valeur++;
					if($valeur == 0) $source = str_replace($el->outertext,'',$source);
				}
				else $source = str_replace($el->outertext,'',$source);
			}
			$html->clear(); 
			unset($html);
			arsort($images);
			$this->images = $images;
			$this->content = $source;
		}
		
		function generate_tree_dom($html){
			$i=0;
			$prev_parent_class = array();
			$v_divs = array();
			foreach($html->find('div') as $element){
				$parent = $element->parent;
				while($parent->tag != "div" && !empty($parent->tag) && !empty($parent->parent)):
						$parent = $parent->parent;
				endwhile;
				if($parent->tag=='div') $par_class = $parent->class;
				else $par_class = '';
					if(array_key_exists($par_class,$prev_parent_class)){
						$element->class = $par_class.'-'.$prev_parent_class[$par_class];
						$prev_parent_class[$element->class] = 0;
						$prev_parent_class[$par_class]++;
					}
					else{
						$element->class = $i;
						$prev_parent_class[$i] = 0;
						$i++;
					}
					$v_divs[$element->class] = $element->innertext;
			}
			$this->s_divs = $v_divs;
			return $html;
		}
		
		function generate_tags($el){
			$text = $el->plaintext;
			foreach($el->children as $child):
				$children_text = $child->plaintext;
				if(!empty($children_text) && $child->tag == 'div') $text = str_replace($children_text,'',$text);
			endforeach;
			if(empty($text)) return false;
			$text = preg_replace('#\s{2,}#u',' ',$text);
			$mots = $this->delete_stop_words($text);
			foreach($mots as $k=>$mot) $text = preg_replace('#\W#u',' ',$text);
			foreach($mots as $k=>$mot) if(strlen(trim($mot))<=2) unset($mots[$k]);
			$tags = array();
			$tags = array_count_values($mots);
			arsort($tags,SORT_DESC);
			$this->tags[$el->class] = $tags;
		}
		
		function generate_hot_tags($tags,$title,$description,$impos){
			$hot_tags = array();
			$min_note = array();
			foreach($tags as $div){
				foreach($div as $tag=>$note){
					if(array_key_exists($tag,$hot_tags)) $hot_tags[$tag] += $note;
					else $hot_tags[$tag] = $note;
					$min_note[$tag] = $note;
				}
			}
			foreach($hot_tags as $tag=>$note) if($note<=$min_note[$tag]) unset($hot_tags[$tag]);
			$summ = array_sum($hot_tags)/count($hot_tags);
			if(!empty($title)){
				$title = $this->delete_stop_words($title);
				foreach($title as $word) if(array_key_exists($word,$hot_tags)) $hot_tags[$word] = intval($hot_tags[$word]+$summ*3);
			}
			if(!empty($description)){
				$description = $this->delete_stop_words($description);
				foreach($description as $word) if(array_key_exists($word,$hot_tags)) $hot_tags[$word] = intval($hot_tags[$word]+$summ*2);
			}
			if(!empty($impos)){
				foreach($impos as $el){
					$words = $el->plaintext;
					$words = $this->delete_stop_words($words);
					foreach($words as $word) if(array_key_exists($word,$hot_tags)) $hot_tags[$word] = intval($hot_tags[$word]+$summ);
				}
			}
			$summ = array_sum($hot_tags)/count($hot_tags);
			arsort($hot_tags);
			$arr_diff = array();
			$previous_val = 0;
			foreach($hot_tags as $k=>$val){
				$arr_diff[] = abs($val-$previous_val);
				$previous_val = $val;
			}
			$previous_val = 0;
			$diff_summ = array_sum($arr_diff)/count($arr_diff);
			$val_count = array_count_values($hot_tags);
			foreach($hot_tags as $tag=>$val){
				if($previous_val != 0){
					if(abs($previous_val-$val)>$diff_summ && $val<$summ) unset($hot_tags[$tag]);
					elseif($val_count[$val]>3) unset($hot_tags[$tag]);
				}
				$previous_val = $val;
			}	
			$this->diffrence_word = $diff_summ;
			$this->word_freq = $summ;
			$this->hot_tags = $hot_tags;
		}
		
		function delete_stop_words($text){
		
			$ponctuation = array(',','...','?',':','!',';','.','(',')','[',']','"','”','“');
			$stop_words_en = array("a","a's","able","about","above","according","accordingly","across","actually","after","afterwards","again","against","ain't","all","allow","allows","almost","alone","along","already","also","although","always","am","among","amongst","an","and","another","any","anybody","anyhow","anyone","anything","anyway","anyways","anywhere","apart","appear","appreciate","appropriate","are","aren't","around","as","aside","ask","asking","associated","at","available","away","awfully","b","be","became","because","become","becomes","becoming","been","before","beforehand","behind","being","believe","below","beside","besides","best","better","between","beyond","both","brief","but","by","c","c'mon","c's","came","can","can't","cannot","cant","cause","causes","certain","certainly","changes","clearly","co","com","come","comes","concerning","consequently","consider","considering","contain","containing","contains","corresponding","could","couldn't","course","currently","d","definitely","described","despite","did","didn't","different","do","does","doesn't","doing","don't","done","down","downwards","during","e","each","edu","eg","eight","either","else","elsewhere","enough","entirely","especially","et","etc","even","ever","every","everybody","everyone","everything","everywhere","ex","exactly","example","except","f","far","few","fifth","first","five","followed","following","follows","for","former","formerly","forth","four","from","further","furthermore","g","get","gets","getting","given","gives","go","goes","going","gone","got","gotten","greetings","h","had","hadn't","happens","hardly","has","hasn't","have","haven't","having","he","he's","hello","help","hence","her","here","here's","hereafter","hereby","herein","hereupon","hers","herself","hi","him","himself","his","hither","hopefully","how","howbeit","however","i","i'd","i'll","i'm","i've","ie","if","ignored","immediate","in","inasmuch","inc","indeed","indicate","indicated","indicates","inner","insofar","instead","into","inward","is","isn't","it","it'd","it'll","it's","its","itself","j","just","k","keep","keeps","kept","know","knows","known","l","last","lately","later","latter","latterly","least","less","lest","let","let's","like","liked","likely","little","look","looking","looks","ltd","m","mainly","many","may","maybe","me","mean","meanwhile","merely","might","more","moreover","most","mostly","much","must","my","myself","n","name","namely","nd","near","nearly","necessary","need","needs","neither","never","nevertheless","new","next","nine","no","nobody","non","none","noone","nor","normally","not","nothing","novel","now","nowhere","o","obviously","of","off","often","oh","ok","okay","old","on","once","one","ones","only","onto","or","other","others","otherwise","ought","our","ours","ourselves","out","outside","over","overall","own","p","particular","particularly","per","perhaps","placed","please","plus","possible","presumably","probably","provides","q","que","quite","qv","r","rather","rd","re","really","reasonably","regarding","regardless","regards","relatively","respectively","right","s","said","same","saw","say","saying","says","second","secondly","see","seeing","seem","seemed","seeming","seems","seen","self","selves","sensible","sent","serious","seriously","seven","several","shall","she","should","shouldn't","since","six","so","some","somebody","somehow","someone","something","sometime","sometimes","somewhat","somewhere","soon","sorry","specified","specify","specifying","still","sub","such","sup","sure","t","t's","take","taken","tell","tends","th","than","thank","thanks","thanx","that","that's","thats","the","their","theirs","them","themselves","then","thence","there","there's","thereafter","thereby","therefore","therein","theres","thereupon","these","they","they'd","they'll","they're","they've","think","third","this","thorough","thoroughly","those","though","three","through","throughout","thru","thus","to","together","too","took","toward","towards","tried","tries","truly","try","trying","twice","two","u","un","under","unfortunately","unless","unlikely","until","unto","up","upon","us","use","used","useful","uses","using","usually","uucp","v","value","various","very","via","viz","vs","w","want","wants","was","wasn't","way","we","we'd","we'll","we're","we've","welcome","well","went","were","weren't","what","what's","whatever","when","whence","whenever","where","where's","whereafter","whereas","whereby","wherein","whereupon","wherever","whether","which","while","whither","who","who's","whoever","whole","whom","whose","why","will","willing","wish","with","within","without","won't","wonder","would","would","wouldn't","x","y","yes","yet","you","you'd","you'll","you're","you've","your","yours","yourself","yourselves","z","zero");
			$stop_words_fr = array("a","à","â","abord","afin","ah","ai","aie","ainsi","allaient","allo","allô","allons","après","assez","attendu","au","aucun","aucune","aujourd","aujourd'hui","auquel","aura","auront","aussi","autre","autres","aux","auxquelles","auxquels","avaient","avais","avait","avant","avec","avoir","ayant","b","bah","beaucoup","bien","bigre","boum","bravo","brrr","c","ça","car","ce","ceci","cela","celle","celle-ci","celle-là","celles","celles-ci","celles-là","celui","celui-ci","celui-là","cent","cependant","certain","certaine","certaines","certains","certes","ces","cet","cette","ceux","ceux-ci","ceux-là","chacun","chaque","cher","chère","chères","chers","chez","chiche","chut","ci","cinq","cinquantaine","cinquante","cinquantième","cinquième","clac","clic","combien","comme","comment","compris","concernant","contre","couic","crac","d","da","dans","de","debout","dedans","dehors","delà","depuis","derrière","des","dès","désormais","desquelles","desquels","dessous","dessus","deux","deuxième","deuxièmement","devant","devers","devra","différent","différente","différentes","différents","dire","divers","diverse","diverses","dix","dix-huit","dixième","dix-neuf","dix-sept","doit","doivent","donc","dont","douze","douzième","dring","du","duquel","durant","e","effet","eh","elle","elle-même","elles","elles-mêmes","en","encore","entre","envers","environ","es","ès","est","et","etant","étaient","étais","était","étant","etc","été","etre","être","eu","euh","eux","eux-mêmes","excepté","f","façon","fais","faisaient","faisant","fait","feront","fi","flac","floc","font","g","gens","h","ha","hé","hein","hélas","hem","hep","hi","ho","holà","hop","hormis","hors","hou","houp","hue","hui","huit","huitième","hum","hurrah","i","il","ils","importe","j","je","jusqu","jusque","k","l","la","là","laquelle","las","le","lequel","les","lès","lesquelles","lesquels","leur","leurs","longtemps","lorsque","lui","lui-même","m","ma","maint","mais","malgré","me","même","mêmes","merci","mes","mien","mienne","miennes","miens","mille","mince","moi","moi-même","moins","mon","moyennant","n","na","ne","néanmoins","neuf","neuvième","ni","nombreuses","nombreux","non","nos","notre","nôtre","nôtres","nous","nous-mêmes","nul","o","o|","ô","oh","ohé","olé","ollé","on","ont","onze","onzième","ore","ou","où","ouf","ouias","oust","ouste","outre","p","paf","pan","par","parmi","partant","particulier","particulière","particulièrement","pas","passé","pendant","personne","peu","peut","peuvent","peux","pff","pfft","pfut","pif","plein","plouf","plus","plusieurs","plutôt","pouah","pour","pourquoi","premier","première","premièrement","près","proche","psitt","puisque","q","qu","quand","quant","quanta","quant-à-soi","quarante","quatorze","quatre","quatre-vingt","quatrième","quatrièmement","que","quel","quelconque","quelle","quelles","quelque","quelques","quelqu'un","quels","qui","quiconque","quinze","quoi","quoique","r","revoici","revoilà","rien","s","sa","sacrebleu","sans","sapristi","sauf","se","seize","selon","sept","septième","sera","seront","ses","si","sien","sienne","siennes","siens","sinon","six","sixième","soi","soi-même","soit","soixante","son","sont","sous","stop","suis","suivant","sur","surtout","t","ta","tac","tant","te","té","tel","telle","tellement","telles","tels","tenant","tes","tic","tien","tienne","tiennes","tiens","toc","toi","toi-même","ton","touchant","toujours","tous","tout","toute","toutes","treize","trente","très","trois","troisième","troisièmement","trop","tsoin","tsouin","tu","u","un","une","unes","uns","v","va","vais","vas","vé","vers","via","vif","vifs","vingt","vivat","vive","vives","vlan","voici","voilà","vont","vos","votre","vôtre","vôtres","vous","vous-mêmes","vu","w","x","y","z","zut","commentaire","commentaires","article","articles","partager","savoir");
			$text = preg_replace('#(\s){2,}#u',' ',$text);
			$text = str_replace($ponctuation,'',$text);
			$mots = explode(' ',strtolower($text));
			foreach($mots as $k=>$mot) if(mb_strlen(trim($mot),'utf-8')<=2 || preg_match('#\W#',$mot)) unset($mots[$k]);
			$sentence = '';
			foreach($mots as $mot) $sentence .= $mot.' ';
			if($this->lang=="fr") $stop_word = $stop_words_fr;
			elseif($this->lang=="en") $stop_word = $stop_words_en;
			foreach($mots as $k=>$mot) if(in_array($mot,$stop_word)) unset($mots[$k]);
			return $mots;
		}
	}
?>