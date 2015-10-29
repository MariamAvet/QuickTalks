<?php
session_start();
//подключение конфигов
include("../include/stack.php");
$con = dataBase();
if(isset($_POST['exit'])){
    usersLog($_SESSION['idUser'],"Пользователь успешно вышел из сети",$con);
    unset($_SESSION['idUser']);
}
$id = $_SESSION['idUser'];
if(empty($id)){
    header("Location: ../index.php");
    exit();
}
$userInfo = userInfo($id,$con);
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cake Group | Ваш профиль, <?php echo $userInfo['login']?></title>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Стиль для страницы-->
    <link href="style/index.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body >
    <center><h1 >Добро пожаловать на Cake Group</h1></center>
    <div class='container'>
	<div class='row'>
	    <div class='col-lg-12 col-md-12'>
		Ваш логин: <?php echo $userInfo['login']?><br>
		Ваш email: <?php echo $userInfo['email']?><br>
		Дата регистрации: <?php echo $userInfo['regDate']?><br>
		<form method='post'>
                    <button style='width:100%;' type="submit" class="btn btn-danger" name='exit'>Выйти</button>
                </form>
		
	    </div>
	</div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
