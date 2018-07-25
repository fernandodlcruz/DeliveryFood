<?php
require_once('inc\config.inc.php');
require_once('inc\DatabaseAgent.class.php');
require_once('inc\UserMapper.class.php');

//if(isset($_GET['callback']) && isset($_GET['email']) && isset($_GET['pwd'])) {
if(isset($_GET['email']) && isset($_GET['pwd'])) {
        $um = new UserMapper;

        $postdata = ['name' => $_GET['name'],
                'phone' => $_GET['phone'],
                'email' => $_GET['email'],
                'type' => $_GET['userType'],
                'passw' => $_GET['pwd'],
                'idCuisine' => $_GET['idCuisine']
                ];
        $um->createUser($postdata);

        $postdata['id'] = $um->lastInsertId();
        $postdata['loggedIn'] = true;
        $user['Pwd'] = "";

        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');

        $jsonData = json_encode($user);
        
        //echo $_GET['callback']."($jsonData)";
        echo $jsonData;
}
?>