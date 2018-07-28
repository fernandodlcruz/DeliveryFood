<?php
require_once('inc/config.inc.php');
require_once('inc/Page.class.php');

Page::$title = "Delivery Food Final Project";
Page::header();
Page::navbar();

var_dump($_SESSION['user']);

Page::footer();
?>