<?php
session_start();
//Подключение конфигов 
include("../include/stack.php");
$con = dataBase();
//данные для доступа к API
$client_id = '5108363'; // ID приложения
$client_secret = '4Hr4peFt6uQXME6XizOX'; // Защищённый ключ
$redirect_uri = 'http://chat.self.ru/auth/vkontakte.php'; // Адрес сайта

if(isset($_POST['vauth'])){
    $url = 'http://oauth.vk.com/authorize';
    $params = array(
	'client_id'     => $client_id,
	'redirect_uri'  => $redirect_uri,
	'response_type' => 'code'
    );
    header('Location: ' . $url . '?' . urldecode(http_build_query($params)) . ''); 
    exit; 
}
if (isset($_GET['code'])) {
    $result = false;
    $params = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'redirect_uri' => $redirect_uri
    );
$token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        $params = array(
            'uids'         => $token['user_id'],
            'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
            'access_token' => $token['access_token']
        );

        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['uid'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
        }
    }
if ($result) {
$login = formChars($userInfo['uid']);
$pass = formChars($userInfo['uid']);
$repass = formChars($userInfo['uid']);
$id = userLogin($login,$pass,$con);
if($id == false) newUser($login,"",$pass,$repass,"vkontakte",$userInfo['first_name'],"",$userInfo['photo_bit'],$con);
$id = userLogin($login,$pass,$con);
usersLog($id,"Пользователь успешно авторизовался и вошел в сеть",$con);
$_SESSION['idUser'] = $id;
header("Location: ../pages/profile.php");
exit();
                                        
/*
        echo "Социальный ID пользователя: " . $userInfo['uid'] . '<br />';
        echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
        echo "Ссылка на профиль пользователя: " . $userInfo['screen_name'] . '<br />';
        echo "Пол пользователя: " . $userInfo['sex'] . '<br />';
        echo "День Рождения: " . $userInfo['bdate'] . '<br />';
        echo '<img src="' . $userInfo['photo_big'] . '" />'; echo "<br />";*/
    }
}
?>