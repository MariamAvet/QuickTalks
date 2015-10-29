<?php
session_start();
//подключение конфигов
include("../include/stack.php");
$con = dataBase();
if(isset($_POST['register']) and isset($_POST['login']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['repassword'])){
    $login = $_POST['login'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $repass = $_POST['repassword'];
    $newUser = newUser($login,$email,$pass,$repass,$con);
    if($newUser == "true"){
	header("Location: ../index.php?registration=success");
	exit();
    }else{
	$error = $newUser;
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
    <title>Cake Group | О нас</title>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Стиль для страницы-->
    <link href="../style/index.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	@font-face {
    font-family: DecimaBold; /* Гарнитура шрифта */
    src: url(http://chat.self.ru/fonts/DecimaNovaPro/DecimaNovaPro-Bold.otf); /* Путь к файлу со шрифтом */
	}
	@font-face {
	font-family: Decima; /* Гарнитура шрифта */
    src: url(http://chat.self.ru/fonts/DecimaNovaPro/DecimaNovaProLt.otf); /* Путь к файлу со шрифтом */
	}
	h1 {
    font-family: DecimaBold, 'Comic Sans MS', cursive;
    }
	</style>
  
</head>
  
  <body>
  <?php echo menu("about");?>
	<div class='container-fluid'>
		<div class='col-lg-12 col-md-12' style='background-image: url(http://chat.self.ru/images/help/bg.jpg); background-size:cover; background-position:center;'>
			<div class='col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3'>
				<h1 style="text-align:center; padding: 33% 0% 33% 0%; font-style: italic; font-stretch: expanded; color: #ffffff; font-size:60pt; font-family:DecimaBold;">Немного о нашем детище=)</h1>
			</div>
		</div>
	</div>
	<div class='container-fluid'>
		<div class='row'>
			<h2 style='text-align:center; font-family:DecimaBold; font-size:30pt;'>Что такое QuickTalks?</h2>
		</div>
		<div class='row'>
			<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-3'>
				<img src='http://chat.self.ru/images/about/QT.jpg' width='100%'>
			</div>
			<div class='col-lg-5 col-md-5 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-3'>
			<br><br><br><br>
				<p style='text-align:center; font-family:Decima; font-size:16pt;'>
					<span style='color:red; font-size: 200%; position: relative; top: 5px;'>Q</span>uickTalks - простой web-чат, написанный группой из 4-х студентов, для Вас, друзья. Общайтесь, делитесь новостями, но не переходите границы цензуры :Р.  
				</p>
			</div>
		</div>
	</div>
	<div class='container-fluid'>
		<div class='row'>
			<h2 style='text-align:center; font-family:DecimaBold; font-size:30pt;'>Наша команда</h2>
		</div>
		<div class='row'>
			<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-3'>
				<img src='http://chat.self.ru/images/about/team.jpg' width='100%'>
			</div>
			<div class='col-lg-5 col-md-5 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-3'>
				<div id='a_k' style='text-align:center; font-family:Decima; font-size:24pt;'>Артем Квач
					<p style='text-align:center; font-family:Decima; font-size:18pt;'>IT директор</p>
					<p style='font-size:14pt;'>Позитив всегда с ним! Весельчак и крутой программист. Идея создания чата принадлежит именно этому креативному парню.</p>
				</div>
				<div id='d_k' style='text-align:center; font-family:Decima; font-size:24pt;'>Дарья Каратаева
					<p style='text-align:center; font-family:Decima; font-size:18pt;'>Бизнес директор</p>
					<p style='font-size:14pt;'>Наш мозг. Человек, который делает идеально все, за что не возьмется. Дарья очень творческий человек и потрясающий художник! Правила нашего чата написаны именно ею, не советуем пренебрегать ;)</p>
				</div>
				<div id='g_b' style='text-align:center; font-family:Decima; font-size:24pt;'>
					Георгий Большаков
					<p style='text-align:center; font-family:Decima; font-size:18pt;'>ART директор</p>
					<p style='font-size:14pt;'>Наш главный верстальщик (теперь вы знаете кого сажать на кол). Просто мультисторонний человек, чьи увлечения начинаются с простой игры на гитаре и заканчиваются всевозможными проетами с использованием семейчтва Adobe.</p>
				</div>
				<div id='m_a' style='text-align:center; font-family:Decima; font-size:24pt;'>
					Мариам Аветян
					<p style='text-align:center; font-family:Decima; font-size:18pt;'>Технический директор</p>
					<p style='font-size:14pt;'>Добрый и отзывчивый, всегда готовый помочь и просто хороший человек. На ее совести вункционирование нашего сайта (готовьте второй кол).</p>
				</div>
			</div>
			</div>
		</div>
	</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
