<?php
require_once('inc\config.inc.php');
require_once('inc\DatabaseAgent.class.php');
require_once('inc\CuisineMapper.class.php');

if(isset($_GET['callback'])) {
    $cm = new CuisineMapper;
    $cuisines = $cm->getAllCuisines();

    header('Content-type: application/json');
    header('Access-Control-Allow-Origin: *');

    $jsonData = json_encode($cuisines);
    
    echo $_GET['callback']."($jsonData)";
}
?>