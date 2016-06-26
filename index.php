<?php
	require_once 'config/config.ini.php';
	require_once 'function/func.php';
	require_once 'Controller/Controller.php';
	require_once 'Model/Model.php';
	$controller=$_GET["c"]?$_GET["c"]:"index";
	$method=$_GET['m']?$_GET['m']:"index";
	C($controller,$method);
?>