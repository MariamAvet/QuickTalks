<?php
session_start();
//подключение конфигов
include("include/stack.php");
$con = dataBase();

//Подключение разных языков!!!
if(!isset($_SESSION['lang']) and $_SESSION['lang'] == NULL){
    $_SESSION['lang'] = "ru";
}
if(isset($_POST['lang'])){
    $_SESSION['lang'] = $_POST['lang'];
}
$lang = getLang($_SESSION['lang'],$con);
//Конец подключения разных языков!!!
//Успешно зарегались
if(isset($_GET['registration'])){
    $error = "<div class='alert alert-success'>".$lang['sucessReg']."</div>";
}
//Попытка входа в систему
if(isset($_POST['enter']) and isset($_POST['login']) and isset($_POST['password'])){
    $login = $_POST['login'];
    $pass = $_POST['password'];
    $id = userLogin($login,$pass,$con);
    if($id != false){
	$_SESSION['idUser'] = $id;
	usersLog($id,"Пользователь успешно авторизовался и вошел в сеть",$con);
	header("Location: pages/profile.php");
	exit;
    }else{
	$error = "<div class='alert alert-danger'>".$lang['errorLogIn']."</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cake Group | <?php echo $lang['auth'];?></title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Стиль для страницы-->
    <link href="style/index.css" rel="stylesheet">
    <link href="style/ihover.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body >
    <?php echo menu("");?>
    <div class='container-fluid' id='header'>
	<div class='row' id='header2'>
	    <div class='col-lg-12 col-md-12'><br><br>
	    <?php echo $error;?>
		<div class='row'>
		    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1'>
			<h1 class='headerText1'><?php echo $lang['welcome']?></h1>
			<p id='welcomeText'><?php echo $lang['welcomeText']?></p>
		    </div>
		    <div class='col-lg-4 col-md-4 col-lg-offset-2 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12'>
			<div>
			<form method='post'>
		    	    <div class="form-group">
		    	    <h1 class='headerText1'><?php echo $lang['auth'];?></h1>
				<input name='login' type="text" class="form-control inputForm" placeholder="<?php echo $lang['login']?>" required>
			    </div>
			    <div class="form-group">
				<input name='password' type="password" class="form-control inputForm" id="exampleInputPassword1" placeholder="<?php echo $lang['pass']?>" required>
			    </div>
			    <div class='row'>
				<div class='col-lg-6 col-md-6'>
				    <a href='pages/register.php' class='textForm'><?php echo $lang['register']?></a>
				    <br>
				    <a href='pages/passRecovery.php' class='textForm'><?php echo $lang['passRec']?></a></div>
				<div class='col-lg-6 col-md-6'>
				    <button id='buttonForm' type="submit" class="btn" name='enter'><?php echo $lang['signIn']?></button>
				</div>
			    </div>
			</form><br>
			<table><tr><td>
			<form action='../auth/google.php' method='post'>
			    <input type='hidden' value='true' name='gauth'>
			    <input type='image' src='images/icons/white/g_wh.png' width='60%' style='color:white;'>
			</form></td><td>
			<form action='../auth/facebook.php' method='post'>
			    <input type='hidden' value='true' name='fauth'>
			    <input type='image' src='images/icons/white/fb_wh.png' width='60%'>
			</form></td><td>
			<form action='../auth/vkontakte.php' method='post'>
			    <input type='hidden' value='true' name='vauth'>
			    <input type='image' src='images/icons/white/vk_wh.png' width='60%'>
			</form></td></tr></table>
			</div>
		    </div>
		</div>
		<br>
	    </div>
	</div>
    </div>
    <!-- Блок с особенностями -->
    <div class='container-fluid'>
	<div class='row'>
	    <center><h1 class='headerText2'><?php echo $lang['features']?></h1>
	    <h3 class='headerText2'><?php echo $lang['featuresText']?></h3><br>
	    <div class='col-lg-4 col-md-4 col-sm-4 hidden-xs exBorder1'>
		<img src='images/icons/chat.png'>
		<p class='exText'><?php echo $lang['features1']?></p>
	    </div>
	    <div class='col-lg-4 col-md-4 col-sm-4 hidden-xs exBorder1'>
		<img src='images/icons/world.png'>
		<p class='exText'><?php echo $lang['feateres2']?></p>
	    </div>
	    <div class='hidden-lg hidden-md hidden-sm col-xs-12 exBorder2'>
		<img src='images/icons/chat.png'>
		<p class='exText'><?php echo $lang['features1']?></p>
	    </div>
	    <div class='hidden-lg hidden-md hidden-sm col-xs-12 exBorder2'>
		<img src='images/icons/world.png'>
		<p class='exText'><?php echo $lang['feateres2']?></p>
	    </div>
	    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
		<img src='images/icons/mobile.png'>
		<p class='exText'><?php echo $lang['features3']?></p>
	    </div>
	    </center>
	</div>
    </div>
    <br><br>
    <!-- Блок с командой -->
    <div class='container-fluid'>
	<div class='row'>
	    <center><h1 class='headerText2'><?php echo $lang['ourTeam']?></h1>
	    <h3 class='headerText2'><?php echo $lang['ourTeamText']?></h3><br>
	    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12' >
		<div class="ih-item circle effect13 bottom_to_top"><a>
		    <div class="img"><img src="images/team/1x1/mariam.jpg" alt="img"></div>
		        <div class="info">
		          <div class="info-back">
			  <h3 class='headerText2'><?php echo $lang['mariam']?></h3>
		      <p class='headerText2'><?php echo $lang['mariamText']?></p>
		    </div>
		</div></a></div>
		<h3 class='headerText2'><?php echo $lang['mariam']?></h3>
		<p class='blackLine'></p>
		<h4 class='headerText2'><?php echo $lang['mariamDesc']?></h4>
			<a href='https://www.facebook.com/mariam.avetyan.16' target='_blank'><img width='10%' src='images/auth/facebook_auth.png'></a>
			<a href='https://vk.com/mar_avet' target='_blank'><img width='10%' src='images/auth/vkontakte_auth.png'></a>
			<a href='https://plus.google.com/u/0/116597757567139935597/posts' target='_blank'><img width='10%' src='images/auth/google_auth.png'></a>
			<a href='#' target='_blank'><img width='10%' src='images/icons/twitter.png'></a>
			<br>
	    </div>
	    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'  >
		<div class="ih-item circle effect13 bottom_to_top"><a>
		    <div class="img"><img src="images/team/1x1/geogiy.jpg" alt="img"></div>
		        <div class="info">
		          <div class="info-back">
			  <h3 class='headerText2'><?php echo $lang['georg']?></h3>
		      <p class='headerText2'><?php echo $lang['georgText']?></p>
		    </div>
		</div></a></div>
		<h3 class='headerText2'><?php echo $lang['georg']?></h3>
		<p class='blackLine'></p>
		<h4 class='headerText2'><?php echo $lang['georgDesc']?></h4>
			<a href='https://www.facebook.com/george.bolshakov' target='_blank'><img width='10%' src='images/auth/facebook_auth.png'></a>
			<a href='https://vk.com/gbolshakov' target='_blank'><img width='10%' src='images/auth/vkontakte_auth.png'></a>
			<a href='https://plus.google.com/u/0/109405356406147755951/posts' target='_blank'><img width='10%' src='images/auth/google_auth.png'></a>
			<a href='https://twitter.com/georgebolshakov' target='_blank'><img width='10%' src='images/icons/twitter.png'></a>
			<a href='https://instagram.com/invader33k' target='_blank'><img width='10%' src='images/icons/instagram.png'></a>
			<a href='mailto:george.bolshakov@yandex.ru' target='_blank'><img width='10%' src='images/icons/at.png'></a>
			<a href='http://ru.linkedin.com/in/georgebolshakov' target='_blank'><img width='10%' src='images/icons/in.png'></a>
			<br>
	    </div>
	    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12' >
	    	<div class="ih-item circle effect13 bottom_to_top"><a>
		    <div class="img"><img src="images/team/1x1/dasha.jpg" alt="img"></div>
		        <div class="info">
		          <div class="info-back">
			  <h3 class='headerText2'><?php echo $lang['Dasha']?></h3>
		      <p class='headerText2'><?php echo $lang['dashaText']?></p>
		    </div>
		</div></a></div>
		<h3 class='headerText2'><?php echo $lang['Dasha']?></h3>
		<p class='blackLine'></p>
		<h4 class='headerText2'><?php echo $lang['dashaDesc']?></h4>
			<!-- <a href='#' target='_blank'><img width='10%' src='images/auth/facebook_auth.png'></a> -->
			<a href='https://vk.com/elkohol' target='_blank'><img width='10%' src='images/auth/vkontakte_auth.png'></a>
			<!-- <a href='#' target='_blank'><img width='10%' src='images/auth/google_auth.png'></a> -->
			<a href='mailto:daria.karataeva@yandex.ru' target='_blank'><img width='10%' src='images/icons/at.png'></a>
			<br>
	    </div>
	    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
		    	<div class="ih-item circle effect13 bottom_to_top"><a>
		    <div class="img"><img src="images/team/1x1/artyom.jpg" alt="img"></div>
		        <div class="info">
		          <div class="info-back">
			  <h3 class='headerText2'><?php echo $lang['artyom']?></h3>
		      <p class='headerText2'><?php echo $lang['artyomText']?><p>
		    </div>
		</div></a></div>
		<h3 class='headerText2'><?php echo $lang['artyom']?></h3>
		<p class='blackLine'></p>
		<h4 class='headerText2'><?php echo $lang['artyomDesc']?></h4>
		<a href='https://www.facebook.com/artyom.kvach' target='_blank'><img width='10%' src='images/auth/facebook_auth.png'></a>
			<a href='https://vk.com/creeone' target='_blank'><img width='10%' src='images/auth/vkontakte_auth.png'></a>
			<a href='https://plus.google.com/u/2/109613094318836696282/posts' target='_blank'><img width='10%' src='images/auth/google_auth.png'></a>
			<a href='https://twitter.com/creeone1' target='_blank'><img width='10%' src='images/icons/twitter.png'></a>
			<br>
	    </div>
	    </center>
	</div>
    </div><br>
    <!-- Блок с присоединяйся -->
    <div class='container-fluid'>
	<div class='row'>
	    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' style='background-image: url(images/bg/footerBG.jpg); background-size:cover; background-position:center;'>
		<center><br><br>
		    <h1 class='headerText1'><?php echo $lang['joinUs']?></h1>
		    <br><br>
		</center>
	    </div>
	</div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
