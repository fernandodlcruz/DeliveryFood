<?php
session_start();

require_once('inc/Page.class.php');

Page::$title = "Delivery Food Final Project";
Page::header();
Page::navbar();
Page::showLogin();
Page::jsBundle();
Page::footer();
?>