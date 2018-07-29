<?php
require_once('inc\config.inc.php');
require_once('inc\DatabaseAgent.class.php');
require_once('inc\AddressMapper.class.php');

if(isset($_GET['callback']) && isset($_GET['idUser'])&& !isset($_GET['line1']) && !isset($_GET['line2']) && !isset($_GET['city']) && !isset($_GET['stateProv']) && !isset($_GET['postalCode'])) {
        $am = new AddressMapper;

        $address = $am->getAddressByUserId($_GET['idUser']);

        $jsonData = json_encode($address);
        
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo $_GET['callback']."($jsonData)";
} else if(isset($_GET['callback']) && isset($_GET['line1']) && isset($_GET['line2']) && isset($_GET['city']) && isset($_GET['stateProv']) && isset($_GET['postalCode']) && isset($_GET['idUser'])) {
        $postdata = ['Line1' => $_GET['line1'],
                        'Line2' => $_GET['line2'],
                        'City' => $_GET['city'],
                        'StateProvince' => $_GET['stateProv'],
                        'PostalCode' => $_GET['postalCode'],
                        'idUser' => $_GET['idUser']
        ];

        $am = new AddressMapper;
        $postdata['id'] = $am->createAddress($postdata);

        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');

        $jsonData = json_encode($postdata);
        
        echo $_GET['callback']."($jsonData)";
}
?>