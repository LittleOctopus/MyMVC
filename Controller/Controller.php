<?php
	class Controller{
		public $func;
		public $viewname;
		function display($viewname="",$arr=""){
			$this->viewname=$viewname?$viewname:substr($this->func,6);
			include_once 'libs/smarty/Smarty.class.php';
			$smarty=new Smarty();
			if($arr){
				$keys=array_keys($arr);
				$values=array_values($arr);
				$count=count($arr);
				for($i=0;$i<$count;$i++){
					$tmp_name=$keys[$i];
					$tmp_value=$values[$i];
					$smarty->assign($tmp_name,$tmp_value);
				}
			}
			$smarty->display($this->viewname."View.tmp");
		}
	}
?>