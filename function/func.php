<?php
	function C($c,$m){
		$controller=$c;
		$method=$m;
		require_once "Controller/{$controller}Controller.php";
		$controller=$controller."Controller";
		$method="action".$m;
		$con=new $controller();
		$con->$method();
	}
	function M($tb){
		$model=new Model($tb);
		return $model;
	}
?>