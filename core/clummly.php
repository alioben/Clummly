<?php

	Class Clummly{
	
		public $stop_words_en = array("a","a's","able","about","above","according","accordingly","across","actually","after","afterwards","again","against","ain't","all","allow","allows","almost","alone","along","already","also","although","always","am","among","amongst","an","and","another","any","anybody","anyhow","anyone","anything","anyway","anyways","anywhere","apart","appear","appreciate","appropriate","are","aren't","around","as","aside","ask","asking","associated","at","available","away","awfully","b","be","became","because","become","becomes","becoming","been","before","beforehand","behind","being","believe","below","beside","besides","best","better","between","beyond","both","brief","but","by","c","c'mon","c's","came","can","can't","cannot","cant","cause","causes","certain","certainly","changes","clearly","co","com","come","comes","concerning","consequently","consider","considering","contain","containing","contains","corresponding","could","couldn't","course","currently","d","definitely","described","despite","did","didn't","different","do","does","doesn't","doing","don't","done","down","downwards","during","e","each","edu","eg","eight","either","else","elsewhere","enough","entirely","especially","et","etc","even","ever","every","everybody","everyone","everything","everywhere","ex","exactly","example","except","f","far","few","fifth","first","five","followed","following","follows","for","former","formerly","forth","four","from","further","furthermore","g","get","gets","getting","given","gives","go","goes","going","gone","got","gotten","greetings","h","had","hadn't","happens","hardly","has","hasn't","have","haven't","having","he","he's","hello","help","hence","her","here","here's","hereafter","hereby","herein","hereupon","hers","herself","hi","him","himself","his","hither","hopefully","how","howbeit","however","i","i'd","i'll","i'm","i've","ie","if","ignored","immediate","in","inasmuch","inc","indeed","indicate","indicated","indicates","inner","insofar","instead","into","inward","is","isn't","it","it'd","it'll","it's","its","itself","j","just","k","keep","keeps","kept","know","knows","known","l","last","lately","later","latter","latterly","least","less","lest","let","let's","like","liked","likely","little","look","looking","looks","ltd","m","mainly","many","may","maybe","me","mean","meanwhile","merely","might","more","moreover","most","mostly","much","must","my","myself","n","name","namely","nd","near","nearly","necessary","need","needs","neither","never","nevertheless","new","next","nine","no","nobody","non","none","noone","nor","normally","not","nothing","novel","now","nowhere","o","obviously","of","off","often","oh","ok","okay","old","on","once","one","ones","only","onto","or","other","others","otherwise","ought","our","ours","ourselves","out","outside","over","overall","own","p","particular","particularly","per","perhaps","placed","please","plus","possible","presumably","probably","provides","q","que","quite","qv","r","rather","rd","re","really","reasonably","regarding","regardless","regards","relatively","respectively","right","s","said","same","saw","say","saying","says","second","secondly","see","seeing","seem","seemed","seeming","seems","seen","self","selves","sensible","sent","serious","seriously","seven","several","shall","she","should","shouldn't","since","six","so","some","somebody","somehow","someone","something","sometime","sometimes","somewhat","somewhere","soon","sorry","specified","specify","specifying","still","sub","such","sup","sure","t","t's","take","taken","tell","tends","th","than","thank","thanks","thanx","that","that's","thats","the","their","theirs","them","themselves","then","thence","there","there's","thereafter","thereby","therefore","therein","theres","thereupon","these","they","they'd","they'll","they're","they've","think","third","this","thorough","thoroughly","those","though","three","through","throughout","thru","thus","to","together","too","took","toward","towards","tried","tries","truly","try","trying","twice","two","u","un","under","unfortunately","unless","unlikely","until","unto","up","upon","us","use","used","useful","uses","using","usually","uucp","v","value","various","very","via","viz","vs","w","want","wants","was","wasn't","way","we","we'd","we'll","we're","we've","welcome","well","went","were","weren't","what","what's","whatever","when","whence","whenever","where","where's","whereafter","whereas","whereby","wherein","whereupon","wherever","whether","which","while","whither","who","who's","whoever","whole","whom","whose","why","will","willing","wish","with","within","without","won't","wonder","would","would","wouldn't","x","y","yes","yet","you","you'd","you'll","you're","you've","your","yours","yourself","yourselves","z","zero");
		
		public $stop_words_fr = array("a","à","â","abord","afin","ah","ai","aie","ainsi","allaient","allo","allô","allons","après","assez","attendu","au","aucun","aucune","aujourd","aujourd'hui","auquel","aura","auront","aussi","autre","autres","aux","auxquelles","auxquels","avaient","avais","avait","avant","avec","avoir","ayant","b","bah","beaucoup","bien","bigre","boum","bravo","brrr","c","ça","car","ce","ceci","cela","celle","celle-ci","celle-là","celles","celles-ci","celles-là","celui","celui-ci","celui-là","cent","cependant","certain","certaine","certaines","certains","certes","ces","cet","cette","ceux","ceux-ci","ceux-là","chacun","chaque","cher","chère","chères","chers","chez","chiche","chut","ci","cinq","cinquantaine","cinquante","cinquantième","cinquième","clac","clic","combien","comme","comment","compris","concernant","contre","couic","crac","d","da","dans","de","debout","dedans","dehors","delà","depuis","derrière","des","dès","désormais","desquelles","desquels","dessous","dessus","deux","deuxième","deuxièmement","devant","devers","devra","différent","différente","différentes","différents","dire","divers","diverse","diverses","dix","dix-huit","dixième","dix-neuf","dix-sept","doit","doivent","donc","dont","douze","douzième","dring","du","duquel","durant","e","effet","eh","elle","elle-même","elles","elles-mêmes","en","encore","entre","envers","environ","es","ès","est","et","etant","étaient","étais","était","étant","etc","été","etre","être","eu","euh","eux","eux-mêmes","excepté","f","façon","fais","faisaient","faisant","fait","feront","fi","flac","floc","font","g","gens","h","ha","hé","hein","hélas","hem","hep","hi","ho","holà","hop","hormis","hors","hou","houp","hue","hui","huit","huitième","hum","hurrah","i","il","ils","importe","j","je","jusqu","jusque","k","l","la","là","laquelle","las","le","lequel","les","lès","lesquelles","lesquels","leur","leurs","longtemps","lorsque","lui","lui-même","m","ma","maint","mais","malgré","me","même","mêmes","merci","mes","mien","mienne","miennes","miens","mille","mince","moi","moi-même","moins","mon","moyennant","n","na","ne","néanmoins","neuf","neuvième","ni","nombreuses","nombreux","non","nos","notre","nôtre","nôtres","nous","nous-mêmes","nul","o","o|","ô","oh","ohé","olé","ollé","on","ont","onze","onzième","ore","ou","où","ouf","ouias","oust","ouste","outre","p","paf","pan","par","parmi","partant","particulier","particulière","particulièrement","pas","passé","pendant","personne","peu","peut","peuvent","peux","pff","pfft","pfut","pif","plein","plouf","plus","plusieurs","plutôt","pouah","pour","pourquoi","premier","première","premièrement","près","proche","psitt","puisque","q","qu","quand","quant","quanta","quant-à-soi","quarante","quatorze","quatre","quatre-vingt","quatrième","quatrièmement","que","quel","quelconque","quelle","quelles","quelque","quelques","quelqu'un","quels","qui","quiconque","quinze","quoi","quoique","r","revoici","revoilà","rien","s","sa","sacrebleu","sans","sapristi","sauf","se","seize","selon","sept","septième","sera","seront","ses","si","sien","sienne","siennes","siens","sinon","six","sixième","soi","soi-même","soit","soixante","son","sont","sous","stop","suis","suivant","sur","surtout","t","ta","tac","tant","te","té","tel","telle","tellement","telles","tels","tenant","tes","tic","tien","tienne","tiennes","tiens","toc","toi","toi-même","ton","touchant","toujours","tous","tout","toute","toutes","treize","trente","très","trois","troisième","troisièmement","trop","tsoin","tsouin","tu","u","un","une","unes","uns","v","va","vais","vas","vé","vers","via","vif","vifs","vingt","vivat","vive","vives","vlan","voici","voilà","vont","vos","votre","vôtre","vôtres","vous","vous-mêmes","vu","w","x","y","z","zut","commentaire","commentaires","article","articles","partager","savoir");
		
		public $lang = 'en';
		
		public $titles = array();
		
		public function clumme($title,$text,$par_delimiter,$lang=null,$bool=0){
			if($lang) $this->lang = $lang;
			$texter = $this->clean_text($text);
			$paragraphes = $this->decoupe_en_paragraphe($texter,$par_delimiter);
			$phrases = $this->decoupe_en_phrase($paragraphes);
			$phrases = $this->supprimer_les_details($phrases);
			$tags = $this->generate_tags($phrases);
			$tags = $this->clean_tags($tags);
			$tags = $this->compare_with_title($tags,$title);
			$tags = $this->tri_tags($tags);
			$resume = $this->class_phrases($phrases,$tags);
			$resume = $this->tri_tags($resume);
			$resume = $this->generate($resume,$tags,$bool,$text);
			return $resume;
		}
		
		function clean_text($text){
			$title = array();
			preg_match_all('#<h([1-3])>(.*?)<\/h\1>#iu',$text,$matches);
			if(count($matches[0])>0){
				$title = array();
				foreach($matches[2] as $k=>$titre){
					if(strlen(trim(strip_tags($titre))) > 5){
						$title[$titre.'{htype~h'.$matches[1][$k].'}'] = explode(trim(strip_tags($titre)),$text);
						$text = str_replace($matches[0][$k],'',$text);
					}
				}
			}
			$this->titles = $title;
			$text = preg_replace('#([a-zA-Z])[‘’]([a-zA-Z])#ui', "$1'$2",$text);
			$regexs = array();
			$replacement = array();
			$cars = array(0=>'‘',1=>'’',2=>'«',3=>'»',4=>'\(',5=>'\)');
			$i=0;
			while($i<count(preg_split('#[\.!\?]\s#u',$text))){
			foreach($cars as $k=>$c):
				if(!in_array($c,array('’','»','\)'))){
					$regexs[0] = "#(".$c.")(.*?)\.(.*?)(".$cars[$k+1].")#u";
					$replacement[0]= "$1$2{:point:}$3$4";
					$regexs[0] = "#(".$c.")(.*?)\?(.*?)(".$cars[$k+1].")#u";
					$replacement[1] = "$1$2{:excl:}$3$4";
					$regexs[0] = "#(".$c.")(.*?)!(.*?)(".$cars[$k+1].")#u";
					$replacement[2] = "$1$2{:inter:}$3$4";
					$text = preg_replace($regexs,$replacement,$text);
				}
			endforeach;
				$text = preg_replace('#\s"(.*?)\.(.*?)"#u','"$1{:point:}$2"',$text);
				$text = preg_replace('#\s"(.*?)!(.*?)"#u','"$1{:excl:}$2"',$text);
				$text = preg_replace('#\s"(.*?)\?(.*?)"#u','"$1{:inter:}$2"',$text);
			$i++;
			}
			return $text;
		}
		
		function decoupe_en_phrase($pars){
			if(!is_array($pars)) return false;
			foreach($pars as $k=>$text):
				$tab = array();
				$tab = preg_split("#(\s[^\.\!\?\s]{2,}[\s]*[\.\!\?][\s]?)#ui",$text,-1, PREG_SPLIT_DELIM_CAPTURE);
				foreach($tab as $key=>$phrase):
						$term = preg_split('#([\.\!\?])#ui',$phrase,-1, PREG_SPLIT_DELIM_CAPTURE);
						if(count($term)>1):
							if(array_key_exists($key-1,$tab)) $tab[$key-1].= $term[0].$term[1];
							if(array_key_exists($key+1,$tab)) $tab[$key+1] = $term[2].$tab[$key+1];
							unset($tab[$key]);
						endif;
				endforeach;
				foreach($tab as $key=>$phrase):
						if(strlen(trim($phrase)) < 2) unset($tab[$key]);
				endforeach;	
				$pars[$k] = $tab;
			endforeach;
			return $pars;
		}
		
		function supprimer_les_details($arr){
			if(!is_array($arr)) return false;
			foreach($arr as $k=>$par):
				foreach($par as $ke=>$phrase){
					$i = 0;
					while($i>count(explode('(',$arr[$k]))){
						$regex = "#\((.*?)\)#u";
						$arr[$k] = preg_replace($regex,"",$phrase);
						$i++;
					}
				}
			endforeach;
			return $arr;
		}
		
		function decoupe_en_paragraphe($text,$delimiter){
			$tab = array();
			$regex = "#<".$delimiter.">#iu";
			$tab = preg_split($regex,$text);
			$regex = "#<\/".$delimiter.">#iu";
			foreach($tab as $k=>$v):
				if(strlen(str_replace(" ","",$v)) < 4) unset($tab[$k]);
				else $tab[$k] = preg_replace($regex,"",$v);
			endforeach;
			return $tab;
		}
		
		function generate_tags($arr){
			if(!is_array($arr)) return false;
			$tags = array();
			foreach($arr as $k=>$par):
				$tags[$k] = array();
				foreach($par as $key=>$v):
					$v = $this->ponc_replace($v);
				
					$mots = explode(" ",$v);
					foreach($mots as $mot):
						if(strlen(trim($mot)) > 1){
							if($mots[0] == $mot) $mot = strtolower($mot);
							if(!array_key_exists($mot,$tags[$k])) $tags[$k][$mot]= 1;
							else $tags[$k][$mot]++;
						}
					endforeach;
				endforeach;
			endforeach;
			return $tags;
		}
		
		function clac_sum_tags($tags,$nbre_ph){
			$sum = 0;
			$sig_tag = 0;
			$nbre_p = count($nbre_ph);
			$sigma = array();
			$moy_ph = 0;
			foreach($nbre_ph as $k=>$par):
				if(count($tags[$k]) > 1 && $par > 1){
					$sig_tag = 0;
					$sig_tag = array_sum($tags[$k]);
					$sigma[] = $sig_tag/$par;
				}
				else unset($tags[$k]);
			endforeach;
			$sum = array_sum($sigma)/$nbre_p;
			return $sum;			
		}

		function clean_tags($tags){
			if($this->lang == 'en') $stop_words = $this->stop_words_en;
			elseif($this->lang == 'fr') $stop_words = $this->stop_words_fr; 
			foreach($tags as $k=>$par):
				foreach($par as $tag=>$nbre):
					if(in_array($tag,$stop_words)) unset($tags[$k][$tag]);
				endforeach;
			endforeach;
			return $tags;
		}
		function compare_with_title($tags,$title){
			if($this->lang == 'en') $stop_words = $this->stop_words_en;
			elseif($this->lang == 'fr') $stop_words = $this->stop_words_fr; 
			$title = $this->ponc_replace($title);
			$title = strtolower($title);
			$tab = explode(' ',$title);
			foreach($tab as $k=>$mot):
				if(strlen(trim($mot))<2 || in_array($mot,$stop_words)) unset($tab[$k]);
			endforeach;
			foreach($tags as $k=>$par):
				foreach($par as $tag=>$nbre):
					if(in_array(strtolower($tag),$tab)) $tags[$k][$tag] = $tags[$k][$tag] + 2;
				endforeach;
			endforeach;
			return $tags;
		}
		
		function tri_tags($tags){
			foreach($tags as $k=>$par):
				arsort($tags[$k]);
			endforeach;
			return $tags;
		}
		function class_phrases($text,$tags){
			$resume = array();
			$tags1 = array();
			foreach($tags as $k=>$v):
				foreach($v as $ke=>$ve):
				if(array_key_exists($ke,$tags1)) $tags1[$ke] += $ve;
				else  $tags1[$ke] = $ve;
				endforeach;
			endforeach;
			foreach($text as $key=>$phrases){
				$resume[$key] = array();
				foreach($phrases as $ke=>$phrase):
					$resume[$key][$phrase] = 1;
					$mots = explode(" ",$phrase);
					foreach($mots as $k=>$mot):
						if(array_key_exists($this->ponc_replace($mot),$tags1)) $resume[$key][$phrase] = $resume[$key][$phrase] + $tags1[$mot];
					endforeach;
				endforeach;
			}
			return $resume;
		}
		
		function generate($resume,$tags,$bool=0,$text = "",$type=0){
			$somme = array();
			$sum=0;
			$phrases = array();
			$nbre_p = array();
			
			foreach($resume as $key=>$par):	
				foreach($par as $k=>$v):
					if(!preg_match('#\.$#u',$k)) unset($resume[$key][$k]);
					else $somme[] = $v; 
				endforeach;
			endforeach;
			foreach($resume as $key=>$par):
				if(count($par) > 0) $nbre_p[$key] = count($par);
				else unset($resume[$key]);
			endforeach;
			if(count($somme)<=0) return false;
			$moy = $this->clac_sum_tags($tags,$nbre_p);
			$sum = array_sum($somme)/count($somme);
			foreach($resume as $key=>$par):
				$i=0;
				foreach($par as $k=>$v):
					if( $v > $sum ) $phrases[$k] = $key; 
				endforeach;
			endforeach;
			
			foreach($phrases as $k=>$v){
				unset($phrases[$k]);
				$phrases[$this->clean_from_abr($k)] = $v;
			}
			$arr_key = array_keys($phrases);
			foreach($this->titles as $k=>$v){
				$title = preg_replace('#(.*?)\{htype~(h[1-3])\}#u','<$2>$1</$2>',$k);
				if(count($v)>1){
					foreach($arr_key as $key=>$p){
						if(array_key_exists($key+1,$arr_key)){
							if(substr_count($v[0],$p)>0 && substr_count($v[1],$arr_key[$key+1])>0){
								foreach($phrases as $ka=>$va){
									unset($phrases[$ka]);
									$phrases[$ka] = $va;
									if($ka == $p) $phrases[$title] = "title";
								}
							}
						}
					}
				}
			}
			if($bool == 1){
				$nbre_words = 0;
				foreach($phrases as $phrase=>$val) $nbre_words += count(explode(" ",strip_tags($phrase)));
				$resu = "<ul>";
				$resu .= "<li>Nombre de mots dans le résumé: ".$nbre_words."</li>";
				$resu .= "<li>Nombre de mots dans l'article: ".count(explode(" ",$text))."</li>";
				$resu .= "</ul>";
				$phrases[$resu] = 'infos';
			}
			return $phrases;
		}
		
		function ponc_replace($text){
			$ponc = array(",",".","!","?",";","[","]","،");
			$cars = str_replace($ponc, " ",$text);
			return $cars;
		
		}
		
		function clean_from_abr($text){
			$text = str_replace('{:point:}','.',$text);
			$text = str_replace('{:excl:}','!',$text);
			$text = str_replace('{:inter:}','?',$text);
			return $text;
		}
	}
?>	