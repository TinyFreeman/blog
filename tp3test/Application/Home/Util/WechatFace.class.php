<?php
namespace Home\Util;
 
class WechatFace{
	private static $instance;
	
	public static function __callStatic($name, $arguments){
		if($name == 'getWechat'){
			if(empty(self::$instance)){
				self::$instance = new Wechat();
			}
			return self::$instance;
		}
	}
}