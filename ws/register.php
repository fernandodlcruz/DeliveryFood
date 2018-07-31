<?php
require_once('inc\config.inc.php');
require_once('inc\DatabaseAgent.class.php');
require_once('inc\UserMapper.class.php');

if(isset($_GET['callback']) && isset($_GET['email']) && isset($_GET['pwd']) && isset($_GET['userType'])) {
        $um = new UserMapper;

        if (isset($_GET['idCuisine']) && !empty($_GET['idCuisine'])) {
                $postdata = ['Name' => $_GET['name'],
                        'PhoneNumber' => $_GET['phone'],
                        'Email' => $_GET['email'],
                        'UserType' => $_GET['userType'],
                        'Pwd' => password_hash($_GET['pwd'], PASSWORD_DEFAULT),
                        'idCuisine' => $_GET['idCuisine']
                ];
        } else {
                $postdata = ['Name' => $_GET['name'],
                        'PhoneNumber' => $_GET['phone'],
                        'Email' => $_GET['email'],
                        'UserType' => $_GET['userType'],
                        'Pwd' => password_hash($_GET['pwd'], PASSWORD_DEFAULT)
                ];
        }
        
        $postdata['idUser'] = $um->createUser($postdata);
        $postdata['loggedIn'] = true;
        $postdata['Pwd'] = "";

        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');

        $jsonData = json_encode($postdata);
        
        echo $_GET['callback']."($jsonData)";
}
?>