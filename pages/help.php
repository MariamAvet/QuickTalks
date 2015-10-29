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
    <title>Cake Group | Помощь</title>

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
	
	.button{text-decoration:none; text-align:center; 
	 padding:9px 39px; 
	 border:solid 1px #eec671; 
	 -webkit-border-radius:7px;
	 -moz-border-radius:7px; 
	 border-radius: 7px; 
	 font:16px Decima, Helvetica, sans-serif; 
	 font-weight:bold; 
	 color:#eec671; 
	 background:#ffffff;
	}
	
	.button:hover{
	 padding:9px 39px; 
	 border:solid 1px #eec671; 
	 -webkit-border-radius:4px;
	 -moz-border-radius:4px; 
	 border-radius: 4px; 
	 font:16px Decima, Helvetica, sans-serif; 
	 font-weight:bold; 
	 color:#eec671; 
	 background:#ffffff;  
	}
	 .button:active{
	 padding:9px 39px; 
	 border:solid 1px #ffffff; 
	 -webkit-border-radius:7px;
	 -moz-border-radius:7px; 
	 border-radius: 7px; 
	 font:16px Decima, Helvetica, sans-serif; 
	 font-weight:bold; 
	 color:#ffffff; 
	 background:#eec671;
	}
	</style>
  
</head>
  
  <body>
  <?php echo menu("help");?>
	<div class='col-lg-12 col-md-12' style='background-image: url(http://chat.self.ru/images/help/bg.jpg); background-size:cover; background-position:center;'>
		<div class='col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3'>
		<h1 style="text-align:center; padding: 33% 0% 33% 0%; font-style: italic; font-stretch: expanded; color: #ffffff; font-size:60pt; font-family:DecimaBold;">Часто задаваемые вопросы!</h1>
		</div>
	</div>
	<div><br></div>
	<div class='row'>
		<div class='col-lg-3 col-md-3 col-sm-6 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-3'>
			<div class='col-lg-12 col-md-12 col-lg-offset-4 col-md-offset-4'>
				<br><br><br><img src='http://chat.self.ru/images/help/ic.png' width='25%'>
			</div>
			<br><p style='text-align:center; font-family:DecimaBold; font-size:15pt;'>Что нужно для регистрации?</p>
			<p style='text-align:center; font-family:Decima; font-size:14pt;'>Для регистрации вам понадобится электронная почта или профиль в одной из социальных сетей: ВКонтакте, Facebook, Google+</p>
		</div>
		<div class='col-lg-3 col-md-3 col-sm-6 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-3'>
			<div class='col-lg-12 col-md-12 col-lg-offset-4 col-md-offset-4'>
				<br><br><br><img src='http://chat.self.ru/images/help/ic.png' width='25%'>
			</div>
			<br><p style='text-align:center; font-family:DecimaBold; font-size:15pt;'>Я забыл(а) пароль, как мне быть?</p>
			<p style='text-align:center; font-family:Decima; font-size:14pt;'>Вы можете восстановить пароль на адрес электронной почты, который указали при регистрации</p>
		</div>
	</div>
		<div class='row'>
		<div class='col-lg-3 col-md-3 col-sm-6 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-3'>
			<div class='col-lg-12 col-md-12 col-lg-offset-4 col-md-offset-4'>
				<br><br><br><img src='http://chat.self.ru/images/help/ic.png' width='25%'>
			</div>
			<br><p style='text-align:center; font-family:DecimaBold; font-size:15pt;'>Как создать свой чат?</p>
			<p style='text-align:center; font-family:Decima; font-size:14pt;'>Необходимо нажать на кнопку "Создать чат" и выбрать жрузей из списка</p>
		</div>
		<div class='col-lg-3 col-md-3 col-sm-6 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-3'>
			<div class='col-lg-12 col-md-12 col-lg-offset-4 col-md-offset-4'>
				<br><br><br><img src='http://chat.self.ru/images/help/ic.png' width='25%'>
			</div>
			<br><p style='text-align:center; font-family:DecimaBold; font-size:15pt;'>Как написать личное сообщение?</p>
			<p style='text-align:center; font-family:Decima; font-size:14pt;'>Необходимо зайти в профиль друга и нажать на кнопку "Личное сообщение"</p>
		</div>
	</div>
	<div class='row'>
		<div class='col-lg-3 col-md-3 col-sm-6 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-3'>
			<div class='col-lg-12 col-md-12 col-lg-offset-4 col-md-offset-4'>
				<br><br><br><img src='http://chat.self.ru/images/help/ic.png' width='25%'>
			</div>
			<br><p style='text-align:center; font-family:DecimaBold; font-size:15pt;'>Я загрузил(а) новую аватарку, захожу на страницу, а она не обновилась. Почему?</p>
			<p style='text-align:center; font-family:Decima; font-size:14pt;'>На самом деле, она обновилась. Просто вы видите старый аватар, который сохранён в кэше браузера.
Скорее всего, вам поможет нажатие клавиш CTRL+F5 на своей странице</p>
		</div>
		<div class='col-lg-3 col-md-3 col-sm-6 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-3'>
			<div class='col-lg-12 col-md-12 col-lg-offset-4 col-md-offset-4'>
				<br><br><br><img src='http://chat.self.ru/images/help/ic.png' width='25%'>
			</div>
			<br><p style='text-align:center; font-family:DecimaBold; font-size:15pt;'>Как удалить свой профиль?</p>
			<p style='text-align:center; font-family:Decima; font-size:14pt;'>В настройках профиля нажмите кнопку "Удаление профиля"</p>
		</div>
	</div>
	<div class='row'>
		<div class='col-lg-9 col-md-9 col-sm-9 col-xs-9 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-offset-2'>
			<br><br><br><br><h1>Вы можете задать свой вопрос</h1>
		</div>
	</div>
	<form method='post'>
		<div class='row'>
			<div class='col-lg-3 col-md-3 col-sm-5 col-xs-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-offset-2'>
				<div class="form-group">
					<input name='name' type="text" class="form-control" placeholder="Имя" required>
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-lg-4 col-md-4 col-sm-6 col-xs-7 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-offset-2'>
				<div class="form-group">
					<input name='email' type="email" class="form-control" placeholder="Адрес эл. почты" required>
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-lg-6 col-md-6 col-sm-8 col-xs-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-offset-2'>
				<div class="form-group">
					<input name='question' type="text" class="form-control" placeholder="Вопрос" required>
				</div>
			</div>
		</div>
		<div class='row'>
		<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-xs-offset-5'>
		<button type="submit" class="button" name='enter'>Отправить</button>
		</div>
		</div>
	</form><br>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
