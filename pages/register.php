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
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $newUser = newUser($login,$email,$pass,$repass,"registration",$firstname,$lastname,"",$con);
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
    <title>Cake Group | Регистрация</title>

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
  <nav class="navbar navbar-default" style='margin-bottom:-20px;'>
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">О нас</a></li>
        <li><a href="#">Документы</a></li>
        <li><a href="http://chat.self.ru/pages/help.php">Помощь</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> 
	<form method='post' class='form-inline'>
    <div class='container'>
	<div class='row'>
	    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
	    <?php echo $error;?>
		<div class='row'>
		    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
			    <h2>Регистрация</h2>
				<div class="form-group">
					<input name='firstname' type="text" class="form-control" placeholder="Имя" required>
			    </div>
				<div class="form-group">
					<input name='lastname' type="text" class="form-control" placeholder="Фамилия" required>
				</div>
				<br>
				<div class="form-group">
					<input name='login' size='15%' type="text" class="form-control" placeholder="Логин" required>
					<input name='email'  size='25%' type="email" class="form-control" placeholder="Email" required>
				</div><br>
			    <div class="form-group">
					<input name='password' type="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль" required>
			    </div>
			    <div class="form-group">
					<input name='repassword' type="password" class="form-control" id="exampleInputPassword1" placeholder="Повторите пароль" required>
			    </div><br>
				<div class="form-group">
					<input type='checkbox' required name='terms' class='form-control'><a href='#'>Пользовательское соглашение</a>
				</div><br>
				<div class="form-group">
					<input type='checkbox' required name='conf' class='form-control'><a href='#'>Политика конфиденциальности</a>
				</div>
			</div>
		    </div>
			<center>
				    <button  type="submit" class="btn btn-success" name='register'>Регистрация</button>
		</div>
		<br>
	    </div>
	</div>
	</form>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
