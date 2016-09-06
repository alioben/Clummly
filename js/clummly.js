$( function() {
	if( getCookie("lang") == null){
		setCookie("lang","fr",2);
		$('.lang_fr').addClass('disabled');
	}
	else if(getCookie("lang") == "fr") $('.lang_fr').addClass('disabled');
	else if(getCookie("lang") == "en") $('.lang_en').addClass('disabled');
	
	 $('.lang_fr').click(function(){
		setCookie("lang","fr",2);
		location.reload() ; 
	 });
	 
	 $('.lang_en').click(function(){
		setCookie("lang","en",2);
		location.reload() ; 
	 });
	 
	 $('.news_article_list').on({
		click:function(e){
if(getCookie("lang") == "en"){
			if($(this).parent('.thumbnail').children('.audio_player').length>1){
				var audio = $(this).parent('.thumbnail').children('.audio_player');
				e.preventDefault(); 
				audio.play(); 
			}
			else{
				var url = 'http://tts-api.com/tts.mp3?q='+encodeURIComponent($(this).parent('.thumbnail').children('.plain_summary').html());
				var html ='<audio preload="auto" autobuffer controls id="audio" class="audio_player"><source src="'+url+'" type="audio/ogg" />Votre navigateur ne supporte pas les objects audio.</audio>﻿';
				$(this).parent('.thumbnail').append(html);
				var audio = $(this).parent('.thumbnail').children('.audio_player');
				e.preventDefault(); 
				audio[0].play();
				audio.hide();
			}
}
		}
	 },'.play_butt');
	 
	 $('.news_article_list').on({
		click: function(e){
			var audio = $(this).parent('.thumbnail').children('.audio_player');
			e.preventDefault(); 
			audio.play(); 
		}
	  },'.play_butt_mini');
	  
	  $('.news_article_list').on({
		click: function(e){
			var audio = $(this).parent('.thumbnail').children('.audio_player');
			e.preventDefault(); 
			audio.play(); 
		}
	  },'.pause_butt');
	  
	  $('.news_article_list').on({
		click: function(e){
			var audio = $(this).parent('.thumbnail').children('.audio_player');
			e.preventDefault(); 
			audio.currentTime=0;
			audio.pause(); 
		}
	  },'.stop_butt');
	  
	  
	$('.btn_return').click(function(){
		var article = 0;
		$('ul[id^=article_]').each(function(){
			if($(this).css('display') != "none" && $(this).css('display') != "hidden"){
				$('.news_article_list').children('ul[id^=article_]').hide();
				$('.news_list').hide();
				$('.news_article_list').hide();
				$('.news_categorie_list').show();
				article = 1;
			}
		});
		if(article == 0){
			$('.news_categorie_list').hide();
			$('.news_list').show();
			$('.btn_return').hide();
		}
	});
	
	$.get("ajax.php?action=get&lang="+getCookie("lang"),{},function(data){
		if (typeof(eval(data['function'])) == 'function') eval(data['function'])(data);
	},'json');
	
	$('.news_list').on({
		click:function(){
			$('.loader').show();
			$.get("ajax.php?action=categorie&etape=1&cat="+$(this).attr('id')+"&lang="+getCookie("lang"),{},function(data){
				if (typeof(eval(data['function'])) == 'function') eval(data['function'])(data);
				$('.loader').hide();
			},'json');
			
			return false;
		}
	},'.news_categories');
	
	$('.news_categorie_list').on({
		click:function(){
			$('.loader').show();
			var cat = $(this).parent('div[id^=news]').attr('id').replace('news_','');
			var id = $(this).attr('id');
			if($('#article_'+cat+'_'+id).length){
				$('.loader').hide();
				$('.news_article_list').children('ul[id^=article_]').hide();
				$('.news_categorie_list').hide();
				$('.news_article_list').show();
				$('#article_'+cat+'_'+id).show();
				window.scrollTo(0,0);
			}
			else{
				$.get("ajax.php?action=summarize&cat="+$(this).parent('div[id^=news]').attr('id')+"&id="+$(this).attr('id')+"&lang="+getCookie("lang"),{},function(data){
					if(data=="500" || data=="501" || data.length > 2){
						if(getCookie("lang") == "fr") alert('L\'article demandé n\'a pas pu être chargé, veuillez réessayer plutard.');
						else if(getCookie("lang") == "en") alert('The article couldn\'t be loaded. Please retry later.');
						$('.loader').hide();
					}
					else if (typeof(eval(data['function'])) == 'function') eval(data['function'])(data);
					$('.loader').hide();
				},'json');
				
				return false;
			}
		}
	},'.article-link');
	
	function update_categorie(data){
		$('.loader').hide();
		$('.update_loader').height(document.body.offsetHeight);
		$('.update_loader').show();
		$.get("ajax.php?action=categorie&etape=2&cat="+data['categorie']+"&lang="+getCookie("lang"),{},function(data){
			if (typeof(eval(data['function'])) == 'function') eval(data['function'])(data);
			$('.update_loader').hide();
		},'json');
	}
	
	function show_article(data){
		$('.loader').hide();
		if(data.length<=1) alert("Désolé l'article n'a pas pu être chargé !");
		else{
			var tags = jQuery.parseJSON(data['hottags']);
			var cat = data['categorie'];
			var images = jQuery.parseJSON(data['images']);
			var titre = data['titre'];
			var id = data['id'];
			var date = data['date'];
			var icon = data['icon'];
			var source = data['source'];
			var phrases = jQuery.parseJSON(data['summary']);
			var summary = "<ul>";
			var plainsummary = "";
			$.each(phrases, function(phrase, value) {
				if(value != 'title' && value != 'infos'){
					summary += "<li>"+urldecode(phrase)+"</li>";
					plainsummary += urldecode(phrase);
				}
				else summary += urldecode(phrase);
			});
			var tag_text = "";
			if(getCookie("lang") == "fr") tag_text = "Mots clé: ";
			else if(getCookie("lang") == "en") tag_text = "Keywords: ";
			var i = 0;
			$.each(tags, function(index, value) {
				if(i<6) tag_text += '<span class="label label-important">'+urldecode(value)+'</span>&nbsp;';
				i++;
			});
			summary += "</ul>";
			var article = '<ul class="thumbnails" id="article_'+cat+'_'+id+'"><li class="span12"><div class="thumbnail">';
if(getCookie("lang") == "en"){
			article += '<button class="btn btn-success play_butt"><i class="icon-play icon-white"></i> Play</button>';
			article += '<button class="btn btn-success play_butt_mini"><i class="icon-play icon-white"></i></button>';
			article += '<button class="btn btn-success pause_butt"><i class="icon-pause icon-white"></i></button>';
			article += '<button class="btn btn-success stop_butt"><i class="icon-stop icon-white"></i></button>';
}
			if(images.length > 1){
				article += '<div class="loading-aticle-image"><center><div><img src="img/loader-gif.gif" alt>&nbsp;Chargement de l\'image...</div></center></div>';
				$.get("ajax.php?action=getimg&id="+id+"&cat="+data['categorie']+"&lang="+getCookie("lang"),{},function(data){
					if (typeof(eval(data['function'])) == 'function') eval(data['function'])(data);
				},'json');
			}
			else if(images.length == 1) article += '<img src="'+urldecode(images[0])+'" alt="" class="article_image">';
			else article += '<img src="img/blank-clummly.png" alt="" class="article_image">';
			article += '<h3>'+titre+' </h3>';
			if(getCookie("lang") == "fr") article += '<div class="article_infos"><small> publié le '+date+' par <span style="color:#FFF;"><img alt="" src="img/'+icon+'" class="source-icon">&nbsp;'+source+'</span></div>';
			else if(getCookie("lang") == "en") article += '<div class="article_infos">published on '+date+' by <span style="color:#FFF;"><img alt="" src="img/'+icon+'" class="source-icon">&nbsp;'+source+'</span></div>';
			article += '<p style="margin-left:10px;">'+tag_text+'</p>';
			article += '<p>'+utf8_decode(summary)+'</p>';
			article += '<p class="plain_summary">'+utf8_decode(plainsummary)+'</p>';
			article += '</div></li></ul>';
			$('.news_article_list').append(article);
			$('.news_article_list').children('ul[id^=article_]').hide();
			$('.news_categorie_list').hide();
			$('.news_article_list').show();
			$('#article_'+cat+'_'+id).show();
			window.scrollTo(0,0);
		}
	}
	
	function show_image_article(data){
		var image = data['image'];
		var cat = data['categorie'];
		var id = data['id'];
		if($('#article_'+cat+'_'+id).length > 0){
			if(image.length>5) var html = '<img src="'+urldecode(image)+'" alt="" class="article_image">';
			else  var html = '<img src="img/blank-clummly.png" alt="" class="article_image">';
			$('#article_'+cat+'_'+id).children('.span12').children('.thumbnail').prepend(html); 
		}
		$('#article_'+cat+'_'+id).children('.span12').children('.thumbnail').children('.loading-aticle-image').remove();
	}
	
	function show_news(data){
		var categorie = data['cat'];
		delete data['function'];
		delete data['cat'];
		var html = '<div class="span12" id="news_'+categorie+'">';
		$.each(data, function(index, value) {
			html += '<div class="hero-unit article-link" id="'+value['id']+'">';
			html += '<h4>'+value['titre']+'</h4>';
			if(value['description'].length>0) html += '<p>'+decouper_texte(value['description'],200)+'</p>';
			if(getCookie("lang") == "fr") html += '<a class="btn pull-right btn-info btn-small">Lire la suite</a> <div class="controls-row"></div>';
			else if(getCookie("lang") == "en") html += '<a class="btn pull-right btn-info btn-small">Read more</a> <div class="controls-row"></div>';
			html += '</div>';
		});
		html += '</div>';
		if($('#news_'+categorie).length) $('#news_'+categorie).remove();
		$('.news_categorie_list').append(html);
		$('.news_categorie_list').children('div[id^=news]').hide();
		$('.news_categorie_list').show();
		$('.news_list').hide();
		$('#news_'+categorie).show();
		$('.btn_return').show();
		window.scrollTo(0,0);
	}
	
	function show_categories(data){
		delete data['function'];
		if(getCookie("lang") == "fr") categories = {"cinema":"Cinéma","economie":"Economie","hightech":"High Tech","laune":"A la une","musique":"Musique","politique":"Politique","sante":"Santé","sport":"Sport","science":"Science"};
		else categories = {"cinema":"Movies","economie":"Economy","hightech":"Technology","laune":"Top Stories","musique":"Music","politique":"Politics","sante":"Health","sport":"Sports","science":"Science"};
		if(getCookie("lang") == "fr") cat_descrption = {"cinema":"Découvrez toute l'actualité du cinéma: les derniers films & séries, les dernières critiques ainsi que vos acteurs préférés.","economie":"Suivez l'actualité économique en France et dans le monde en temps réel. Entreprise, bourse, immobilier, emploi, etc., les infos économiques en continu.","hightech":"Retrouvez toute l'actualité High-Tech, Geek, Web et Mobile ici, et ne manquez plus aucune news liée au High-tech.","laune":"Toutes les actualités à la une en France et dans le monde entier.","musique":"Suivez toute l'actualité musicale, les dernières sorties d'album, les concerts ainsi que tendances du moment.","politique":"Toutes les actualités et analyses politique en exculisivité dans cette rubrique.","sante":"Découvrez toute l'actualité sur la médecine, les médicaments, et les grandes études sur les maladies.","sport":"Suivez le sport en direct, retrouvez l'actualité et les résultats du football, du tennis, du rugby, du basket et de tous vos sports préférés.","science":"Publication quotidienne des dernières news technologiques et scientifiques, publication de dossiers et articles détaillés autour de thèmes scientifiques."};
		else cat_descrption = {"cinema":"All the latest movie news from the world's leading movie magazine. Find out the most important information from the film industry and comment.","economie":"Breaking news on the economy, inflation, growth domestic product (GDP), nation's debt and financial news, as well as coverage on health care, the energy ...","hightech":"The most important technology news, developments and trends with insightful analysis and commentary. Coverage includes hardware, software, networking, ...","laune":"Get breaking national and world news, broadcast video coverage, and exclusive interviews. Find the top news here.","musique":"The Number One magazine featuring news, reviews, interviews & all the gossip from the USA and World music scene.","politique":"Find out what's happening in the world of politics. Get up to the minute, impartial political news coverage on the leaders, policies and agendas ..","sante":"HealthNews has the latest news, alerts and medical updates in health, wellness, fitness, diet and weight loss. Get all of the news, product and diet reviews you ...","sport":"Discover the latest top sports stories and analysis...","science":"Science headline news from all realms of science, including biology, genetics, medicine, stem cells, evolution, animals, climate change, the environment, ..."};
		var html = '';
		$.each(data, function(index, value) {
			html = '';
			html += '<div class="hero-unit news_categories" id="'+index+'"><h4>'+categories[index]+'</h4><p>'+cat_descrption[index]+'</p><div class="arrow-right">&nbsp;</div></div>';
			$('.news_list').append(html);
		});
	}
	
	function getCookie(c_name)
	{
		var c_value = document.cookie;
		var c_start = c_value.indexOf(" " + c_name + "=");
		if (c_start == -1)
		{
		c_start = c_value.indexOf(c_name + "=");
		}
		if (c_start == -1)
		{
		c_value = null;
		}
		else
		{
		c_start = c_value.indexOf("=", c_start) + 1;
		var c_end = c_value.indexOf(";", c_start);
		if (c_end == -1)
		{
		c_end = c_value.length;
		}
		c_value = unescape(c_value.substring(c_start,c_end));
		}
		return c_value;
	}

	function setCookie(c_name,value,exdays)
	{
		var exdate=new Date();
		exdate.setDate(exdate.getDate() + exdays);
		var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
		document.cookie=c_name + "=" + c_value;
	}
	
	function decouper_texte(texte,longueur){
		if(texte.length>longueur){
			var substr = texte.split(' ');
			var ntexte = "";
			$.each(substr, function(index,value){
				if(ntexte.length<longueur) ntexte += value+' ';
				
			});
			return ntexte+'...';
		}
		else return texte;
	}
	function utf8_decode (str_data) {
	  var tmp_arr = [],
		i = 0,
		ac = 0,
		c1 = 0,
		c2 = 0,
		c3 = 0,
		c4 = 0;

	  str_data += '';

	  while (i < str_data.length) {
		c1 = str_data.charCodeAt(i);
		if (c1 <= 191) {
		  tmp_arr[ac++] = String.fromCharCode(c1);
		  i++;
		} else if (c1 <= 223) {
		  c2 = str_data.charCodeAt(i + 1);
		  tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
		  i += 2;
		} else if (c1 <= 239) {
		  // http://en.wikipedia.org/wiki/UTF-8#Codepage_layout
		  c2 = str_data.charCodeAt(i + 1);
		  c3 = str_data.charCodeAt(i + 2);
		  tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
		  i += 3;
		} else {
		  c2 = str_data.charCodeAt(i + 1);
		  c3 = str_data.charCodeAt(i + 2);
		  c4 = str_data.charCodeAt(i + 3);
		  c1 = ((c1 & 7) << 18) | ((c2 & 63) << 12) | ((c3 & 63) << 6) | (c4 & 63);
		  c1 -= 0x10000;
		  tmp_arr[ac++] = String.fromCharCode(0xD800 | ((c1>>10) & 0x3FF));
		  tmp_arr[ac++] = String.fromCharCode(0xDC00 | (c1 & 0x3FF));
		  i += 4;
		}
	  }

	  return tmp_arr.join('');
	}
	function urldecode (str) {
	  return unescape((str + '').replace(/\+/g, '%20'));
	}
});
