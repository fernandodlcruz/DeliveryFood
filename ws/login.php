<?php

require_once('inc\config.inc.php');
require_once('inc\DatabaseAgent.class.php');
require_once('inc\UserMapper.class.php');
require_once('inc\CuisineMapper.class.php');
require_once('inc\AddressMapper.class.php');
require_once('inc\MenuMapper.class.php');
require_once('inc\PlaceOrderMapper.class.php');


$um = new UserMapper;
//$um->getAllUsers();
$usertype = "B";
$users = $um->getAllUsersByType($usertype);
//var_dump($users);

$cm = new CuisineMapper;
$cuisines = $cm->getAllCuisines();
//var_dump($cuisines);

$am = new AddressMapper;
//$id = 1;
$id = 2;
$address = $am->getAddress($id);
//var_dump($address);

$mm = new MenuMapper;
//chinese restaurant
//$b_ID = 3;
//brazilian restaurant
$b_ID = 4;
$menu = $mm->getMenuByBusiness($b_ID);
//var_dump($menu);

$plm = new PlaceOrderMapper;
$orderID = 1;
$userID = 2;
$businessID = 4;
$order = $plm->getOrderByID($orderID);
$orderUser = $plm->getOrdersFromCustomer($userID);
$orderBusiness = $plm->getOrdersFromBusiness($businessID);
echo "Full unique order";
var_dump($order);
echo "All orders from a customer";
var_dump($orderUser);
echo "All orders from a business";
var_dump($orderBusiness);


$postdata = ['id' =>  0,
        'name' => "test name",
        'phone' => "977-554-3201",
        'email' => "test@test.com",
        'type' => "C",
        'passw' => "testPassword",
        'idCuisine' => null
        ];
$um->createUser($postdata);
$users = $um->getAllUsers();
var_dump($users);

?>