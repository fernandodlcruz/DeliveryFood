<?php
require_once('inc\config.inc.php');
require_once('inc\DatabaseAgent.class.php');
require_once('inc\UserMapper.class.php');

//if(isset($_GET['callback']) && isset($_GET['email']) && isset($_GET['pwd'])) {
if(isset($_GET['email']) && isset($_GET['pwd'])) {
        $um = new UserMapper;

        $user = $um->getUserByEmail($_GET['email']);

        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        
        if (!empty($user) && password_verify($_GET['pwd'], $user['Pwd'])) {
                $user['loggedIn'] = true;
                $user['Pwd'] = "";
                $jsonData = json_encode($user);
        } else {
                $user['loggedIn'] = false;
                $user['Pwd'] = "";
                $jsonData = json_encode($user);
        }
        
        //echo $_GET['callback']."($jsonData)";
        echo $jsonData;
}
?>