<?php
	require_once 'define.php';
	header("content-type:text/html;charset=utf-8");
	mysql_connect(HOST,USER,PASS);
	mysql_select_db("");
	mysql_query("set names utf8");
?>