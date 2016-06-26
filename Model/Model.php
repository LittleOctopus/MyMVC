<?php
	class Model{
		public $tb;
		public $offset;
		public $where;
		public $order;
		public $limit;
		public $pkfield;

		//$model->findbypk()

		function __construct($tb){
			$this->tb=$tb;
			$sql="desc ".$this->tb;
			$res=mysql_query($sql);
			while($obj=mysql_fetch_object($res)){
				if($obj->Key==PRI){
					$this->pkfield=$obj->Field;
				}
			}
		}
		function findall($arr=''){
			if($arr){
				$num=count($arr);
				$keys=array_keys($arr);
				$values=array_values($arr);
				for($i=0;$i<$num;$i++){
					switch ($keys[$i]) {
						case 'limit':
							$this->limit=$values[$i];
							break;
						case 'where':
							$this->where=$values[$i];
							break;
						case 'offset':
							$this->offset=$values[$i];
							break;
						case 'order':
							//$array=array("desc","asc","DESC","ASC");
							//in_array($values[$i], $array)?$this->order=$values[$i]:$this->order="asc";
							$this->order=$values[$i];
							break;
						default:
							break;
					}
				}
				$whe=isset($this->where)?"where ".$this->where:"";
				$ord=isset($this->order)?"order by ".$this->order:"";
				$off=isset($this->offset)?$this->offset:0;
				$lim=isset($this->limit)?"limit ".$off.",".$this->limit:"";
				$sql="select * from ".$this->tb." {$whe} {$ord} {$lim}";
			}else{
				$sql="select * from ".$this->tb;
			}
			$res=mysql_query($sql);
			$arr=array();
			while($obj=mysql_fetch_object($res)){
				$arr[]=$obj;
			}
			return $arr;
		}
		
		function findbypk($id){
			$sql="select * from ".$this->tb." where ".$this->pkfield."='{$id}'";
			$res=mysql_query($sql);
			$obj=mysql_fetch_object($res);
			return $obj;
		}
		function insert($arr){
			$keys=array_keys($arr);
			$values=array_values($arr);
			$count=count($arr);
			$keystr=implode(",",$keys);
			$valstr=implode("','", $values);
			$sql="insert into ".$this->tb."(".$keystr.") values('".$valstr."')";
			$res=mysql_query($sql);
			return mysql_affected_rows();
		}
		function delbypk($id){
			$sql="delete from ".$this->tb." where ".$this->pkfield."='{$id}'";
			$row=mysql_query($sql);
			return $row;
		}
		function delall($arr){
			$keys=array_keys($arr);
			$vals=array_values($arr);
			$count=count($arr);
			$array=array();
			for($i=0;$i<$count;$i++){
				$array[]=$keys[$i]."=".$vals[$i];
			}
			$array=implode(" and ", $array);
			$sql="delete from ".$this->tb." where ".$array;
			$succe=mysql_query($sql);
			return $succe;
		}
		function update($arr,$where){
			$keys=array_keys($arr);
			$vals=array_values($arr);
			$count=count($arr);
			$array=array();
			for($i=0;$i<$count;$i++){
				$array[]=$keys[$i]."='".$vals[$i]."'";
			}
			$array=implode(",",$array);
			$keys=array_keys($where);
			$vals=array_values($where);
			$count=count($where);
			for($i=0;$i<$count;$i++){
				$whe[]=$keys[$i]."=".$vals[$i];
			}
			$whe=implode(",",$whe);
			$sql="update ".$this->tb." set ".$array." where ".$whe;
			mysql_query($sql);
			return mysql_affected_rows();
		}
	}
?>