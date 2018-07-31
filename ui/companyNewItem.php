<?php
require_once('inc/config.inc.php');
require_once('inc/Page.class.php');
require_once('inc/NewItemPage.class.php');


NewItemPage::$title = "Delivery Food Final Project";
NewItemPage::header();
NewItemPage::navbar();
NewItemPage::showNewItemForm();
NewItemPage::createModal();
NewItemPage::jsBundle();
NewItemPage::footer();
?>