<?php
require_once('inc\config.inc.php');
require_once('inc\DatabaseAgent.class.php');
require_once('inc\UserMapper.class.php');

if(isset($_GET['callback']) && isset($_GET['email']) && isset($_GET['pwd'])) {
        $um = new UserMapper;

        $user = $um->getUserByEmail($_GET['email']);

        $user['loggedIn'] = (!empty($user) && password_verify($_GET['pwd'], $user['Pwd']));
        $user['Pwd'] = "";

        $jsonData = json_encode($user);
        
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo $_GET['callback']."($jsonData)";
} else {
        $um = new UserMapper;

        $user = $um->getUserByEmail($_GET['email']);

        $user['loggedIn'] = (!empty($user) && password_verify($_GET['pwd'], $user['Pwd']));
        $user['Pwd'] = "";

        $jsonData = json_encode($user);
        
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo $jsonData;
}
?>