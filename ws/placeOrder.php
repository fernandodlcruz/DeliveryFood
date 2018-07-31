<?php
require_once('inc\config.inc.php');
require_once('inc\DatabaseAgent.class.php');
require_once('inc\PlaceOrderMapper.class.php');

if(isset($_GET['callback']) && isset($_GET['companyId']) && isset($_GET['userId']) && isset($_GET['menuId']) && isset($_GET['quantity']) && isset($_GET['totalPrice']) && isset($_GET['addressId'])) {
        $postdata = ['companyId' => $_GET['companyId'],
                        'userId' => $_GET['userId'],
                        'menuId' => $_GET['menuId'],
                        'addressId' => $_GET['addressId'],
                        'quantity' => $_GET['quantity'],
                        'totalPrice' => $_GET['totalPrice']
        ];

        $pom = new PlaceOrderMapper;
        $postdata['id'] = $pom->createOrder($postdata);

        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');

        $jsonData = json_encode($postdata);
        
        echo $_GET['callback']."($jsonData)";
}else if(isset($_GET['callback']) && isset($_GET['companyId'])) {
        $pom = new PlaceOrderMapper;

        $orders = $pom->getOrdersFromBusiness($_GET['companyId']);

        $jsonData = json_encode($orders);
        
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo $_GET['callback']."($jsonData)";
}

?>