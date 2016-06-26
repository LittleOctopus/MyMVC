<?php
	class indexController extends Controller{	//每个控制器都要继承总控制器
		function actionindex(){
			$fun_name=__FUNCTION__;	//每个调用视图的方法都要写
			$this->func=$fun_name;	//每个调用视图的方法都要写，传递该函数名，以自动定位同名视图
			$model=M("shop");
			$model->findbypk(1);
			$this->display();
		}
	}
?>