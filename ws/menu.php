<?php
require_once('inc\config.inc.php');
require_once('inc\DatabaseAgent.class.php');
require_once('inc\MenuMapper.class.php');

if(isset($_GET['callback']) && isset($_GET['companyId'])) {
        $mm = new MenuMapper;

        $menu = $mm->getMenuByBusiness($_GET['companyId']);

        $jsonData = json_encode($menu);
        
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo $_GET['callback']."($jsonData)";
} else if(isset($_GET['callback']) && isset($_GET['ids'])) {
        $mm = new MenuMapper;

        $menu = $mm->getMenuByIds(array($_GET['ids']));

        $jsonData = json_encode($menu);
        
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo $_GET['callback']."($jsonData)";
}
?>