<?php
namespace Adminyhgl\Model;
use Think\Model;
 
class AdminTModel extends Model{

	public function nextId(){
		$r = $this->query("select auto_increment from information_schema.`TABLES` where TABLE_NAME='__PREFIX__admin_t' order by auto_increment desc limit 1");
		return $r[0]['auto_increment'];
	}
	
	public function add($data){
		$m = D('AdminUser');
		$data['uid'] = $m->getUserId();
		return parent::add($data);
	}
	
	public function userT($uid){
		$r = $this->userTInfo($uid);
		foreach($r as $v){
			$arr[] = $v['id'];
		}
		return $arr;
	}
	
	public function usernameT($uname){
		$r = $this->field('a.id')->alias('a')->join('__ADMIN_USER__ b on b.id = a.uid')->where('b.username = \'' . $uname .'\'')->select();
		foreach($r as $v){
			$arr[] = $v['id'];
		}
		return $arr;
	}
	
	public function userTInfo($uid){
		if(is_array($uid)){
			$uid = implode(',', $uid);
		}		
		return $this->field('id')->where('uid in (' . $uid . ')')->select();
	}
}
