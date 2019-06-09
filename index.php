<?php
error_reporting(E_ALL); // or E_STRICT
ini_set("display_errors",1);
ini_set("memory_limit","1024M");


defined('ROOT') || define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once('class/index.php');
require_once('class/view.php');
$index = new index();
$index->route();