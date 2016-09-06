<!doctype html>
<html>
  <head>
    <title>Clummly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" href="css/style.css">
   
  </head>
  <body>
  	<div class="update_loader">
		<div>
			<img src="img/loader-gif.gif" alt>&nbsp;Updating the news...
		</div>
	 </div>
	 <div class="loader">
		<img src="img/loader-gif.gif" alt>
	 </div>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
		<button class="btn pull-left btn_return">Return</button>
          <div style="position:relative;margin-left:auto;margin-right:auto;width:103px;">
            <a class="brand"  style="border-right: 0px;" href="#">Clummly</a> 
          </div>
					
		  <div class="btn-group pull-right" style="margin-left:5px;">
			  <a class="btn " data-toggle="dropdown" href="#">
				<i class="icon-cog icon-white"></i>
				<span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu languages">
				<li class="lang_en"><a tabindex="-1" href="#"><img src="img/ico-uk.png" alt="">&nbsp;&nbsp;&nbsp;English</a></li>
				<li class="lang_fr"><a tabindex="-1" href="#"><img src="img/ico-france.png" alt="">&nbsp;&nbsp;&nbsp;Français</a></li>
			  </ul>
			</div>
        </div>
      </div>
    </div>
    <div class="container" id="first_container">
      <div class="row">
        <div class="span12 news_list">
          
        </div>
      </div>
      <div class="row news_categorie_list">
      </div>
	   <div class="row news_article_list">
      </div>
    </div>

  </body>
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/clummly.js"></script>
</html>