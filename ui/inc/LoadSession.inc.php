<?php
session_start();
$_SESSION['user'] = (array)json_decode(file_get_contents('php://input'));
?>