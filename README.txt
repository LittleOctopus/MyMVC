1.文件目录结构：
2.风格：个人更喜欢thinkphp框架的简洁和方便，也同样喜欢yii框架小物件的强大，所以后期会倾向于整合二者框架的优点，做适合自己的框架。用面向对象的oop编写。
3.单入口——index.php
	所有路径皆走index.php这个但路口，路由命名规范：
	index.php?c=xxx&m=xxx
	表示去xxx控制器中的xxx方法。
4. 配置文件：
	config/config.ini.php
	在这里配置数据库等相关数据。
5.控制器——controller
  ·总控制器：Controller/Controller.php
  ·分控制器命名规范：xxxController.php
  ·在分控制器php内，需要继承总控（extends Controller），然后自定义方法。
  ·分控制器内方法命名规范：
  	function actionxxx(){
  		$fun_name=__FUNCTION__;		//每个调用视图的方法都要写
			$this->func=$fun_name;	//每个调用视图的方法都要写，传递该函数名，以自动定位同名视图
  	}
6.模型——Model
  ·$model=M($table_name) 来new一个表名为$table_name的对象
  ·$model->  来调用方法
  ·目前模型支持的方法仅有单表查询，寒假及后期将继续完善多表查询，现有方法如下：
	$model->findall(				//按条件查询,返回一条记录
		array(
			"limit"=>2,
			"offset"=>3,
			"order"=>"shop_id desc"
		)
	);
	$model->findbypk(16);			//按主键查询，返回一条记录
	$model->insert(					//插入数据
		array(
			"num"=>5,
			"goods_id"=>3,
			"username"=>555
		)
	);
	$model->delbypk(22);			//按主键删除一条数据
	$model->delall(					//按条件删除所有数据
		array(
			"goods_id"=>2,
			"username"=>"111"
		)
	);
	$num=$model->update( 			//更新数据，参数一：更新的内容；参数二：更新条件
		array(
			"num"=>"10",
			"username"=>"yu"
		),
		array(
			"shop_id"=>30,
		)
	);
7. 视图——View
	·为了前期方便起见，我引入了smarty模板引擎，所以所有语法结构按smarty官方走。
	 只要在controller中用 display();即可加载相应视图，以及扔数据到模板上。
	 display() 函数无参时，默认加载和控制器方法同名的视图。
	 display("index",array("title"=>"第一章"))  表示加载index.tmp模板，并传递"title"参数。
	·前台接收：遵循smarty官方语法，<{$title}>即可，修改配置文件请到 libs/smarty中修改