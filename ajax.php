<?php
	header('Content-Type: application/json; charset=UTF-8');
	if(empty($_GET['action'])) die('400');
	if(!empty($_GET['lang'])) $lang = $_GET['lang'];
	else $lang = "fr";
	switch($_GET['action']){
		case 'get':
			require_once('core/clummer.php');
			$news = new Clummer();
			$results = $news->get_news($lang);
			echo json_encode($results);
			break;
		case 'categorie':
			if(empty($_GET['cat'])) die('401');
			if(!empty($_GET['etape'])) $etape = $_GET['etape'];
			else $etape = 1;
			if($etape == 1){
				$cat = $_GET['cat'];
				require_once('core/clummer.php');
				$news = new Clummer();
				$results = $news->get_categorie($cat,$lang);
				echo json_encode($results);
			}
			elseif($etape == 2){
				$cat = $_GET['cat'];
				require_once('core/clummer.php');
				$news = new Clummer();
				$results = $news->update_categorie($cat,$lang);
				echo json_encode($results);
			}
			break;
		case 'summarize':
			if(empty($_GET['cat']) || empty($_GET['id']) || !is_numeric($_GET['id'])) die('401');
			$cat = $_GET['cat'];
			$id = $_GET['id'];
			require_once('core/clummer.php');
			$news = new Clummer();
			$results = $news->get_article($cat,$id,$lang);
			echo json_encode($results);
			break;
		case 'getimg':
			if(empty($_GET['cat']) || empty($_GET['id']) || !is_numeric($_GET['id'])) die('401');
			$cat = $_GET['cat'];
			$id = $_GET['id'];
			require_once('core/clummer.php');
			$news = new Clummer();
			$results = $news->get_img($cat,$id,$lang);
			echo json_encode($results);
			break;
	}
?>