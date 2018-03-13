<?php

namespace Home\Lib\Pay;

//支付公共类
class PublicOperate {	
	
	
	public static function run_hook($order_num){
		$PAY_END_HOOK = C('PAY_END_HOOK');
		
		$m = D('OrderNum');
		$order_info = $m->get_order_info_2($order_num);
		$hook = $PAY_END_HOOK[1];	
		if($hook){
			$arr = explode(":",$hook);
			$contoller = '\\Home\\Controller\\' . $arr[0] . 'Controller';
			$func = $arr[1];
		}
		$obj = new $contoller;
		$obj->$func($order_num);
	}
	
	public function put_log($msg){
		if(is_array($msg)){
			$msg = var_export($msg, true);
		}
		file_put_contents(__DIR__.'/log', $msg,FILE_APPEND);
	}
	
}