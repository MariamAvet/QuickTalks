<?php
include("setting.php");

//формируем главное меню
function menu($active){
    $classActive = "id=\"active-menu\"";
    $class = "id=\"menu\"";
    $about = $class; $document = $class; $help = $class;
    switch($active){
	case 'about':
	    $about = $classActive;
	    break;
	case 'document':
	    $document = $classActive;
	    break;
	case 'help':
	    $help = $classActive;
	    break;
    }
    $menu = '
    <nav class="navbar navbar-default" style="margin-bottom:0px;">
	<div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
    		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
    		    <span class="sr-only">Toggle navigation</span>
    		    <span class="icon-bar"></span>
    		    <span class="icon-bar"></span>
    		    <span class="icon-bar"></span>
    		</button>
    		<a class="navbar-brand" href="#" style="padding:0px 0px 0px 15px;"><img src="http://chat.self.ru/images/logo.png" width="50px" height="50px"></a>
	    </div>
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    		<ul class="nav navbar-nav">
    		</ul>
    		<ul class="nav navbar-nav navbar-right">
    		    <li><a href="/pages/about.php" '.$about.'>О нас</a></li>
    		    <li><a href="#" '.$document.'>Документы</a></li>
    		    <li><a href="/pages/help.php" '.$help.'>Помощь</a></li>
    		</ul>
	    </div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
    </nav>';
    return $menu;
}

//Защищаем информацию от кода и тд.
function formChars($string){
    return nl2br(htmlspecialchars(trim($string), ENT_QUOTES), false);
}

//Подключение к БД
function dataBase(){
    $con = mysqli_connect(HOST, USER, PASS, DB) or die("Ошибка подключения к БД: ".mysql_error());
    mysqli_query($con, "SET NAMES UTF8");
    mysqli_query($con, "SET CHARACTER SET UTF8");
    return $con;
}

//Функция шифрования данных
function getCript($str){
    return md5("QuickMessage".md5("MARIAM".$str."GEORGIY").md5("DARIA".$str."ARTYOM"));
}

//Запрос данных из базы о пользователе
function userLogin($login,$pass,$con){
    $login = formChars($login);
    $pass = getCript(formChars($pass));
    $query = mysqli_query($con,"SELECT * FROM users WHERE login='".$login."' AND password='".$pass."'");
    if(mysqli_num_rows($query) == 1){
	$res = mysqli_fetch_assoc($query);
	$id = $res['id'];
    }else{
	$id = false;
    }
    return $id;
}

//Проверка, занят ли такой логин
function checkUser($login,$email,$con){
    $login = formChars($login);
    $email = formChars($email);
    $query = mysqli_query($con,"SELECT * FROM users WHERE login='".$login."'");
    $Query = mysqli_query($con,"SELECT * FROM users WHERE email='".$email."' and email<>''");
    if(mysqli_num_rows($query) == 1 or mysqli_num_rows($Query) ==  1) $id = true;
    else $id = false;
    return $id;
}

//регистрация нового пользователя
function newUser($login,$email,$pass,$repass,$regType,$firstname,$lastname,$avatar,$con){
    $login = formChars($login);
    $email = formChars($email);
    $pass = getCript(formChars($pass));
    $repass = getCript(formChars($repass));
    $regType = formChars($regType);
    $firstname = formChars($firstname);
    $lastname = formChars($lastname);
    if($pass == $repass){
	$id = checkUser($login,$email,$con);
	if($id == false){
	    mysqli_query($con,"INSERT INTO users (login,password,email,regDate,regType,lang,templateId,firstname,lastname,avatar) 
	    VALUES (
	    '".$login."',
	    '".$pass."',
	    '".$email."',
	    '".date('Y-m-d H:i:s')."',
	    '".$regType."',
	    'RU',
	    '1',
	    '".$firstname."',
	    '".$lastname."',
	    '".$avatar."')");
	    $result = "true";
	}else{
	    $result = "<div class='alert alert-danger'>Ошибка. Пользователь с таким логином/email уже зарегистрирован в системе. Пожалуйста, повторите попытку</div>";
	}
    }else{
	$result = "<div class='alert alert-danger'>Ошибка. Введенные пароли не совпадают</div>";
    }
    return $result;
}

//получение информации о конкретном пользователе
function userInfo($id,$con){
    $id = formChars($id);
    $query = mysqli_query($con,"SELECT * FROM users WHERE id='".$id."'");
    $res = mysqli_fetch_assoc($query);
    return $res;
}

//Функция логирования действий пользователя
function usersLog($id,$action,$con){
    $id = formChars($id);
    $action = formChars($action);
    $date = date("Y-m-d H:i:s");
    mysqli_query($con,"INSERT INTO usersLog (idUser,action,date) VALUES ('".$id."','".$action."','".$date."')");
    return true;
}
?>
