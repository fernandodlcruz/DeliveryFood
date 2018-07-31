<?php
require_once('inc\config.inc.php');
require_once('inc\DatabaseAgent.class.php');
require_once('inc\MenuMapper.class.php');

if(isset($_GET['callback']) && isset($_GET['companyId']) && isset($_GET['name'])) {
        $mm = new MenuMapper;
        $item = ['name' => $_GET['name'],
        'description' => $_GET['description'],
        'unit' => $_GET['unit'],
        'price' => $_GET['price'],
        'companyId' => $_GET['companyId']
        ];

        $menu = $mm->createItem($item);

        $jsonData = json_encode($menu);
        
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo $_GET['callback']."($jsonData)";
} else if(isset($_GET['callback']) && isset($_GET['companyId']) && isset($_GET['name']) && isset($_GET['updateId'])) { // Update an menu item
        $mm = new MenuMapper;
        $item = ['name' => $_GET['name'],
        'description' => $_GET['description'],
        'unit' => $_GET['unit'],
        'price' => $_GET['price'],
        'companyId' => $_GET['companyId'],
        'id' => $_GET['updateId']
        ];

        $menu = $mm->updateItem($item);

        $jsonData = json_encode($menu);
        
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo $_GET['callback']."($jsonData)";
}else if(isset($_GET['callback']) && isset($_GET['companyId'])) {
        $mm = new MenuMapper;

        $menu = $mm->getMenuByBusiness($_GET['companyId']);

        $jsonData = json_encode($menu);
        
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo $_GET['callback']."($jsonData)";
} else if(isset($_GET['callback']) && isset($_GET['ids'])) { // Get one or more items by an ARRAY of ids
        $mm = new MenuMapper;

        $menu = $mm->getMenuByIds($_GET['ids']);

        $jsonData = json_encode($menu);
        
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo $_GET['callback']."($jsonData)";
} else if(isset($_GET['callback']) && isset($_GET['idMenu'])) { // Get an specific item by ONE id
        $mm = new MenuMapper;

        $menu = $mm->getMenuById($_GET['idMenu']);

        $jsonData = json_encode($menu);
        
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo $_GET['callback']."($jsonData)";
} else if(isset($_GET['callback']) && isset($_GET['deleteId'])) {
        $mm = new MenuMapper;

        $menu = $mm->deleteItem($_GET['deleteId']);
        $menu = ['deletedId' => $menu];

        $jsonData = json_encode($menu);
        
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo $_GET['callback']."($jsonData)";
}
?>