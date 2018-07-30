<?php
require_once('inc/config.inc.php');
require_once('inc/Page.class.php');
require_once('inc/BusinessPage.class.php');


BusinessPage::$title = "Delivery Food Final Project";
BusinessPage::header();
BusinessPage::navbar();

BusinessPage::showAllOrders();
BusinessPage::showMenu();
BusinessPage::jsBundle();

BusinessPage::footer();
?>