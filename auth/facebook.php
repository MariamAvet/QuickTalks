<?php
session_start();
//Подключение конфигов
include("../include/stack.php");
$con = dataBase();
//объявление данных об API
$client_id = '469804493207049'; // Client ID
$client_secret = '0b1052e817aa95fcf6728c2a8524557f'; // Client secret
$redirect_uri = 'http://chat.self.ru/auth/facebook.php'; // Redirect URIs

if(isset($_POST['fauth'])){
    //адрес аутентификации и специальные параметры:
    $url = 'https://www.facebook.com/dialog/oauth';
    $params = array(
	'client_id'     => $client_id,
	'redirect_uri'  => $redirect_uri,
	'response_type' => 'code',
	'scope'         => 'email,user_birthday'
    );
    //генерируем ссылку и выводим на экран:
    header('Location: ' . $url . '?' . urldecode(http_build_query($params)) . ''); 
    exit; 
}
// процедуру аутентификации мы можем в том случае, если к нам пришёл параметр code.
if (isset($_GET['code'])) {
    $result = false;
    $params = array(
        'client_id'     => $client_id,
        'redirect_uri'  => $redirect_uri,
        'client_secret' => $client_secret,
        'code'          => $_GET['code']
    );
    $url = 'https://graph.facebook.com/oauth/access_token';
}
//Для того чтобы распарсить данный ответ, воспользуемся функцией parse_str, а результат (в виде массива) запишем в переменную $tokenInfo:
$tokenInfo = null;
parse_str(file_get_contents($url . '?' . http_build_query($params)), $tokenInfo);

//Получение информации о пользователе
if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
    $params = array('access_token' => $tokenInfo['access_token']);
    $userInfo = json_decode(file_get_contents('https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params))), true);
    if (isset($userInfo['id'])) {
        $userInfo = $userInfo;
        $result = true;
    }
 }
//Показ данных пользователя 
if ($result) {
    $login = formChars($userInfo['id']);
    $pass = formChars($userInfo['id']);
    $repass = formChars($userInfo['id']);
    $id = userLogin($login,$pass,$con);
    if($id == false) newUser($login,"",$pass,$repass,"facebook",$userInfo['name'],"","http://graph.facebook.com/". $userInfo['id']."/picture?type=large",$con);
	$id = userLogin($login,$pass,$con);
	usersLog($id,"Пользователь успешно авторизовался и вошел в сеть",$con);
	$_SESSION['idUser'] = $id;
	header("Location: ../pages/profile.php");
	exit();

}
?>