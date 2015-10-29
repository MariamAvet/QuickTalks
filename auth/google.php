<?php
session_start();
//Подключение конфигов 
include("../include/stack.php");
$con = dataBase();
$client_id = '182402318523-tr5p6982fcvnmch50jghlsp0nmoicfb6.apps.googleusercontent.com'; // Client ID
$client_secret = '6Etfo1bKHNrenPxaYSCCWhlF'; // Client secret
$redirect_uri = 'http://chat.self.ru/auth/google.php'; // Redirect URIs

if(isset($_POST['gauth'])){
    $url = 'https://accounts.google.com/o/oauth2/auth';
    $params = array(
	'redirect_uri'  => $redirect_uri,
	'response_type' => 'code',
	'client_id'     => $client_id,
	'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
    );
    header('Location: ' . $url . '?' . urldecode(http_build_query($params)) . ''); 
    exit;
}
if (isset($_GET['code'])) {
    $result = false;

    $params = array(
        'client_id'     => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri'  => $redirect_uri,
        'grant_type'    => 'authorization_code',
        'code'          => $_GET['code']
    );

    $url = 'https://accounts.google.com/o/oauth2/token';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $tokenInfo = json_decode($result, true);

    if (isset($tokenInfo['access_token'])) {
        $params['access_token'] = $tokenInfo['access_token'];

        $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['id'])) {
            $userInfo = $userInfo;
            $result = true;
        }
    }
}

if ($result) {
     $login = formChars($userInfo['id']);
     $pass = formChars($userInfo['id']);
     $repass = formChars($userInfo['id']);
     $id = userLogin($login,$pass,$con);
     if($id == false) newUser($login,$userInfo['email'],$pass,$repass,"google",$userInfo['name'],"",$userInfo['picture'],$con);
    $id = userLogin($login,$pass,$con);
    usersLog($id,"Пользователь успешно авторизовался и вошел в сеть",$con);
    $_SESSION['idUser'] = $id;
    header("Location: ../pages/profile.php");
    exit();
}

?>