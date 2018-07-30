<?php
require_once('inc/config.inc.php');
require_once('inc/Page.class.php');
require_once('inc/BusinessPage.class.php');

BusinessPage::$title = "Delivery Food Final Project";
BusinessPage::header();
BusinessPage::navbar();

//$_SESSION['testID'] = "4";
var_dump($_SESSION);
BusinessPage::showAllOrders();
BusinessPage::showMenu();
BusinessPage::jsBundle();
BusinessPage::footer();
?>